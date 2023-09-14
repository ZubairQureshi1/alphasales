<?php

use App\Models\Admission;
use App\Models\Course;
use App\Models\Student;
use App\Models\SystemRollNumber;
use Illuminate\Database\Seeder;

class MigrateStdRollNoToSystemRollNo extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        $courses = Course::get();
        foreach ($courses as $key => $course) {
            \Log::info($course);

            $students = Student::where('course_id', '=', $course->id)->where('session_id', '=', '2')->withTrashed()->get();
            // $students = Student::withTrashed()->get();
            foreach ($students as $key => $student) {
                $system_roll_no = new SystemRollNumber();
                if ($student->deleted_at != null) {
                    $system_roll_no->is_assigned = false;
                } else {
                    $system_roll_no->is_assigned = true;
                }
                $system_roll_no->student_id = $student->id;
                $system_roll_no->section_id = $student->section_id;
                $system_roll_no->admission_id = $student->admission_id;
                $system_roll_no->session_id = $student->session_id;
                $system_roll_no->course_id = $student->course_id;
                $system_roll_no->roll_no = $student->roll_no;
                $system_roll_no->section_name = $student->section_name;
                $system_roll_no->student_name = $student->student_name;
                $system_roll_no->course_name = $student->course_name;
                $system_roll_no->session_name = $student->session_name;
                $admission = Admission::find($student->admission_id);
                $system_roll_no->admission_form_code = $admission['form_no'];
                $system_roll_no->generated_at_length = ($key + 1);
                $system_roll_no->save();
                $student->system_roll_number_id = $system_roll_no->id;
                $student->update();
            }
        }
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    }
}
