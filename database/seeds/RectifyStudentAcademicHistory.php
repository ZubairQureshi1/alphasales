<?php

use App\Models\FeePackage;
use App\Models\Student;
use App\Models\StudentBook;
use Illuminate\Database\Seeder;

class RectifyStudentAcademicHistory extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::where('session_name', '=', '2018-2020')->with(['studentAcademicHistories', 'feePackages'])->get();

        foreach ($students as $key => $student) {
            foreach ($student->studentAcademicHistories()->get() as $history_key => $history) {
                // dd($student->toArray(), $student->studentAcademicHistories->toArray());
                if ($history_key > 0) {
                    $fee_package = FeePackage::where('student_id', '=', $student->id)->where('academic_history_id', '=', $history->id)->get()->last();
                    if ($fee_package != null) {
                        $fee_package->delete();
                    }
                    StudentBook::where('student_academic_history_id', '=', $history->id)->delete();
                    $student->studentAcademicHistories()->get()->last()->delete();
                }
            }
        }
    }
}
