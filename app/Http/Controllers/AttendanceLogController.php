<?php

namespace App\Http\Controllers;

class AttendanceLogController extends Controller
{
    public function getStudentAttendances()
    {
        $attendances = Attendance::where('type_name', '=', config('constants.attendance_type')[0])->get();
        foreach ($attendances as $index => $value) {
            $check_in_UTC = $value['check_in_time'];
            $check_out_UTC = $value['check_out_time'];
            if ($check_in_UTC != null && $check_in_UTC != '') {
                $check_in_UTC = new DateTime($value['check_in_time'], new DateTimeZone('UTC'));
                $check_in_UTC->setTimezone(new DateTimeZone('PKT'));
                $attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('Y-m-d h:m A');
            }
            if ($check_out_UTC != null && $check_out_UTC != '') {
                $check_out_UTC = new DateTime($value['check_out_time'], new DateTimeZone('UTC'));
                $check_out_UTC->setTimezone(new DateTimeZone('PKT'));
                $attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:m A');
            }
            // dd($value['check_out_time_gmt']);
        }
        return view('attendance.student_index')->with(['attendances' => $attendances]);
    }
    public function getEmployeeAttendances()
    {
        $attendances = Attendance::where('type_name', '=', config('constants.attendance_type')[1])->get()->toArray();
        foreach ($attendances as $index => $value) {
            $check_in_UTC = $value['check_in_time'];
            $check_out_UTC = $value['check_out_time'];
            if ($check_in_UTC != null && $check_in_UTC != '') {
                $check_in_UTC = new DateTime($value['check_in_time'], new DateTimeZone('UTC'));
                $check_in_UTC->setTimezone(new DateTimeZone('PKT'));
                $attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('Y-m-d h:m A');
            }
            if ($check_out_UTC != null && $check_out_UTC != '') {
                $check_out_UTC = new DateTime($value['check_out_time'], new DateTimeZone('UTC'));
                $check_out_UTC->setTimezone(new DateTimeZone('PKT'));
                $attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:m A');
            }
            // dd($value['check_out_time_gmt']);
        }
        return view('attendance.employee_index')->with(['attendances' => $attendances]);
    }
}
