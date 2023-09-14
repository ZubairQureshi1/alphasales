<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Assignment;
use App\Models\AssignmentCourse;
use App\Models\AssignmentSection;
use App\Models\AssignmentSubject;
use App\Models\Course;
use App\Models\Subject;
use App\Models\Student;
use App\Models\Section;
use App\Models\StudentBook;
use App\Models\AssignmentResult;
use App\Models\StudentAcademicHistory;
class AssignmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('academics.assignments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $assignment = Assignment::get();
        $courses = Course::get()->pluck('name','id');
        $sections = Section::get()->pluck('name','id');
        $subjects = Subject::get()->pluck('name','id');
        return view('academics.assignments.create')->with(['courses' => $courses, 'sections' => $sections, 'subjects' => $subjects]);
    }
    public function getAssignmentCourseStudents(Request $request){
        $input =  $request->all();
        $course_students = [];
        $finalStudent = [];
       foreach($input['selected_course'] as $course){
        $assignment_students = Student::with('studentAcademicHistories')->where('course_id','=',$course)->get();
            foreach ($assignment_students as $student){
                if (count($student->studentAcademicHistories()->get()->toArray()) > 0){
                    $student_academic_count = $student->studentAcademicHistories()->get()->count();
                    if ($student_academic_count == (int)$input['selected_part_id']){
                        array_push($course_students, $student);
                    }
                }
            }
       }
       return response()->json(['success' => 'true','course_student' => $course_students]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->all();
        $input = json_decode($data['data'],true);
        $assignment = new Assignment ();
        $assignment->title = $input['title_id'];
        $assignment->topic = $input['topic_id'];
        $assignment->part_id = $input['part_id'];
        $assignment_file_name = $data['file']->getClientOriginalName();
        $assignment_file_name = time().$assignment_file_name;
        $assignment_file_destination = public_path('/files');
        $data['file']->move($assignment_file_destination,$assignment_file_name);
        $assignment->attachment_url = $assignment_file_name;
        $assignment->save();
        foreach($input['course_id'] as $course){
            $assignment_course = new AssignmentCourse();
            $assignment_course->course_id = $course;
            $assignment_course->assignment_id = $assignment->id;
            $assignment_course->save();
        }
        foreach($input['section_id'] as $section){
            $assignment_section = new AssignmentSection();
            $assignment_section->section_id = $section;
            $assignment_section->assignment_id = $assignment->id;
            $assignment_section->save();
        }
        $assignment_subject = new AssignmentSubject();
        $assignment_subject->subject_id = $input['subject_id'];
        $assignment_subject->assignment_id = $assignment->id;
        $assignment_subject->save();

        foreach($input['assignment_db_students'] as $assignment_db_student){
            $assignment_student = new AssignmentResult();
            $assignment_student->assignment_id = $assignment->id;
            $assignment_student->subject_id = $assignment_subject->subject_id;
            $assignment_student->student_id = $assignment_db_student['id'];
            $assignment_student->save();
        }
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
