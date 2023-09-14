<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateAcademicHistoryColToDateSheetStudent extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::with('studentAcademicHistories', 'dateSheetStudents')->get();
        foreach ($students as $student) {
            if (count($student->studentAcademicHistories) > 0 && count($student->dateSheetStudents) > 0) {
                foreach ($student->dateSheetStudents->where('academic_history_id', null) as $date_sheet_student) {
                    $date_sheet_student->academic_history_id = $student->studentAcademicHistories->last()->id;
                    $date_sheet_student->update();
                }
            }
        }
    }
}
