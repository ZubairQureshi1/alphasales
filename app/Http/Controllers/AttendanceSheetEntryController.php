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
use App\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use PDF;

class AttendanceSheetEntryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attendance.attendance_sheet_entry');
    }

    public function getAttendancePdf(Request $request)
    {
            $sessionId = SystemSession::get('selected_session_id');
            $session = Session::where('id', $sessionId)->first();    
            $organizationCampusId = SystemSession::get('organization_campus_id');
            $organizationCampus = OrganizationCampus::where('id', $organizationCampusId)->first();        
            $pdf = PDF::loadView('attendance.attendance_pdf', compact('organizationCampus', 'session'));  
            // return $pdf->download('attendance_sheet.pdf');
            return $pdf->stream();
        // $pdf = PDF::loadView('attendance.attendance_pdf', compact('request'));  
        // return $pdf->stream('attendance_sheet.pdf');
        // return $pdf->stream();
        // return view('attendance.attendance_pdf');
    }

    public function getAttendanceCourseList($wing_id){
        $courses = SessionCourse::where('wing_id', $wing_id)
                                ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
                                ->where('session_id', SystemSession::get('selected_session_id'))
                                ->orderBy('wing_id', 'ASC')
                                ->get()
                                ->pluck('course_name', 'course_id'); 
                                // dd($wing_id, $courses);
        return response()->json($courses, 200);
    }

    public function getAttendanceSubjectList($course_id, $wing_id){
        $subjects = SessionCourseSubject::where('course_id', '=' , $course_id)
                                        ->where('wing_id', '=', $wing_id)
                                        ->where('session_id', '=', SystemSession::get('selected_session_id'))
                                        ->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
                                        ->orderBy('course_id', 'ASC')
                                        ->pluck('subject_name', 'subject_id');
        return response()->json($subjects);    
    }

    public function getAttendanceSectionList($subject_id, $course_id, $wing_id){
        $sections = Section::where('subject_id', $subject_id)
                            ->where('course_id', $course_id)
                            ->where('wing_id', $wing_id)
                            ->orderBy('wing_id', 'ASC')
                            ->pluck('name', 'id'); 
        return response()->json($sections);
    }

    public function getAttendanceAffiliatedBodiesList($subject_id, $course_id, $wing_id){
        $affiliatedBodies = AffiliatedBody::get()->pluck('name','id');
        return response()->json(['success' => 'true', 'affiliatedBodies' => $affiliatedBodies]);
    }
    public function getAttendanceTeachersList($section_id){
        $teachers = SectionTeacher::where('section_id', $section_id)->pluck('user_name', 'user_id');
        return response()->json($teachers);
    }


    public function getFilteredData(Request $request)
    {
        $filters = $request->params;
        // $section = Section::find($request->params['section_id']);
        // $filters['wing_id']
        $students = Student::where('organization_campus_id', SystemSession::get('organization_campus_id'))
                            ->when(request('params')['course_id'], function($query) {
                                return $query->where('course_id', request('params')['course_id']);
                            })
                            // ->when(request('params')['subject_id'], function($query) {

                            // })
                            ->get();

        return response()->json(view('attendance.attendance_filtered_data', [
            'students' => $students
        ])->render(), 200);
    }

    function saveAttendanceData(Request $request){
        
    }

    // return $query->whereHas('studentAcademicHistories', function($q) {
    //                               return $q->whereHas('studentBooks', function($qy){
    //                                 return $qy->where('student_academic_history_id', '1');
    //                               });  
    //                             });
   

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
