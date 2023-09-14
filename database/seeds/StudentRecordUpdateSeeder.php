<?php

use App\Models\Student;
use App\Models\StudentAcademicHistory;
use Illuminate\Database\Seeder;

class StudentRecordUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::with(['studentAcademicHistories'])->where('session_name', '=', '2017-2019')->/*where('reference_id', '=', '27')->*/get();
        // foreach ($students as $key => $student) {
        //     $student->admission_type = 'PWWB';
        //     $student->admission_type_id = 2;
        //     $student->update();
        // }
        foreach ($students as $key => $student) {
            $academic_histories = $student->studentAcademicHistories()->get();
            if (count($academic_histories) == 0) {
                $academic_history_part_one = ['course_name' => $student['course_name'], 'course_id' => $student->course_id, 'session_name' => $student->session_name, 'session_id' => $student->session_id, 'is_promoted' => true, 'student_id' => $student->id];
                $academic_history_part_two = ['course_name' => $student['course_name'], 'course_id' => $student->course_id, 'session_name' => $student->session_name, 'session_id' => $student->session_id, 'is_promoted' => false, 'student_id' => $student->id];
                $part_one_academic = StudentAcademicHistory::create($academic_history_part_one);
                $part_two_academic = StudentAcademicHistory::create($academic_history_part_two);
            }
            if (count($academic_histories) == 1) {
                $academic_history = $student->studentAcademicHistories()->get()[0];
                $academic_history->is_promoted = true;
                $academic_history->update();

                $academic_history_part_two = ['course_name' => $student['course_name'], 'course_id' => $student->course_id, 'session_name' => $student->session_name, 'session_id' => $student->session_id, 'is_promoted' => false, 'student_id' => $student->id];
                $part_two_academic = StudentAcademicHistory::create($academic_history_part_two);
            }
        }
    }
}
