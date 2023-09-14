<?php

namespace App\Http\Controllers;

use App\Models\Admission;
use App\Models\City;
use App\Models\Pwwb\IndexTable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class AdmissionByPwwbFormController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pwwbForms = IndexTable::where('admitted', false)
            ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
            ->where('session', '=', SystemSession::get('selected_session_id'))
        // apply date filter
            ->when(request('from_date') && request('to_date'), function ($q) {
                return $q->whereBetween('receiving_date', [request('from_date'), request('to_date')]);
            })
            ->when(empty(request('from_date')) && empty(request('to_date')), function ($q) {
                return $q->whereBetween('receiving_date', [Date('Y-m-d'), Date('Y-m-d')]);
            })
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')
            ->select(['id', 'file_module_number', 'district', 'receiving_date', 'session', 'course_id'])->get();
        return view('admissionByPwwbForm.index', [
            'pwwbForms' => $pwwbForms,
        ]);
    }

    public function admissionByPwwbForm(Request $request, $pwwb)
    {
        $pwwbForm = IndexTable::with(['StudentContactNumber', 'serviceDetail', 'workerBankSecurityDetail', 'transportHotelDetail', 'provisionalClaimDetail', 'educationalWingCfe'])->findOrFail($pwwb);
        if (!empty($pwwbForm)) {
            // return optional($pwwb->workerPersonalDetail);
            $count_admission_exists = Admission::where('pwwb_file_id', $pwwbForm->id)->count();
            if ($count_admission_exists > 0) {
                return redirect()->back()->withErrors('Admission Already Exist!');
            }
            $cities = City::orderBy('name')->pluck('name', 'id');
            return view('admissions.create')->with(['pwwb' => $pwwbForm, 'cities' => $cities]);
        } else {
            return redirect()->back();
        }
    }
}
