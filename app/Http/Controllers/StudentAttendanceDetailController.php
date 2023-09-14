<?php

namespace App\Http\Controllers;

use App\Models\AffiliatedBody;
use App\Models\Attendance;
use App\Models\AttendanceSheetEntry;
use App\Models\Course;
use App\Models\OrganizationCampus;
use App\Models\Section;
use App\Models\SectionTeacher;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\TimeSlot;
use App\Models\Wing;
use App\Models\Room;
use App\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use PDF;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceDetail;

class StudentAttendanceDetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $attendanceDetail = StudentAttendanceDetail::with('studentAttendance')->where('student_attendance_id', $id)->get();
        return view('attendance.view_student_attendance_detail', compact('attendanceDetail'));
    }

    public function list($id){
        $attendanceDetail = StudentAttendanceDetail::with('studentAttendance')->where('student_attendance_id', $id)->get();
        return view('attendance.view_student_attendance_list', compact('attendanceDetail'));
    }

    public function getAttendancePdf(Request $request, StudentAttendance $attendance)
    {
        // $user = StudentAttendance::with('user')->where('id', $id)->first();
        // $userName = User::select('users.name')->where('users.id', $user->user->id)->first();
            $pdf = PDF::loadView('attendance.student_attendance_pdf', compact('attendance'));  
            return $pdf->download('student_attendance_pdf.pdf');
            // return $pdf->stream();
        // $pdf = PDF::loadView('attendance.student_attendance_pdf', compact('request'));  
        // return $pdf->stream('attendance_sheet.pdf');
        // return $pdf->stream();
        // return view('attendance.student_attendance_pdf');
    }

    public function studentAttendancePdf()
    {
        $studentAttendanceDetails = StudentAttendance::with('section')->get();
        return view('attendance.student_attendance_details',compact('studentAttendanceDetails'));
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
    public function edit(StudentAttendanceDetail $data)
    {  
        $statusId = $data->status_id;        
        $attendanceId = $data->id;        
        $data = Student::where('id', $data->student_id)->first();
        $previousAtandance = StudentAttendanceDetail::where('status_id', $statusId)->first();
        return view('attendance.edit_student_attendance_detail', compact('data', 'attendanceId', 'previousAtandance'));
    }

    public function editStudentAttendanceStatus(Request $request){
        $this->policyCalculations($request['student_obj']['status_id'], $request['student_obj']['attendance_id'], $request['student_obj']['status_type'], $request['student_obj']['student_id'], $request['student_obj']['section_subject_detail_id'], $request['student_obj']['section_detail_id']);

        $updateStudentAttendenceDetail = StudentAttendanceDetail::where('id', $request['student_obj']['attendance_id'])->update([
            'status_id' => $request['student_obj']['status_id'],
            'status_type' => $request['student_obj']['status_type'],
        ]);
        // dd($request['student_obj']['attendance_id']);
        
        // return redirect()->route('student_attendance')->with('message','Attendance Updated Successfully');
    }

    public function policyCalculations($status_id, $attendance_id, $status_type, $student_id, $subject_id, $section_id){    

        // $studentAttendancePolicy = StudentAttendanceDetail::with('studentAttendance')->get();
        // return $studentAttendancePolicy;
        $studentAttendance = StudentAttendance::where('section_detail_id', $section_id)->where('section_subject_detail_id', $subject_id)->get();
        $attendancePolicy = StudentAttendanceDetail::where('status_id', $status_id)->where('student_id', $student_id)->get()->count();
        // return $attendancePolicy;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StudentAttendanceDetail $data)
    {
        $data = StudentAttendanceDetail::find($data->id)->update(request(['working_status','landed_status']));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(StudentAttendanceDetail $data)
    {
        $data = StudentAttendanceDetail::destroy($data->id);
        return redirect()->back()->with('message', 'Attendance Deleted Successfully');
    }

    public function getWingType(Request $request){
        $wingType = Wing::where('id', $request->wing)->first();
        return response()->json($wingType->wing_type_id, 200);
    }
}
