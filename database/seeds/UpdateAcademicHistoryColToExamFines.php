<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateAcademicHistoryColToExamFines extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::with('examFines', 'studentAcademicHistories')->get();
        foreach ($students as $student) {
            if (count($student->examFines) > 0 && count($student->studentAcademicHistories) > 0) {
                foreach ($student->examFines->where('student_academic_history_id', null) as $exam_fine) {
                    $exam_fine->student_academic_history_id = $student->studentAcademicHistories->last()->id;
                    $exam_fine->update();
                }
            }
        }
    }
}
