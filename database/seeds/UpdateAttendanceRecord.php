<?php

// use App\Models\AttendanceLog;
use App\Models\Attendance;
use Illuminate\Database\Seeder;

class UpdateAttendanceRecord extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
/*
$attendance_records = Attendance::get();
foreach ($attendance_records as $key => $record) {
$day_of_date = date('D', strtotime($record->date));
if ($day_of_date == 'Sun') {
$record->status_id = 3;
$record->status = 'Day-Off';
$record->update();
}
}*/
        $attendance_records = Attendance::where('created_at', '>=', '2019-01-30 00:00:00')->delete();

        // $attendance_records = AttendanceLog::where('created_at', '>=', '2019-01-10')->where('created_at', '<=', '2019-10-15')->get();
        // foreach ($attendance_records as $key => $value) {
        //     $value->attendance_time = '2019-01-10UTC07:47:27.0350';
        //     $value->update();
        // }
    }
}
