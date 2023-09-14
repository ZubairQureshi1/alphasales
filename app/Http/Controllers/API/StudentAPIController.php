<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Admission;
use App\Models\Course;
use App\Models\Reference;
use App\Models\Section;
use App\Models\Session;
use App\Models\Student;
use App\Models\SystemRollNumber;
use Illuminate\Http\Request;

class StudentAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $post = Student::get()->first();
        return $post;
    }
    public function getStudents()
    {
        $students = Student::get();
        return $students;
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

    public function updateStudent($id, Request $request)
    {
        try {
            \DB::beginTransaction();
            $student = Student::find($id);

            $input = $request->all();
            \Log::info($input);

            $keys = array_keys($input);
            $student_course = $student->course()->get()->first();
            $student_section = $student->section()->get()->first();
            $student_session = $student->session()->get()->first();

            $student_end_date = $student_session->session_end_date;
            $student_session_end_date = new \DateTime(str_replace('/', '-', $student_end_date));

            $selected_course = Course::find($input['course_id']);
            $selected_section = Section::find($input['section_id']);
            $selected_session = Session::find($input['session_id']);

            $selected_end_date = $selected_session->session_end_date;
            $selected_session_end_date = new \DateTime(str_replace('/', '-', $selected_end_date));

            $course_name = $selected_course->name;
            $section_name = $selected_section->name;
            $session_name = $selected_session->session_name;
            // if ( $selected_course->course_code != $student_course->course_code || $selected_section->code != $student_section->code || $selected_session_end_date != $student_session_end_date) {
            if ($selected_section->code != $student_section->code) {
                $courseWiseStudents = SystemRollNumber::where('course_id', '=', $input['course_id'])->where('session_id', '=', $input['session_id'])->withTrashed()->get();
                $courseStudentCount;
                if (!$courseWiseStudents) {
                    $courseStudentCount = 1;
                } else {
                    // if ($selected_course->course_code != $student_course->course_code) {
                    //     dd(sizeof($courseWiseStudents));
                    //     $courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1;
                    //     // $courseStudentCount = sizeof($courseWiseStudents) + 1;
                    // } else {
                    $courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1/*sizeof($courseWiseStudents)*/;
                    // }
                }
                $end_date = Session::find($input['session_id'])->session_end_date;
                $session_end_date = new \DateTime(str_replace('/', '-', $end_date));
                $section_code = Section::find($input['section_id'])->code;
                $course_code = Course::find($input['course_id'])->course_code;
                $roll_no_till_section = 'CFE-' . $session_end_date->format('Y') . '-' . $course_code . '-' . $section_code;
                $student_roll_no = 'CFE-' . $session_end_date->format('Y') . '-' . $course_code . '-' . $section_code . '-' . sprintf('%05d', intval($courseStudentCount));
                $system_roll_no_input = ['roll_no' => $student_roll_no, 'session_id' => $input['session_id'], 'section_id' => $input['section_id'], 'course_id' => $input['course_id'], 'student_id' => $student->id, 'admission_id' => $student->admission_id, 'session_name' => $session_name, 'section_name' => $section_name, 'student_name' => $student->student_name, 'course_name' => $course_name, 'is_assigned' => true, 'generated_at_length' => $courseStudentCount];
                $system_roll_no = SystemRollNumber::create($system_roll_no_input);

                if ($student->admission_id != null) {
                    $admission = Admission::find($student->admission_id);
                    $system_roll_no->admission_form_code = $admission->form_no;
                }
                $system_roll_no->update();
                // dd($student_roll_no);

                $student_assigned_roll_no = SystemRollNumber::find($student->system_roll_number_id);
                $student_assigned_roll_no->admission_id = null;
                $student_assigned_roll_no->is_assigned = false;
                $student_assigned_roll_no->admission_form_code = null;
                $student_assigned_roll_no->student_name = null;
                $student_assigned_roll_no->student_id = null;
                $student_assigned_roll_no->update();

                $student->roll_no = $student_roll_no;
                $student->system_roll_number_id = $system_roll_no->id;

            }
            $student->is_end_of_reg = false;
            foreach ($keys as $key => $value) {
                if ($value != '_method' && $value != '_token') {
                    if ($value == 'is_end_of_reg') {
                        $student->is_end_of_reg = true;
                    } else {
                        $student->$value = $input[$value];
                    }
                }
            }
            if (!$student->is_end_of_reg) {
                $student->reason_end_of_reg = '';
            }
            $student->section_name = $section_name;
            $student->course_name = $course_name;
            $student->session_name = $session_name;
            $student->reference_name = Reference::find($input['reference_id'])->name;
            $student->admission_type = config('constants.student_categories')[$input['student_category_id']];
            // dd($student->toArray());

            $student->update();
            \DB::commit();
            return redirect(route('students.index'));
        } catch (\Exception $e) {
            \DB::rollback();
            return $e;
        }
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
