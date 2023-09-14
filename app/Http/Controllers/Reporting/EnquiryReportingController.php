<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Enquiry;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class EnquiryReportingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('reporting.enquiryModule.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMonthlyDataEnquiryTypeWise(Request $request)
    {
        $start_date_obj = Carbon::parse($request->start_date)->startOfMonth();
        $end_date_obj = Carbon::parse($request->end_date)->endOfMonth();
        $enquiry_data = Enquiry::where('organization_campus_id', SystemSession::get('organization_campus_id'))->where('session_id', SystemSession::get('selected_session_id'))->where('enquiry_date', '>=', $start_date_obj)->where('enquiry_date', '<=', $end_date_obj)->get();

        $view = view('reporting.enquiryModule.enquiryTypeWise.body')->with('data', $enquiry_data);
        // dd($enquiry_data->first()->groupBy('student_category_name')->toArray());
        return response()->json(['success' => true, 'data' => $view->render()], 200);
    }

    public function getMonthlyDataEnquiryEmployeeWise(Request $request)
    {
        $start_date_obj = Carbon::parse($request->start_date)->startOfMonth();
        $end_date_obj = Carbon::parse($request->end_date)->endOfMonth();

        $users = User::whereHas('roles', function($q) {
            return $q->where('id', '10')->orWhere('id', '11')->orWhere('id', '13');
        })->get();

        $view = view('reporting.enquiryModule.enquiryEmployeeWise.body')->with('data', $users)->with('start_date_obj', $start_date_obj)->with('end_date_obj', $end_date_obj);
        // dd($enquiry_data->first()->groupBy('student_category_name')->toArray());
        return response()->json(['success' => true, 'data' => $view->render()], 200);
    }

    public function getMonthlyDataEnquiryEnteredByWise(Request $request)
    {
        $start_date_obj = Carbon::parse($request->start_date)->startOfMonth();
        $end_date_obj = Carbon::parse($request->end_date)->endOfMonth();

        $users = User::whereHas('roles', function($q) {
            return $q->where('id', '10')->orWhere('id', '11')->orWhere('id', '13');
        })->orderBy('name', 'ASC')->get();

        $view = view('reporting.enquiryModule.enquiryEntryByReport.body')->with('data', $users)->with('start_date_obj', $start_date_obj)->with('end_date_obj', $end_date_obj);
        // dd($enquiry_data->first()->groupBy('student_category_name')->toArray());
        return response()->json(['success' => true, 'data' => $view->render()], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
