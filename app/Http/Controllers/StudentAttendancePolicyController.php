<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentAttendancePolicy;
use App\Models\StudentAttendancePolicyDetail;
use App\Models\OrganizationCampus;
use App\Models\Student;
use App\User;
use Illuminate\Support\Facades\Session as SystemSession;

class StudentAttendancePolicyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $policy = StudentAttendancePolicy::where('wing_id', SystemSession::get('organization_campus_id'))->get();
        return view('finePolicy.view', compact('policy'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $policy = StudentAttendancePolicy::get();
        return view('finePolicy.index', compact('policy'));
    }

    // public function fineSheet()
    // {
    //     return view('finePolicy.fineSheet');
    // }

    public function fineSheet($id)
    {
        $studentData = Student::where('id', $id)->first();  
        $policy = StudentAttendancePolicy::get(); 
        return view('finePolicy.fineSheet', compact('studentData', 'policy'));
    }

    public function finePayment()
    {
        return view('finePolicy.finePayments');
    }
   
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $params = $request->fine_policies;
        if (isset($params)) {
            $fine_policies = StudentAttendancePolicy::create([
                "wing_id" => $params['wing_id'], 
                "absent_fine" => $params['absent_fine'], 
                "absent_initial_fine" => $params['absent_initial_fine'], 
                "absent_maximum_fine" => $params['absent_maximum_fine'],
                "late_fine" => $params['late_fine'],
                "late_initial_fine" => $params['late_initial_fine'],
                "late_maximum_fine" => $params['late_maximum_fine'],
                "leave_quota" => $params['leave_quota'],
                "apply_absent" => $params['apply_absent'],
            ]);
            if ($params['wing_id'] != 2) {
                if (isset($params['credit_hours'])) {
                    foreach ($params['credit_hours'] as $creditHour) {
                        StudentAttendancePolicyDetail::create([
                            'student_policy_id'     => $fine_policies->id,
                            "credit_hour"           => $creditHour['credit_hour'], 
                            "struck_off_limit"      => $creditHour['struck_off_limit'] 
                        ]);
                    }
                }
            } else {
                StudentAttendancePolicyDetail::create([
                    'student_policy_id'     => $fine_policies->id,
                    "struck_off_limit"           => $params['struck_off_limit'], 
                ]);
            }
        }
     }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StudentAttendancePolicy $policy)
    {
        // return $policy;
        return view('finePolicy.show',compact('policy'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StudentAttendancePolicy $policy)
    {
        return view('finePolicy.edit', compact('policy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $params = $request->fine_policies;
        $policy = StudentAttendancePolicy::find($params['policy_id']);

        $fine_policy = $policy->update([
            "wing_id" => $params['wing_id'], 
            "absent_fine" => $params['absent_fine'], 
            "absent_initial_fine" => $params['absent_initial_fine'], 
            "absent_maximum_fine" => $params['absent_maximum_fine'],
            "late_fine" => $params['late_fine'],
            "late_initial_fine" => $params['late_initial_fine'],
            "late_maximum_fine" => $params['late_maximum_fine'],
            "leave_quota" => $params['leave_quota'],
            "apply_absent" => $params['apply_absent'],
        ]);

        $policy->studentAttendancePolicyDetails()->delete();

        if ($params['wing_id'] != 2) {
            if (isset($params['credit_hours'])) {
                foreach ($params['credit_hours'] as $creditHour) {
                    $policy->studentAttendancePolicyDetails()->create([
                        'student_policy_id' => $policy->id,
                        "credit_hour"       => $creditHour['credit_hour'], 
                        "struck_off_limit"  => $creditHour['struck_off_limit'] 
                    ]);
                }
            }
        } else {
            $policy->studentAttendancePolicyDetails()->create([
                'student_policy_id' => $policy->id,
                "struck_off_limit"  => $params['struck_off_limit'], 
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAttendancePolicy $policy)
    {
        $policy = StudentAttendancePolicy::destroy($policy->id);
        return redirect()->back()->with('message', 'Attendance Policy Deleted Successfully');
    }
}
