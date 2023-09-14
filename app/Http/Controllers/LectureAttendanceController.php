<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\CourseSubject;
use App\Models\LectureAttendance;
use App\Models\Session;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use Illuminate\Http\Request;

class LectureAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $courses = Course::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        return view('attendance.lecture_attendance')->with(['courses' => $courses, 'sessions' => $sessions]);
    }
    public function getCourseSubject(Request $request)
    {
        $input = $request->all();
        $course_students = [];
        $lecture_students = Student::with('studentAcademicHistories')->where('course_id', '=', $input['selected_course_id'])->where('session_id', '=', $input['selected_session_id'])->get();
        foreach ($lecture_students as $student) {
            if (count($student->studentAcademicHistories()->get()->toArray()) > 0) {
                $student_academic_count = $student->studentAcademicHistories()->get()->count();
                if ($student_academic_count == (int) $input['selected_part_id']) {
                    array_push($course_students, $student);
                }
            }
        }
        $course_subjects = CourseSubject::where('course_id', '=', $input['selected_course_id'])->get();
        return response()->json(['success' => 'true', 'course_subjects' => $course_subjects, 'course_students' => $course_students]);
    }
    public function getLectureCourseSubject(Request $request)
    {
        $input = $request->all();
        $course_subjects = CourseSubject::where('course_id', '=', $input['selected_course_id'])->get();
        return response()->json(['success' => 'true', 'course_subjects' => $course_subjects]);
    }
    public function getStudentLectureCourseSubject(Request $request)
    {
        $input = $request->all();
        $course_subjects = CourseSubject::where('course_id', '=', $input['selected_course_id'])->get();
        return response()->json(['success' => 'true', 'course_subjects' => $course_subjects]);
    }
    public function LectureAttendanceView()
    {
        $courses = Course::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        return view('attendance.lecture_attendance_view')->with(['courses' => $courses, 'sessions' => $sessions]);
    }
    public function StudentLectureAttendanceView()
    {
        $courses = Course::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        return view('attendance.student_lecture_attendance_view')->with(['courses' => $courses, 'sessions' => $sessions]);
    }
    public function FilterLectureAttendance(Request $request)
    {
        $input = $request->all();
        $lecture_attendances = LectureAttendance::where('course_id', '=', $input['selected_course_id'])->where('subject_id', '=',
            $input['selected_subject_id'])->where('part_id',
            '=', $input['selected_part_id'])->where('session_id', '='
            , $input['selected_session_id'])->where('date', '=', $input['selected_date_id'])->get();
        return response()->json(['success' => 'true', 'lecture_attendances' => $lecture_attendances]);
    }
    public function FilterStudentLectureAttendance(Request $request)
    {
        $input = $request->all();
        $student_lecture_attendances = LectureAttendance::where('course_id', '=', $input['selected_course_id'])
            ->where('subject_id', '=', $input['selected_subject_id'])
            ->where('part_id', '=', $input['selected_part_id'])
            ->where('session_id', '=', $input['selected_session_id'])
            ->where('date', '=', $input['selected_date_id'])
            ->where('student_id', '=', $input['selected_student_id'])->get();
        return response()->json(['success' => 'true', 'student_lecture_attendances' => $student_lecture_attendances]);
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
        $input = $request->all();
        foreach ($input['student_id'] as $key => $value) {
            $lecture_attendance = new LectureAttendance();
            $lecture_attendance->part_id = $input['part'];
            $lecture_attendance->course_id = $input['course_id'];
            $lecture_attendance->subject_id = $input['subject_id'];
            $date_obj = new \DateTime($input['date']);
            $lecture_attendance->date = $date_obj;
            $lecture_attendance->session_id = $input['session_id'];
            $lecture_attendance->student_id = $input['student_id'][$key];
            $lecture_attendance->academic_history_id = StudentAcademicHistory::where('student_id', '=', $input['student_id'][$key])->get()->last()->id;
            $lecture_attendance->status_id = $input['status_id'][$key];
            $lecture_attendance->save();
        }
        return redirect()->back();
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
        $input = $request->all();
        dd($input);
        $lecture_attendance_status = LectureAttendance::find($id);
        $lecture_attendance_status->status_id = $input['status_id'];
        $lecture_attendance_status->update();
        return response()->json(['success' => 'true']);
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
