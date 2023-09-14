<?php

use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateColAcademicHistoryToAttendanceAndChild extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::with('studentAcademicHistories', 'lectureAttendances')->get();
        foreach ($students as $key => $student) {
            if (count($student->studentAcademicHistories) > 0) {

                if ($student->attendances->count() > 0) {
                    foreach ($student->attendances->where('academic_history_id', null) as $attendance) {
                        $attendance->academic_history_id = $student->studentAcademicHistories->last()->id;
                        $attendance->update();
                    }
                }
                if ($student->lectureAttendances->count() > 0) {
                    foreach ($student->lectureAttendances as $key => $lecture_attendance) {
                        $lecture_attendance->academic_history_id = $student->studentAcademicHistories->last()->id;
                        $lecture_attendance->update();
                    }
                }

            }
        }
    }
}
