<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\AppBaseController;
use App\Models\AttendanceLog;
use App\Models\Course;
use App\Models\Section;
use App\Models\Student;
use App\User;
use Illuminate\Http\Request;

class AttendanceAPIController extends AppBaseController
{
    public function getAttendanceSupportingData(Request $request)
    {

        $courses          = Course::get()->toArray();
        $sections         = Section::get()->toArray();
        $students         = Student::get()->toArray();
        $users            = User::get()->toArray();
        $statuses         = config('constants.attendance_statuses');
        $attendance_types = config('constants.attendance_type');
        return response()->json(['success' => true, 'message' => 'Supporting Data retreived successfully', 'data' => ['courses' => $courses, 'employees' => $users, 'students' => $students, 'sections' => $sections, 'statuses' => $statuses, 'attendance_types' => $attendance_types]]);
    }

    public function punchAttendance(Request $request)
    {
        try {
            \DB::beginTransaction();
            $input_json_array    = $request->all();
            $offline_attendances = json_decode($input_json_array['offline_attendances'], true);
            foreach ($offline_attendances as $key => $input) {
                if (isset($input['id']) || isset($input['name'])) {
                    $attendanceFor;
                    if ($input['type'] == 'student') {
                        if (isset($input['id'])) {
                            $attendanceFor = Student::withTrashed()->find($input['id'])->toArray();
                        } else {
                            $attendanceFor = Student::withTrashed()->find($input['name'])->toArray();
                            \Log::info($attendanceFor);
                        }

                    } else {
                        $attendanceFor = User::find($input['id']);
                    }
                    $currentDate                     = date($input['date']);
                    $dateTime                        = date($input['time']);
                    $attendance_log                  = new AttendanceLog();
                    $attendance_log->attendance_time = $dateTime;
                    $attendance_log->name            = $input['name'];
                    $attendance_log->date            = $currentDate;
                    $attendance_log->type_name       = $input['type'];
                    $attendance_log->type_id         = array_search($input['type'], config('constants.attendance_types'));
                    if ($input['type'] == 'student') {
                        $attendance_log->roll_number = $attendanceFor['roll_no'];
                        $attendance_log->student_id  = $attendanceFor['id'];
                    } else {
                        $attendance_log->emp_code = $attendanceFor['emp_code'];
                        $attendance_log->user_id  = $attendanceFor['id'];
                    }
                    $attendance_log->save();
                } else {
                    \Log::info('no id and name found');
                }

                // $currentDate = date($input['date']);
                // $dateTime = date($input['time']);
                // \Log::info($currentDate);
                // \Log::info($dateTime);
                // $attendanceFor;
                // $attendance;
                // $sms_contact;
                // if ($input['type'] == 'student') {
                //     $attendanceFor = Student::find($input['id'])->toArray();
                //     $attendance = Attendance::where('roll_number', '=', $attendanceFor['roll_no'])->where('date', '=', $currentDate)->get();
                //     if ($attendanceFor['gaurdian_cell_no'] != null && $attendanceFor['gaurdian_cell_no'] != '') {
                //         $sms_contact = $attendanceFor['gaurdian_cell_no'];
                //     } else {
                //         $sms_contact = $attendanceFor['father_cell_no'];
                //     }
                // } else {
                //     $attendanceFor = User::find($input['id']);
                //     $attendance = Attendance::where('emp_code', '=', $attendanceFor['emp_code'])->where('date', '=', $currentDate)->get();
                //     $sms_contact = $attendanceFor['mobile_no'];
                // }

                // \Log::info($attendanceFor);
                // // dd($currentDate);

                // if (count($attendance) != 0) {
                //     //  dd($attendance);
                //     $attendance = $attendance->first();
                //     if ($attendance->check_out_time == null) {
                //         $attendance->check_out_time = $dateTime;
                //         $attendance->update();

                //     }

                // } else {
                //     $punch_attendance = new Attendance();
                //     $punch_attendance->type_name = $input['type'];
                //     $punch_attendance->type_id = array_search($input['type'], config('constants.attendance_type'));
                //     if ($input['type'] == 'student') {
                //         $punch_attendance->roll_number = $attendanceFor['roll_no'];
                //     } else {
                //         $punch_attendance->emp_code = $attendanceFor['emp_code'];
                //     }
                //     $punch_attendance->check_in_time = $dateTime;
                //     $punch_attendance->name = $input['name'];
                //     $punch_attendance->date = $currentDate;
                //     $punch_attendance->save();

                // }
            }
            \DB::commit();
            \Log::info('successfully');
            return response()->json(['success' => true, 'message' => 'your attendances has been pushed successfully']);
        } catch (Exception $e) {
            \Log::info($e);
            \DB::rollback();
        }
    }

