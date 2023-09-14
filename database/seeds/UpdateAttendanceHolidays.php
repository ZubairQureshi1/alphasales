<?php

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Database\Seeder;

class UpdateAttendanceHolidays extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $students = Student::where('session_name', '=', '2017-2019')->get();
        foreach ($students as $key => $student) {
            $attendances = Attendance::where('student_id', '=', $student->id)->get();
            foreach ($attendances as $key => $attendance) {
                if ($attendance->date == '2018-08-20' || $attendance->date == '2018-08-21' || $attendance->date == '2018-08-22' || $attendance->date == '2018-08-23' || $attendance->date == '2018-09-20' || $attendance->date == '2018-09-21' || $attendance->date == '2018-09-22' || $attendance->date == '2018-10-05' || $attendance->date == '2018-10-30' || $attendance->date == '2018-11-01' || $attendance->date == '2018-11-02' || $attendance->date == '2018-11-03' || $attendance->date == '2018-11-11' || $attendance->date == '2018-11-18' || $attendance->date == '2018-11-20' || $attendance->date == '2018-11-21' || $attendance->date == '2018-11-25' || $attendance->date == '2018-12-02' || $attendance->date == '2018-12-09' || $attendance->date == '2018-12-23' || $attendance->date == '2018-12-24' || $attendance->date == '2018-12-25' || $attendance->date == '2018-12-26' || $attendance->date == '2018-12-27' || $attendance->date == '2018-12-28' || $attendance->date == '2018-12-29' || $attendance->date == '2018-12-31') {
                    $attendance->status_id = 3;
                    $attendance->status = 'Day-Off';
                    $attendance->update();
                }
            }
        }
        $students = Student::where('session_name', '=', '2018-2020')->get();
        foreach ($students as $key => $student) {
            $attendances = Attendance::where('student_id', '=', $student->id)->get();
            foreach ($attendances as $key => $attendance) {
                if ($attendance->date == '2018-09-20' || $attendance->date == '2018-09-21' || $attendance->date == '2018-09-30' || $attendance->date == '2018-10-05' || $attendance->date == '2018-10-30' || $attendance->date == '2018-11-01' || $attendance->date == '2018-11-02' || $attendance->date == '2018-11-03' || $attendance->date == '2018-11-11' || $attendance->date == '2018-11-18' || $attendance->date == '2018-11-20' || $attendance->date == '2018-11-21' || $attendance->date == '2018-11-25' || $attendance->date == '2018-12-02' || $attendance->date == '2018-12-09' || $attendance->date == '2018-12-23' || $attendance->date == '2018-12-24' || $attendance->date == '2018-12-25' || $attendance->date == '2018-12-26' || $attendance->date == '2018-12-27' || $attendance->date == '2018-12-28' || $attendance->date == '2018-12-29' || $attendance->date == '2018-12-31') {
                    $attendance->status_id = 3;
                    $attendance->status = 'Day-Off';
                    $attendance->update();
                }
            }
        }
    }
}
