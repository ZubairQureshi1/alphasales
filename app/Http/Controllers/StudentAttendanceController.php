<?php

namespace App\Http\Controllers;

use App\Models\AffiliatedBody;
use App\Models\Attendance;
use App\Models\AttendanceSheetEntry;
use App\Models\Course;
use App\Models\OrganizationCampus;
use App\Models\Section;
use App\Models\SectionSubjectDetail;
use App\Models\SectionTeacher;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentAttendance;
use App\Models\StudentAttendanceDetail;
use App\Models\TimeSlot;
use App\Models\Wing;
use App\User;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use PDF;

class StudentAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('attendance.student_attendance');
    }
    public function studentAttendanceDetail()
    {
        $studentAttendanceDetails = StudentAttendance::with('section')
                                                      ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
                                                      ->get();
        return view('attendance.student_attendance_details',compact('studentAttendanceDetails'));
    }

    public function getAttendanceCourseList($wing_id){
        $courses = SessionCourse::where('wing_id', $wing_id)
                                ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
                                ->where('session_id', SystemSession::get('selected_session_id'))
                                ->orderBy('wing_id', 'ASC')
                                ->get();
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

    public function getAttendanceSectionList($subject_id, $course_id, $wing_id, $term_id){
        $sections = SectionSubjectDetail::where('subject_id', $subject_id)
                            ->where('academic_wing_id', $wing_id)
                            ->whereHas('section', function($q){
                                return $q->where('status_id', '0');
                            })
                            ->groupBy('section_detail_id')
                            ->get()
                            ->pluck('section_detail_id', 'section_name');


        return response()->json($sections);
    }

    public function getAttendanceAffiliatedBodiesList($subject_id, $course_id, $wing_id){
        $affiliatedBodies = AffiliatedBody::get()->pluck('name','id');
        return response()->json(['success' => 'true', 'affiliatedBodies' => $affiliatedBodies]);
    }
    public function getAttendanceTeachersList($section_id, $subject_id){
        $teachers = SectionSubjectDetail::where('section_detail_id', $section_id)->where('subject_id', $subject_id)->get()->last();            
        return response()->json($teachers->sectionTeachers()->pluck('user_name', 'user_id'));
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
                            ->whereHas('studentAcademicHistories', function($query) use ($filters) {
                                return $query->where('semester', $filters['term_id']);
                            })
                            ->whereHas('studentAcademicHistories', function($query) use ($filters) {
                                $query->latest('created_at')->where('is_promoted', false)->whereIn('id', function($q) use ($filters) {
                                    $q->select('student_academic_history_id')
                                      ->where('subject_id', $filters['subject_id'])
                                      ->where('section_detail_id', $filters['section_detail_id'])
                                      ->from('student_books');
                                });
                            })->get();

        return response()->json(view('attendance.attendance_filtered_data', [
            'students' => $students
        ])->render(), 200);
    }

    function saveAttendanceData(Request $request) {
        $getSectionSubjectDetailId = SectionSubjectDetail::where('subject_id', $request['studentAttendances']['subject_id'])->where('section_detail_id', $request['studentAttendances']['section_id'])->first();
        $studentAttendance = StudentAttendance::create([
            "section_detail_id" => $request['studentAttendances']['section_id'],
            "user_id" => $request['studentAttendances']['teacher_id'],
            "room_id" => $request['studentAttendances']['room_id'],
            "date_time" => $request['studentAttendances']['date_time'],
            "title" => $request['studentAttendances']['title'],
            "section_subject_detail_id" => $getSectionSubjectDetailId->id,
            'organization_campus_id' => SystemSession::get('organization_campus_id')
        ]);
        $attendances = $request->studentAttendances['attendance'];
        foreach($attendances as $key => $attendance) {
            if (isset($attendance)) {
                StudentAttendanceDetail::create([
                    'student_attendance_id' => $studentAttendance->id,
                    'student_id' => $attendance['student_id'],
                    'status_id' => $attendance['attendance_status_id'],
                    'status_type' => $attendance['attendance_status_type'],
                ]);
            }
        }
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
    public function destroy(StudentAttendance $attendanceDetails)
    {
        $attendanceDetails = StudentAttendance::destroy($attendanceDetails->id);
        return redirect()->back()->with('message', 'Attendance Deleted Successfully'); 
    }
}
