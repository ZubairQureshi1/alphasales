<?php

use App\Models\Attendance;
use App\Models\Student;
use Illuminate\Database\Seeder;

class AttendanceUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $attendance_logs = AttendanceLog::where('type_id', '=', '0')->get();
        // foreach ($attendance_logs as $key => $log) {
        //     $student = Student::withTrashed()->where('roll_no', '=', $log->roll_number)->get()->first();
        //     if (empty($student)) {
        //         $student = Student::withTrashed()->where('student_name', '=', $log->name)->get()->first();
        //     }
        //     \Log::info($student);
        //     $log->student_id = $student->id;
        //     $log->update();
        // }
        $attendances = Attendance::where('type_id', '=', '0')->get();
        foreach ($attendances as $key => $attendance) {
            $student = Student::withTrashed()->where('roll_no', '=', $attendance->roll_number)->get()->first();
            if (empty($student)) {
                $student = Student::withTrashed()->where('student_name', '=', $attendance->name)->get()->first();
            }
            $attendance->student_id = $student->id;
            $attendance->update();
        }
    }
}