    public function getDeviceLogs(Request $request)
    {
        try {
            \DB::beginTransaction();
            $data = [];
            // $client = new Client();
            // $response = $client->get('http://localhost:1000/api/getEmployeeLogsOnly');
            // $data = json_decode($response->getBody(), true);
            $data = collect($request);
            // $data = json_encode($request);
            // \Log::info($data);
            // exit();
            foreach ($data as $key => $log) {
                // check if id exists
                if (isset($log['EmpNo'])) {
                    // NOTE: Convert timestamp to locale time zone
                    $offset   = 5 * 60 * 60;
                    $dateTime = date('Y-m-dTG:i:s.z', strtotime($log['KQDateTime']) - $offset);
                    $date     = date('Y-m-d', strtotime($log['KQDateTime']));
                    // Check if retrieved user is employee or student
                    if (str_contains($log['EmpNo'], 'U') == 1) {
                        $user = User::find(str_replace('U', '', $log['EmpNo']));
                        if (isset($log['KQDateTime']) && !empty($user)) {
                            $attendance_log                  = AttendanceLog::firstOrNew(['user_id' => $user->id, 'attendance_time' => $dateTime]);
                            $attendance_log->attendance_time = $dateTime;
                            $attendance_log->type_name       = 'employee';
                            $attendance_log->type_id         = 1;
                            $attendance_log->name            = $user->display_nam;
                            $attendance_log->emp_code        = $user->emp_code;
                            $attendance_log->user_id         = $user->id;
                            $attendance_log->date            = $date;
                            $attendance_log->punch_type      = config('constants.device_in_out_models')[$log['InOutModeID']] ?? '';
                            $attendance_log->punch_type_id   = $log['InOutModeID'] ?? '';
                            if (isset($log['MacSN'])) {
                                $attendance_log->organization_campus_id = config('constants.campus_machines')[$log['MacSN']] ?? '';
                            }
                            $attendance_log->save();
                        }
                    } else if (str_contains($log['EmpNo'], 'S') == 1) {
                        $student = Student::find(str_replace('S', '', $log['EmpNo']));
                        if (isset($log['KQDateTime']) && !empty($student)) {
                            $attendance_log                  = AttendanceLog::firstOrNew(['student_id' => $student->id, 'attendance_time' => $dateTime]);
                            $attendance_log->attendance_time = $dateTime;
                            $attendance_log->type_name       = 'student';
                            $attendance_log->type_id         = 0;
                            $attendance_log->name            = $student->student_name;
                            $attendance_log->roll_number     = $student->roll_no;
                            $attendance_log->student_id      = $student->id;
                            $attendance_log->date            = $date;
                            $attendance_log->punch_type      = config('constants.device_in_out_models')[$log['InOutModeID']] ?? '';
                            $attendance_log->punch_type_id   = $log['InOutModeID'] ?? '';
                            if (isset($log['MacSN'])) {
                                $attendance_log->organization_campus_id = config('constants.campus_machines')[$log['MacSN']] ?? '';
                            }
                            $attendance_log->save();
                        }
                    }
                }
            }
            \DB::commit();
            return response()->json(['success' => true, 'message' => 'Attendance logs has been pushed to the server successfully!'], 200);
        } catch (\GuzzleHttp\Exception\BadResponseException $e) {
            \DB::rollback();
            \Log::info($e);
            return response()->json(['success' => false, 'message' => $e], 500);
        }
    }

}
