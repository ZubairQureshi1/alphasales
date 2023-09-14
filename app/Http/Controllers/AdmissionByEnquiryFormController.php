<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Enquiry;
use App\Models\Admission;
use Illuminate\Http\Request;
use App\Models\AdmissionByEnquiryForm;
use Illuminate\Support\Facades\Session as SystemSession;

class AdmissionByEnquiryFormController extends Controller
{
    public function index(Request $request)
    {
        //by default we call only those which are pendings
        $enquiriesForAdmission = AdmissionByEnquiryForm::where('is_admitted', false)
                                ->whereHas('enquiry', function($q) {
                                    $q->where('organization_campus_id', SystemSession::get('organization_campus_id'))
                                    ->where('session_id', '=', SystemSession::get('selected_session_id'))
                                    ->where('student_category_id', '!=', 0)
                                    ->orderByRaw('length(form_code)','ASC')->orderBy('form_code', 'ASC');
                                })->get();
        return view('admissionByEnquiryForm.index')->with('enquiriesForAdmission', $enquiriesForAdmission);
    }

    public function admissionByEnquiryForm($enquiry)
    {

        $enquiry = Enquiry::with('enquiryContactInfos')->find($enquiry);
        $count_admission_exists = Admission::where('enquiry_id', $enquiry->id)->count();
        if ($count_admission_exists > 0) {
            return redirect('/admissionByEnquiryForm')->withErrors('Enquiry already admitted');
        }
        $cities = City::orderBy('name')->pluck('name', 'id');
        return view('admissions.create')->with(['enquiry' => $enquiry, 'cities' => $cities]);
    }

}
