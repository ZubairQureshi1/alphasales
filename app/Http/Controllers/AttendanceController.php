<?php

namespace App\Http\Controllers;

use App\Exports\Attendances\EmployeeAttendancesExport;
use App\Models\Attendance;
use App\Models\AttendanceLog;
use App\Models\DepartmentUser;
use App\Models\OrganizationCampusWing;
use App\Models\SessionCourse;
use App\Models\Student;
use App\Models\TimeSlot;
use App\Models\Wing;
use App\Models\department as Department;
use App\User;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class AttendanceController extends Controller
{
	public function calculateStudentAttendance(Request $request)
	{
		try {
			\DB::beginTransaction();
			$input          = $request->all();
			$start_date_obj = new \DateTime($input['start_date']);
			$end_date_obj   = new \DateTime($input['end_date']);
			$studentsQuerry;

			$students;
			// if (!isset($input['course_id']) && !isset($input['section_id'])) {
			$students = Student::where('session_id', '=', SystemSession::get('selected_session_id'))
				->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
				->where('course_id', '=', $input['course_id'])
				->where('affiliated_body_id', '=', $input['affiliated_body_id'])
				->where('shift_id', '=', $input['shift_id'])
				->whereHas('studentAcademicHistories', function ($query) use ($input) {
					return $query->where('semester', $input['term_id']);
				})
				->whereHas('studentAcademicHistories', function ($q) use ($input) {
					$q->where('is_promoted', false)->whereIn('id', function ($query) use ($input) {
						$query->select('student_academic_history_id')->where('section_detail_id', $input['section_id'])->from('student_books');
					});
				})->get();
			// } else {
			//     $filteredStudents = Student::when($request->only(['course_id', 'session_id', 'section_id']), function ($querry, $filtersArray) {
			//         foreach ($filtersArray as $key => $value) {
			//             $querry->where($key, '=', $value);
			//         }
			//     })->get();
			//     $students = $filteredStudents;
			// }
			if (count($students) < 0) {
				Notify::error('No student found against these filters.', 'Not Found', $options = []);
				return redirect()->back();
			}
			$date_diff = $this->calculateDateDiff($start_date_obj, $end_date_obj);
			for ($i = 0; $i < $date_diff; $i++) {
				$start_date_obj = new \DateTime($input['start_date']);
				$date_increment = $start_date_obj->modify('+' . $i . ' day');
				$day_of_date    = $date_increment->format('D');
				foreach ($students as $key => $student) {
					if ($day_of_date != 'Sun') {
						$student_attendance_check = Attendance::where('student_id', '=', $student->id)->where('date', '=', $date_increment->format('Y-m-d'))->get();
						if (empty($student_attendance_check) || count($student_attendance_check) == 0) {
							$student_attendance_check = $student_attendance_check->first();
							$attendance_logs          = AttendanceLog::where('student_id', '=', $student->id)->where('date', '=', $date_increment->format('Y-m-d'))->get();
							if ($attendance_logs != null && count($attendance_logs) > 0) {
								$attendance_log_first               = $attendance_logs->first();
								$attendance                         = new Attendance();
								$attendance->check_in_time          = $attendance_log_first->attendance_time;
								$attendance->type_name              = config('constants.attendance_types')[0];
								$attendance->type_id                = 0;
								$attendance->name                   = $student->student_name;
								$attendance->roll_number            = $student->roll_no;
								$attendance->student_id             = $student->id;
								$attendance->date                   = $date_increment->format('Y-m-d');
								$attendance->academic_history_id    = $student->studentAcademicHistories->last()->id;
								$attendance->organization_campus_id = $student->organization_campus_id;

								if ($attendance_log_first->attendance_time != null && $attendance_log_first->attendance_time != '') {
									$attendance->status    = config('constants.attendance_statuses')[1];
									$attendance->status_id = 1;
								} else {
									$attendance->status    = config('constants.attendance_statuses')[0];
									$attendance->status_id = 0;
								}
								if (count($attendance_logs->toArray()) > 1) {
									$attendance_log_last        = $attendance_logs->last();
									$attendance->check_out_time = $attendance_log_last->attendance_time;
									if ($attendance_log_last->attendance_time != null && $attendance_log_last->attendance_time != '') {
										$attendance->status    = config('constants.attendance_statuses')[1];
										$attendance->status_id = 1;
									}
								}
								$attendance->save();
							} else {
								$attendance                         = new Attendance();
								$attendance->type_name              = config('constants.attendance_types')[0];
								$attendance->type_id                = 0;
								$attendance->name                   = $student->student_name;
								$attendance->roll_number            = $student->roll_no;
								$attendance->date                   = $date_increment->format('Y-m-d');
								$attendance->status                 = config('constants.attendance_statuses')[0];
								$attendance->student_id             = $student->id;
								$attendance->academic_history_id    = $student->studentAcademicHistories->last()->id;
								$attendance->organization_campus_id = $student->organization_campus_id;
								$attendance->status_id              = 0;
								$attendance->save();
							}
						}
					} else {
						$attendance                         = new Attendance();
						$attendance->type_name              = config('constants.attendance_types')[0];
						$attendance->type_id                = 0;
						$attendance->name                   = $student->student_name;
						$attendance->roll_number            = $student->roll_no;
						$attendance->date                   = $date_increment->format('Y-m-d');
						$attendance->status                 = config('constants.attendance_statuses')[3];
						$attendance->student_id             = $student->id;
						$attendance->academic_history_id    = $student->studentAcademicHistories->last()->id;
						$attendance->organization_campus_id = $student->organization_campus_id;
						$attendance->status_id              = 3;
						$attendance->save();
					}
				}
			}
			\DB::commit();

			Notify::success('Attendance calculated successfully.', 'Success', $options = []);
			return redirect()->back();
		} catch (\Exception $e) {
			\DB::rollback();
			dd($e);
		}
		// return redirect(route('attendance.getStudentAttendances'));
	}


	public function calculateAttendance(Request $request)
	{
		try {
			\DB::beginTransaction();
			$request->validate([
				'start_date' => 'required|date',
				'end_date' => 'required|date',
			]);
			$input          = $request->all();
			$start_date_obj = new \DateTime($input['start_date']);
			$end_date_obj   = new \DateTime($input['end_date']);
			if (isset($input['is_all_selected']) && $input['is_all_selected'] == 'on') {
				$input['users'] = User::whereHas('campusDetails', function($query) {
					return $query->where('organization_campus_id', SystemSession::get('organization_campus_id'));
				})->orderBy('name')->pluck('id')->toArray();
			}
			// NOTE: Loop through users
			foreach ($input['users'] as $key => $user) {
				$user           = User::find(isset($user['id']) ? $user['id'] : $user);
				$start_date_obj = new \DateTime($input['start_date']);
				// NOTE: Calculate date differences
				$date_diff = $this->calculateDateDiff($start_date_obj, $end_date_obj);
				// NOTE: Get user shifts accroding to the selected campus
				// $user_time_shifts = $user->shifts()
				//                          ->where('organization_campus_id', SystemSession::get('organization_campus_id'))
				//                          ->where('month_id', '=', $start_date_obj->format('m'))
				//                          ->where('year', '=', $start_date_obj->format('Y'))
				//                          ->get();
				for ($i = 0; $i < $date_diff; $i++) {
					$start_date_obj   = new \DateTime($input['start_date']);
					$date_increment   = $start_date_obj->modify('+' . $i . ' day');
					$user_time_shifts = $user_time_shifts = $user->shifts()
																->where('organization_campus_id', SystemSession::get('organization_campus_id'))
																->where('date', '=', $date_increment)
																->get();
					// NOTE: user timeshift loop
					foreach ($user_time_shifts as $key => $user_time_shift) {
						if (!empty($user_time_shift) && $user_time_shift != null) {
							$user_shift = $user_time_shift;
							$attendance = Attendance::where('date', '=', $date_increment->format('Y-m-d'))
													->where('time_slot_id', '=', $user_shift->time_slot_id)
													->where('user_id', '=', $user->id)
													->where('organization_campus_id', SystemSession::get('organization_campus_id'))
													->get();

							if (empty($attendance->toArray()) && count($attendance->toArray()) == 0) {
								if ($user_shift->is_week_day) {
									$single_day_logs = AttendanceLog::where('user_id', '=', $user->id)
																	->where('date', '=', $date_increment->format('Y-m-d'))
																	->where('organization_campus_id', SystemSession::get('organization_campus_id'))
																	->get();

									// NOTE: If there is log available
									if (!empty($single_day_logs->toArray()) && $single_day_logs != null) {
										// NOTE: find the timeslot which was assigned to the user
										$shift_time_slot = TimeSlot::find($user_shift->time_slot_id);
										// NOTE: If time slot is not empty
										if ($shift_time_slot != null) {
											$first_single_day_log   = $single_day_logs->first();
											$shift_buffer_start_obj = new \DateTime($shift_time_slot->buffer_start_time, new \DateTimeZone('PKT'));
											$shift_buffer_end_obj   = new \DateTime($shift_time_slot->buffer_end_time, new \DateTimeZone('PKT'));
											$shift_checkout_time    = new \DateTime($shift_time_slot->end_time, new \DateTimeZone('PKT'));
											// NOTE: Create a new attendance
											$attendance                           = new Attendance();
											$attendance->organization_campus_id   = $first_single_day_log->organization_campus_id;
											$attendance->check_in_time            = $first_single_day_log->attendance_time;
											$attendance->status                   = config('constants.attendance_statuses')[1];
											$attendance->status_id                = 1;
											$attendance->type_name                = config('constants.attendance_types')[1];
											$attendance->type_id                  = 1;
											$attendance->name                     = $user->display_name;
											$attendance->emp_code                 = $user->emp_code;
											$attendance->user_id                  = $user->id;
											$attendance->time_slot_name           = $shift_time_slot->name . ' (' . $shift_time_slot->start_time . ' - ' . $shift_time_slot->end_time . ')';
											$attendance->time_slot_id             = $shift_time_slot->id;
											$attendance->date                     = $date_increment->format('Y-m-d');
											$shift_buffer_start_with_log_date_obj = new \DateTime($first_single_day_log->date . ' ' . $shift_buffer_start_obj->format('H:i:s'), new \DateTimeZone('PKT'));
											$shift_buffer_end_with_log_date_obj   = new \DateTime($first_single_day_log->date . ' ' . $shift_buffer_end_obj->format('H:i:s'), new \DateTimeZone('PKT'));
											$shift_checkout_with_log_date_obj     = new \DateTime($first_single_day_log->date . ' ' . $shift_checkout_time->format('H:i:s'), new \DateTimeZone('PKT'));
											$checkin_obj                          = new \DateTime($first_single_day_log->attendance_time);
											$checkin_obj->setTimezone(new \DateTimeZone('PKT'));

											// NOTE: check if checkin is late
											if ($checkin_obj > $shift_buffer_end_with_log_date_obj) {
												$attendance->is_late_checkin = true;
												$attendance->status          = config('constants.attendance_statuses')[4];
												$attendance->status_id       = 4;
											} else if ($checkin_obj >= $shift_buffer_start_with_log_date_obj && $checkin_obj <= $shift_buffer_end_with_log_date_obj) {
												$attendance->is_on_time_checkin = true;
												$attendance->status             = config('constants.attendance_statuses')[5];
												$attendance->status_id          = 5;
											} else if ($checkin_obj < $shift_buffer_start_with_log_date_obj) {
												$attendance->is_early_checkin = true;
												$attendance->status           = config('constants.attendance_statuses')[6];
												$attendance->status_id        = 6;
											}

											if (count($single_day_logs) > 1) {
												$last_single_day_log = $single_day_logs->last();
												if (!empty($last_single_day_log)) {
													$checkout_obj = new \DateTime($last_single_day_log->attendance_time);
													$checkout_obj->setTimezone(new \DateTimeZone('PKT'));
													if ($checkout_obj > $shift_checkout_with_log_date_obj) {
														$attendance->is_late_checkout = true;
													} else if ($checkout_obj == $shift_checkout_with_log_date_obj) {
														$attendance->is_on_time_checkout = true;
													} else if ($checkout_obj < $shift_checkout_with_log_date_obj) {
														$attendance->is_early_checkout = true;
													}
													$attendance->check_out_time = $last_single_day_log->attendance_time;
												}
											}
											if (($attendance->check_out_time != null && !empty($attendance->check_out_time)) && ($attendance->check_in_time != null && !empty($attendance->check_in_time))) {
												$checkInTime               = new \DateTime($attendance->check_in_time, new \DateTimeZone('PKT'));
												$checkOutTime              = new \DateTime($attendance->check_out_time, new \DateTimeZone('PKT'));
												$working_hour              = date_diff($checkOutTime, $checkInTime)->format('%h:%i');
												$attendance->working_hours = $working_hour;
											}
											$attendance->save();
										}
									}
									// NOTE: if no log then create attendance with absent
									else {
										$attendance                 = new Attendance();
										$attendance->type_name      = config('constants.attendance_types')[1];
										$attendance->type_id        = 1;
										$attendance->name           = $user->display_name;
										$attendance->emp_code       = $user->emp_code;
										$attendance->user_id        = $user->id;
										$shift_time_slot            = TimeSlot::find($user_shift->time_slot_id);
										$attendance->time_slot_name = $shift_time_slot->name . ' (' . $shift_time_slot->start_time . ' - ' . $shift_time_slot->end_time . ')';
										$attendance->time_slot_id   = $shift_time_slot->id;
										$attendance->date           = $date_increment->format('Y-m-d');
										$attendance->status         = config('constants.attendance_statuses')[0];
										$attendance->status_id      = 0;
										$attendance->organization_campus_id   = SystemSession::get('organization_campus_id');
										$attendance->save();
									}
								}
								// NOTE: If day is off day then set it to off day
								else {
									$attendance             = new Attendance();
									$attendance->type_name  = config('constants.attendance_types')[1];
									$attendance->type_id    = 1;
									$attendance->name       = $user->display_name;
									$attendance->emp_code   = $user->emp_code;
									$attendance->user_id    = $user->id;
									$attendance->date       = $date_increment->format('Y-m-d');
									$attendance->status     = config('constants.attendance_statuses')[3];
									$attendance->status_id  = 3;
									$attendance->is_day_off = 3;
									$attendance->organization_campus_id   = SystemSession::get('organization_campus_id');
									$attendance->save();
								}
							}
						}
					}
				}
			}
			\DB::commit();
			// \DB::rollback();
		} catch (\Exception $e) {
			\DB::rollback();
			dd($e);
		}
		return redirect(route('attendance.getEmployeeAttendances'));
	}

	public function sortFunction($a, $b)
	{
		return strtotime($a) - strtotime($b);
	}

	public function isOnLeave($id)
	{
		$attendance              = Attendance::find($id);
		$attendance->status      = config('constants.attendance_statuses')[2];
		$attendance->status_id   = 2;
		$attendance->is_on_leave = true;
		$attendance->update();
// return redirect(route('attendance.getStudentAttendances'));
		return response()->json(['success' => true, 'message' => 'Leave Applied Successfully.'], 200);
	}

	public function calculateDateDiff($start, $end)
	{
		if ($end >= $start) {
			$diff = date_diff($end, $start);
			$diff = $diff->days + $diff->invert;
			if ($diff == 0) {
				$diff = 1;
			}
			return $diff;
		} else {
			dd('from 0');
			return 0;
		}
	}

	public function studentAttendanceSummary(Request $request)
	{
		return view('attendance.students.index_student_summary');
	}

	public function getFilteredStudents(Request $request)
	{
		$input            = $request->all();
		$filteredStudents = Student::when($input, function ($querry, $filtersArray) {
			foreach ($filtersArray as $key => $value) {
				if ($key == 'course_id' || $key == 'session_id' || $key == 'section_id') {
					$querry->where($key, '=', $value);
				}
			}
		})->get();
		$students = $filteredStudents;
		return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'attendances', 'students' => $students]], 200);
	}

	public function generateAttendanceSummary(Request $request)
	{
		$input                = $request->all();
		$filtered_attendances = Attendance::whereHas('student', function ($query) use ($input) {
			if (isset($input['session_id'])) {
				$query->where("session_id", $input['session_id']);
			}
			if (isset($input['course_id'])) {
				$query->where('course_id', $input['course_id']);
			}
		})->when($input, function ($querry, $filtersArray) {
			$querry->where('type_id', '=', '0');
			foreach ($filtersArray as $key => $value) {
				if ($key == 'student_id' || $key == 'status_id') {
					$querry->where($key, '=', $value);
				} else if ($key == 'start_date') {
					$querry->where('date', '>=', $value);
				} else if ($key == 'end_date') {
					$querry->where('date', '<=', $value);
				} else if ($key == 'end_date') {
					$querry->where('date', '<=', $value);
				}
			}
		});
		if ($input['summary_type_id'] == 1) {
			$filtered_attendances = $filtered_attendances->with('student')->get();
			if (isset($input['session_id']) && !isset($input['course_id'])) {

				$view = view('attendance.students.overall_attendance_session_wise_summary')->with('filtered_attendances', $filtered_attendances);
				$view = $view->render();
				return response()->json(['success' => true, 'message' => 'Data retrieved successfully.', 'data' => ['module_name' => 'attendances', 'view' => $view]], 200);
			}
			if (!isset($input['session_id']) && isset($input['course_id'])) {

				$view = view('attendance.students.overall_attendance_course_wise_summary')->with('filtered_attendances', $filtered_attendances);
				$view = $view->render();
				return response()->json(['success' => true, 'message' => 'Data retrieved successfully.', 'data' => ['module_name' => 'attendances', 'view' => $view]], 200);
			}
			if (isset($input['session_id']) && isset($input['course_id'])) {

				$view = view('attendance.students.overall_attendance_course_wise_summary')->with('filtered_attendances', $filtered_attendances);
				$view = $view->render();
				return response()->json(['success' => true, 'message' => 'Data retrieved successfully.', 'data' => ['module_name' => 'attendances', 'view' => $view]], 200);
			}
			dd($filtered_attendances->groupBy('student.course_name')->toArray());
		} else {
			$filtered_attendances = $filtered_attendances->get();
			$view                 = view('attendance.students.individual_attendance_summary');
			$view                 = $view->render();
			return response()->json(['success' => true, 'message' => 'Data retrieved successfully.', 'data' => ['module_name' => 'attendances', 'attendances' => $filtered_attendances, 'view' => $view]], 200);
		}
	}

	public function manualAttendance(Request $request, $id)
	{
		$input                   = $request->all();
		$attendance              = Attendance::find($id);
		$attendance->status      = config('constants.attendance_statuses')[1];
		$attendance->status_id   = 1;
		$attendance->is_on_leave = false;
// $check_in_time_obj = new \DateTime($attendance->date . ' ' . $input['check_in_time'], new \DateTimeZone('PKT'));
		// $check_out_time_obj = new \DateTime($attendance->date . ' ' . $input['check_out_time'], new \DateTimeZone('PKT'));
		$check_in_time_obj  = new \DateTime();
		$check_out_time_obj = new \DateTime();
// $checkin_time_utc = $check_in_time_obj->setTimezone(new \DateTimeZone('UTC'));
		// $checkout_time_utc = $check_out_time_obj->setTimezone(new \DateTimeZone('UTC'));
		$attendance->check_in_time  = $check_in_time_obj->format('Y-m-dTh:i:s');
		$attendance->check_out_time = $check_out_time_obj->format('Y-m-dTh:i:s');
		$attendance->update();
		$return_checkin_time  = $check_in_time_obj->setTimezone(new \DateTimeZone('PKT'))->format('Y-m-d h:i A');
		$return_checkout_time = $check_out_time_obj->setTimezone(new \DateTimeZone('PKT'))->format('Y-m-d h:i A');
// return redirect(route('attendance.getStudentAttendances'));
		return response()->json(['success' => true, 'message' => 'Manual Attendance Updated Successfully.', 'data' => ['check_in_time' => $return_checkin_time, 'check_out_time' => $return_checkout_time]], 200);
	}
	// public function setPaper($paper, $orientation = 'portrait'){
	//     $this->paper = $paper;
	//     $this->orientation = $orientation;
	//     $this->dompdf->setPaper($paper, $orientation);
	//     return $this;
	// }

	public function getStudentAttendances(Request $request)
	{
		$courses = SessionCourse::where('session_id', '=', SystemSession::get('selected_session_id'))
			->whereIn('wing_id', OrganizationCampusWing::where('organization_campus_id', SystemSession::get('organization_campus_id'))->pluck('wing_id'))
			->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))
			->where('is_active', true)
			->orderBy('course_id', 'ASC')
			->get()
			->pluck('course_name', 'course_id');

		$filters_configuration = [
			'addFilters'    => true,
			'route'         => '../studentAttendances',
			'can_filters'   => true,
			'clear_filters' => true,
			'js_path'       => asset('js/filters/filters.js'),
			'filters'       => [
				'users'                => false,
				'students'             => false,
				'courses'              => true,
				'parts'                => false,
				'sessions'             => false,
				'subjects'             => false,
				'roles'                => false,
				'admission_forms'      => false,
				'departments'          => false,
				'designations'         => false,
				'sections'             => false,
				'visitor_users'        => false,
				'admission_types'      => false,
				'end_of_registrations' => false,
				'heads'                => false,
				'fee_structure_types'  => false,
				'payment_statuses'     => false,
				'voucher_statuses'     => false,
				'start_date'           => true,
				'end_date'             => true,
			],
			'data'          => [
				'courses' => $courses,
			],
		];

		try {
			if ($request->ajax()) {
				$input        = $request->all();
				$filtersArray = explode(';', $input['filters']);
// \Log::info($filtersArray);
				$filteredStudents = Student::when($filtersArray, function ($querry, $filtersArray) {
					$querry->where('is_end_of_reg', '=', 0);
					foreach ($filtersArray as $key => $value) {
						if ($key < (sizeof($filtersArray) - 1)) {
							$filter = explode(':', $value);
// if ($filter[0] == 'student_id') {
							//     $querry->where('id', '=', $filter[1]);
							// } else {
							// }
							if ($filter[0] == 'course_id' || $filter[0] == 'session_id' || $filter[0] == 'section_id' || $filter[0] == 'is_end_of_reg' || $filter[0] == 'student_category_id') {
								$querry->where($filter[0], '=', $filter[1]);
							}
						}
					}
				})->with('attendances')->get();
// $studentsWithHeads;
				// foreach ($filtersArray as $key => $value) {
				//     if ($key < (sizeof($filtersArray) - 1)) {
				//         $filter = explode(':', $value);
				//         if ($filter[0] == 'head_id') {
				//             foreach ($filteredStudents as $key => $student) {
				//                 $studentHeads = HeadFineStudent::where('student_id', '=', $student['id'])->where($filter[0], '=', $filter[1])->get();
				//             }
				//         }
				//     }
				// }
				$students = $filteredStudents;
				foreach ($students as $index => $student) {
					foreach ($student->attendances as $index => $value) {

						$check_in_UTC  = $value['check_in_time'];
						$check_out_UTC = $value['check_out_time'];
						if ($check_in_UTC != null && $check_in_UTC != '') {
							$check_in_UTC = new DateTime($value['check_in_time']);
							$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
							$student->attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('Y-m-d h:i A');
// $attendances[$index]['check_in_time_gmt'] = $check_in_UTC;
						}
						if ($check_out_UTC != null && $check_out_UTC != '') {

							$check_out_UTC = new DateTime($value['check_out_time']);
							$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
// $attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:i A');
							$student->attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:i A');
						}
// dd($value['check_out_time_gmt']);
					}
				}
// dd($students);
				return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'student_attendances', 'students' => $students]], 200);
			} else {
				$wings = Wing::all()->pluck('name', 'id');
				return view('attendance.student_index')->with(['wings' => $wings])->with(['filters_configuration' => $filters_configuration]);
			}

		} catch (\Exception $e) {
			dd($e);
			\Log::info($e);
		}

	}
	public function getEmployeeAttendances(Request $request)
	{
		$filters_configuration = [
			'addFilters'    => true,
			'route'         => '../employeeAttendances',
			'can_filters'   => true,
			'clear_filters' => true,
			'js_path'       => asset('js/filters/employee_attendance.js'),
			'filters'       => [
				'attendance_type'      => true,
				'users'                => true,
				'departments'          => true,
				'visitor_users'        => false,
				'students'             => false,
				'courses'              => false,
				'parts'                => false,
				'sessions'             => false,
				'visitor_users'        => false,
				'subjects'             => false,
				'roles'                => false,
				'admission_forms'      => false,
				'departments'          => false,
				'designations'         => false,
				'sections'             => false,
				'admission_types'      => false,
				'end_of_registrations' => false,
				'heads'                => false,
				'fee_structure_types'  => false,
				'payment_statuses'     => false,
				'voucher_statuses'     => false,
				'start_date'           => true,
				'end_date'             => true,
			],
		];

		try {
			if ($request->ajax()) {
				$input        = $request->all();
				$filtersArray = explode(';', $input['filters']);
				$filters      = [];
				foreach ($filtersArray as $key => $value) {
					if ($key < (sizeof($filtersArray) - 1)) {
						$filter              = explode(':', $value);
						$filters[$filter[0]] = $filter[1];
					}
				}
				if (isset($filters['user_id'])) {

					$filtered_users = User::where('id', '=', $filters['user_id'])->get();
				} else {
					$filtered_users = User::get();
				}
				foreach ($filtered_users as $key => $value) {
					$user = $value;
// dd($user->attendances);
					$attendances = $user->attendances()
						->where('date', '>=', isset($filters['start_date']) ? $filters['start_date'] : '')
						->where('date', '<=', isset($filters['end_date']) ? $filters['end_date'] : '')
						->where('organization_campus_id', SystemSession::get('organization_campus_id'))
						->orderBy('date', 'asc')
						->get();
					foreach ($attendances as $index => $value) {
						$check_in_UTC                         = $value['check_in_time'];
						$attendance_date                      = new DateTime($value['date']);
						$attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y');
						$check_out_UTC                        = $value['check_out_time'];
						if ($check_in_UTC != null && $check_in_UTC != '') {
							$check_in_UTC = new DateTime($value['check_in_time']);
							$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
							$attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
						}
						if ($check_out_UTC != null && $check_out_UTC != '') {
							$check_out_UTC = new DateTime($value['check_out_time']);
							$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
							$attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
						}
					}
					$filtered_users[$key]->late_arrivals     = $attendances->where('status_id', '=', 4)->count();
					$filtered_users[$key]->absents           = $attendances->where('status_id', '=', 0)->count();
					$filtered_users[$key]->missing_checkouts = $attendances->where('is_day_off', '=', false)->where('check_out_time', '=', null)->count();
					$filtered_users[$key]->attendances       = $attendances;
				}
				return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'employee_attendances', 'user' => $filtered_users]], 200);
			} else {
				$users = User::whereHas('campusDetails', function($query) {
					return $query->where('organization_campus_id', SystemSession::get('organization_campus_id'));
				})->orderBy('name')->pluck('display_name', 'id');
				return view('attendance.employee_index')->with(['filters_configuration' => $filters_configuration, 'users' => $users]);
			}

		} catch (\Exception $e) {
			\Log::info($e);
			dd($e);
		}
	}

	public function getEmployeeFilteredData(Request $request)
	{
		$input               = $request->params;
		$employeeAttendances = [];
		try {
			// NOTE: Check if reporting type
			if ($input['report_type_id'] == 0) {
				// type is department
				// NOTE: check if user is not selected
				if (isset($input['department_id']) && !empty($input['department_id'])) {
					$departments = Department::where('id', $input['department_id'])
											->campus(SystemSession::get('organization_campus_id'))
											->active(true)
											->orderBy('name')
											->get();
				} else {
					$departments = Department::campus(SystemSession::get('organization_campus_id'))->active(true)->orderBy('name')->get();
				}
				foreach ($departments as $department) {
					$users = User::whereHas('departmentUsers', function ($query) use ($department) {
								return $query->where('department_id', $department->id);
							})
							->whereHas('campusDetails', function ($query) {
								return $query->where('organization_campus_id', SystemSession::get('organization_campus_id'));
							})
							->orderBy('name')
							->get();
					// NOTE: Loop through filtered users
					foreach ($users as $user_key => $user) {
						$employeeAttendances[] = $user;
						$attendances = $user->attendances()
											->where('date', '>=', $input['start_date'] ?? '')
											->where('date', '<=', $input['end_date'] ?? '')
											->orderBy('date', 'asc')
											->where('organization_campus_id', SystemSession::get('organization_campus_id'))
											->get();

						$employeeAttendances[$user_key]->selected_department = optional(DepartmentUser::where('user_id', $user->id)->where('department_id', $department->id)->first()->department)->name ?? '---';
						foreach ($attendances as $index => $attendance) {
							if (isset($attendance)) {
								$check_in_UTC                        	 = $attendance['check_in_time'];
								$attendance_date                      = new DateTime($attendance['date']);
								$attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y');
								$check_out_UTC                        = $attendance['check_out_time'];
								if ($check_in_UTC != null && $check_in_UTC != '') {
									$check_in_UTC = new DateTime($attendance['check_in_time']);
									$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
									$attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
								}
								if ($check_out_UTC != null && $check_out_UTC != '') {
									$check_out_UTC = new DateTime($attendance['check_out_time']);
									$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
									$attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
								}
							}
						}
						if (isset($attendances)) {
							$employeeAttendances[$user_key]->late_arrivals     = $attendances->where('status_id', '=', 4)->count();
							$employeeAttendances[$user_key]->absents           = $attendances->where('status_id', '=', 0)->count();
							$employeeAttendances[$user_key]->missing_checkouts = $attendances->where('status_id', '!=', 0)->where('is_day_off', '=', false)->where('check_out_time', '=', null)->count();
							$employeeAttendances[$user_key]->attendances       = $attendances;
						}
					}

				}
				// return($employeeAttendances);
				return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'department_attendances', 'user' => $employeeAttendances]], 200);
			} elseif ($input['report_type_id'] == 1) {
				// type is user
				if (isset($input['user_id']) && !empty($input['user_id'])) {
					$users = User::where('id', $input['user_id'])->whereHas('campusDetails', function ($query) {
						return $query->where('organization_campus_id', SystemSession::get('organization_campus_id'));
					})
					->orderBy('name')
					->get();
				} else {
					$users = User::whereHas('campusDetails', function ($query) {
						return $query->where('organization_campus_id', SystemSession::get('organization_campus_id'));
					})
					->orderBy('name')
					->get();
				}

				foreach ($users as $user_key => $user) {
					$employeeAttendances[] = $user;
					$attendances           = $user->attendances()
						->where('date', '>=', $input['start_date'] ?? '')
						->where('date', '<=', $input['end_date'] ?? '')
						->where('organization_campus_id', SystemSession::get('organization_campus_id'))
						->orderBy('date', 'asc')
						->get();
						// dump($attendances);
					foreach ($attendances as $index => $attendance) {
						$check_in_UTC                         = $attendance['check_in_time'];
						$attendance_date                      = new DateTime($attendance['date']);
						$attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y');
						$check_out_UTC                        = $attendance['check_out_time'];
						if ($check_in_UTC != null && $check_in_UTC != '') {
							$check_in_UTC = new DateTime($attendance['check_in_time']);
							$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
							$attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
						}
						if ($check_out_UTC != null && $check_out_UTC != '') {
							$check_out_UTC = new DateTime($attendance['check_out_time']);
							$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
							$attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
						}
					}
					$employeeAttendances[$user_key]->late_arrivals     = $attendances->where('status_id', '=', 4)->count();
					$employeeAttendances[$user_key]->absents           = $attendances->where('status_id', '=', 0)->count();
					$employeeAttendances[$user_key]->missing_checkouts = $attendances->where('status_id', '!=', 0)->where('is_day_off', '=', false)->where('check_out_time', '=', null)->count();
					$employeeAttendances[$user_key]->attendances       = $attendances;
				}
			}
			return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'employee_attendances', 'user' => $employeeAttendances]], 200);
		} catch (Exception $e) {
			dd($e);
		}
	}

	public function export($id, Request $request)
	{
		$array = [
			'id'         => $id,
			'start_date' => $request->start_date,
			'end_date'   => $request->end_date,
		];
		ob_end_clean();
		return (new EmployeeAttendancesExport($array))->download(date('Y-m-d') . '-' . rand() . '-EmployeeAttendancesExport.xlsx');
// return (new EmployeeAttendancesExport($id))->download('EmployeeAttendancesExport.xlsx');
		// return Excel::download(new EmployeeAttendancesExport($id), 'EmployeeAttendancesExport.xlsx');
	}
	public function exportOverAllMonthlyExcel($id)
	{
		return (new EmployeeOverallAttendanceExport())->download('EmployeeAttendancesExport.xlsx');
// return (new EmployeeAttendancesExport($id))->download('EmployeeAttendancesExport.xlsx');
		// return Excel::download(new EmployeeAttendancesExport($id), 'EmployeeAttendancesExport.xlsx');
	}

	public function getEmployeeLateReporting(Request $request)
	{
		$input = $request->all();
		if ($request->ajax()) {
			$date                   = new \DateTime($input['date']);
			$today_late_attendances = Attendance::where('date', '=', $date->format('Y-m-d'))->where('is_late_checkin', '=', '1')->get();
			foreach ($today_late_attendances as $index => $value) {
				$time_slot    = TimeSlot::find($value['time_slot_id']);
				$check_in_UTC = $value['check_in_time'];

				$check_in_UTC = new DateTime($value['check_in_time']);
				$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
				$slot_start_time = new \DateTime($check_in_UTC->format('Y-m-d') . $time_slot->start_time, new \DateTimeZone('PKT'));
				$time_diff       = $check_in_UTC->diff($slot_start_time);

				$attendance_date                                 = new DateTime($value['date'] . ' 08:00:00', new \DateTimeZone('PKT'));
				$today_late_attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y H:i');
				$today_late_attendances[$index]['late_diff']     = $time_diff->format('%H:%I');
				$check_out_UTC                                   = $value['check_out_time'];
				if ($check_in_UTC != null && $check_in_UTC != '') {
					$today_late_attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
// $attendances[$index]['check_in_time_gmt'] = $check_in_UTC;
				}
				if ($check_out_UTC != null && $check_out_UTC != '') {
					$check_out_UTC = new DateTime($value['check_out_time']);
					$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
// $attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:i A');
					$today_late_attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
				}
// dd($value['check_out_time_gmt']);
			}
// dd($date);
			return response()->json(['late_attendances' => $today_late_attendances], 200);
		} else {
			$date                   = new \DateTime();
			$today_late_attendances = Attendance::where('date', '=', $date->format('Y-m-d'))->where('is_late_checkin', '=', '1')->get();
			return view('attendance.employeeReportings.late.index')->with('late_attendances', $today_late_attendances);
		}
	}

	public function getEmployeeDayWiseReporting(Request $request)
	{
		$input = $request->all();
		if ($request->ajax()) {
			$date                   = new \DateTime($input['date']);
			$today_late_attendances = Attendance::where('date', '=', $date->format('Y-m-d'))->get();
			foreach ($today_late_attendances as $index => $value) {
				$check_in_UTC                                    = $value['check_in_time'];
				$attendance_date                                 = new DateTime($value['date'] . ' 08:00:00', new \DateTimeZone('PKT'));
				$today_late_attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y H:i');
				$check_out_UTC                                   = $value['check_out_time'];
				if ($check_in_UTC != null && $check_in_UTC != '') {
					$check_in_UTC = new DateTime($value['check_in_time']);
					$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
					$today_late_attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
// $attendances[$index]['check_in_time_gmt'] = $check_in_UTC;
				}
				if ($check_out_UTC != null && $check_out_UTC != '') {
					$check_out_UTC = new DateTime($value['check_out_time']);
					$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
// $attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:i A');
					$today_late_attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
				}
				if ($value['is_late_checkin']) {
					$today_late_attendances[$index]['custom_status'] = 'Late';
				} else if ($value['is_on_time_checkin']) {
					$today_late_attendances[$index]['custom_status'] = 'On-Time';
				} else if ($value['is_early_checkin']) {
					$today_late_attendances[$index]['custom_status'] = 'Early';
				}
// dd($value['check_out_time_gmt']);
			}
// dd($date);
			return response()->json(['late_attendances' => $today_late_attendances], 200);
		} else {
			$date                   = new \DateTime();
			$today_late_attendances = Attendance::where('date', '=', $date->format('Y-m-d'))->get();
			return view('attendance.employeeReportings.daywise.index')->with('late_attendances', $today_late_attendances);
		}
	}

	public function getEmployeeAbsentReporting(Request $request)
	{
		$input = $request->all();
		if ($request->ajax()) {
			$date                   = new \DateTime($input['date']);
			$today_late_attendances = Attendance::where('date', '=', $date->format('Y-m-d'))->where('status_id', '=', '0')->get();
			foreach ($today_late_attendances as $index => $value) {
				$check_in_UTC                                    = $value['check_in_time'];
				$attendance_date                                 = new DateTime($value['date'] . ' 08:00:00', new \DateTimeZone('PKT'));
				$today_late_attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y H:i');
				$check_out_UTC                                   = $value['check_out_time'];
				if ($check_in_UTC != null && $check_in_UTC != '') {
					$check_in_UTC = new DateTime($value['check_in_time']);
					$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
					$today_late_attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
// $attendances[$index]['check_in_time_gmt'] = $check_in_UTC;

				}
				if ($check_out_UTC != null && $check_out_UTC != '') {
					$check_out_UTC = new DateTime($value['check_out_time']);
					$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
// $attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('Y-m-d h:i A');
					$today_late_attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
				}
				if ($value['is_late_checkin']) {
					$today_late_attendances[$index]['custom_status'] = 'Late';
				} else if ($value['is_on_time_checkin']) {
					$today_late_attendances[$index]['custom_status'] = 'On-Time';
				} else if ($value['is_early_checkin']) {
					$today_late_attendances[$index]['custom_status'] = 'Early';
				}
// dd($value['check_out_time_gmt']);
			}
// dd($date);
			return response()->json(['late_attendances' => $today_late_attendances], 200);
		} else {
			$date                   = new \DateTime();
			$today_late_attendances = Attendance::where('date', '=', $date->format('Y-m-d'))->where('status_id', '=', '0')->get();
			return view('attendance.employeeReportings.absent.index')->with('late_attendances', $today_late_attendances);
		}
	}

	public function getVisitorEmployeeAttendances(Request $request)
	{
		$filters_configuration = [
			'addFilters'    => true,
			'route'         => '../visitorEmployeeAttendances',
			'can_filters'   => true,
			'clear_filters' => true,
			'js_path'       => asset('js/filters/visitor_employee_attendance.js'),
			'filters'       => [
				'visitor_users'        => true,
				'users'                => false,
				'students'             => false,
				'courses'              => false,
				'parts'                => false,
				'sessions'             => false,
				'subjects'             => false,
				'roles'                => false,
				'admission_forms'      => false,
				'departments'          => false,
				'designations'         => false,
				'sections'             => false,
				'admission_types'      => false,
				'end_of_registrations' => false,
				'heads'                => false,
				'fee_structure_types'  => false,
				'payment_statuses'     => false,
				'voucher_statuses'     => false,
				'start_date'           => true,
				'end_date'             => true,
			],
		];

		try {
			if ($request->ajax()) {
				$input        = $request->all();
				$filtersArray = explode(';', $input['filters']);
				$filters      = [];
				foreach ($filtersArray as $key => $value) {
					if ($key < (sizeof($filtersArray) - 1)) {
						$filter              = explode(':', $value);
						$filters[$filter[0]] = $filter[1];
					}
				}
				if (isset($filters['user_id'])) {

					$filtered_users = User::where('id', '=', $filters['user_id'])->where('faculty_type', 1)->get();
				} else {
					$filtered_users = User::where('faculty_type', 1)->get();
				}
// \Log::info($filtersArray);
				foreach ($filtered_users as $key => $value) {
					$user = $value;
// dd($user->attendances);
					$attendances = $user->attendances()->where('date', '>=', isset($filters['start_date']) ? $filters['start_date'] : '')->where('date', '<=', isset($filters['end_date']) ? $filters['end_date'] : '')->get();
					foreach ($attendances as $index => $value) {
						$check_in_UTC                         = $value['check_in_time'];
						$attendance_date                      = new DateTime($value['date']);
						$attendances[$index]['date_formated'] = $attendance_date->format('l, d-M-Y');
						$check_out_UTC                        = $value['check_out_time'];
						if ($check_in_UTC != null && $check_in_UTC != '') {
							$check_in_UTC = new DateTime($value['check_in_time']);
							$check_in_UTC->setTimezone(new \DateTimeZone('PKT'));
							$attendances[$index]['check_in_time_gmt'] = $check_in_UTC->format('h:i A');
						}
						if ($check_out_UTC != null && $check_out_UTC != '') {
							$check_out_UTC = new DateTime($value['check_out_time']);
							$check_out_UTC->setTimezone(new \DateTimeZone('PKT'));
							$attendances[$index]['check_out_time_gmt'] = $check_out_UTC->format('h:i A');
						}
					}
					$filtered_users[$key]->late_arrivals     = $attendances->where('status_id', '=', 4)->count();
					$filtered_users[$key]->absents           = $attendances->where('status_id', '=', 0)->count();
					$filtered_users[$key]->missing_checkouts = $attendances->where('check_out_time', '=', null)->count();
					$filtered_users[$key]->attendances       = $attendances;
				}
				return response()->json(['success' => true, 'message' => 'data retrieved successfully', 'data' => ['module_name' => 'visitor_employee_attendances', 'user' => $filtered_users]], 200);
			} else {

				$users = User::where('faculty_type', 1)->get()->pluck('display_name', 'id');
				return view('attendance.visitor_employee_index')->with(['filters_configuration' => $filters_configuration, 'users' => $users]);
			}

		} catch (\Exception $e) {
			dd($e);
			\Log::info($e);
		}
	}
	public function calculateVisitorAttendance(Request $request)
	{
		try {
			\DB::beginTransaction();
			$input          = $request->all();
			$start_date_obj = new \DateTime($input['start_date']);
			$end_date_obj   = new \DateTime($input['end_date']);
			if (isset($input['is_all_selected']) && $input['is_all_selected'] == true) {
				$input['users'] = User::where('faculty_type', 1)->get(['id'])->toArray();
			}
			foreach ($input['users'] as $key => $user) {

				$user = User::find(isset($user['id']) ? $user['id'] : $user);

				$start_date_obj = new \DateTime($input['start_date']);
				$date_diff      = $this->calculateDateDiff($start_date_obj, $end_date_obj);

				$time_period_makeups = $user->timePeriods()->where('end_date', null)->where('is_repeat', 0)->where('start_date', '>=', $input['start_date'])->where('start_date', '<=', $input['end_date']);
				$time_periods        = $user->timePeriods()->where('end_date', '!=', null)->where('is_repeat', 1)->where('start_date', '>=', $input['start_date'])->where('end_date', '<=', $input['end_date'])->get();
				for ($i = 1; $i < $date_diff; $i++) {
					$start_date_obj = new \DateTime($input['start_date']);
					$date_increment = $start_date_obj->modify('+' . $i . ' day');

					$attendance = Attendance::where('date', '=', $date_increment->format('Y-m-d'))->where('user_id', '=', $user->id)->get();

					//makeup class attendance when is repeat is 0
					foreach ($time_period_makeups->where('start_date', $date_increment->format('Y-m-d'))->get() as $time_period_makeup) {
						if ($time_period_makeup) {
							$single_day_logs = AttendanceLog::where('user_id', '=', $user->id)->where('date', '=', $date_increment->format('Y-m-d'))->get();
							if (!empty($single_day_logs->toArray()) && $single_day_logs != null) {
								$time_period_time_slot = TimeSlot::find($time_period_makeup->time_slot_id);

								$first_single_day_log = $single_day_logs->first();

								$time_period_buffer_start_obj = new \DateTime($time_period_time_slot->buffer_start_time, new \DateTimeZone('PKT'));
								$time_period_buffer_end_obj   = new \DateTime($time_period_time_slot->buffer_end_time, new \DateTimeZone('PKT'));

								$time_period_checkout_time = new \DateTime($time_period_time_slot->end_time, new \DateTimeZone('PKT'));

								$attendance                 = new Attendance();
								$attendance->check_in_time  = $first_single_day_log->attendance_time;
								$attendance->status         = config('constants.attendance_statuses')[1];
								$attendance->status_id      = 1;
								$attendance->type_name      = config('constants.attendance_types')[1];
								$attendance->type_id        = 1;
								$attendance->name           = $user->display_name;
								$attendance->emp_code       = $user->emp_code;
								$attendance->user_id        = $user->id;
								$attendance->time_slot_name = $time_period_time_slot->name . ' (' . $time_period_time_slot->start_time . ' - ' . $time_period_time_slot->end_time . ')';
								$attendance->time_slot_id   = $time_period_time_slot->id;
								$attendance->date           = $date_increment->format('Y-m-d');

								$time_period_buffer_start_with_log_date_obj = new \DateTime($first_single_day_log->date . ' ' . $time_period_buffer_start_obj->format('H:i:s'), new \DateTimeZone('PKT'));
								$time_period_buffer_end_with_log_date_obj   = new \DateTime($first_single_day_log->date . ' ' . $time_period_buffer_end_obj->format('H:i:s'), new \DateTimeZone('PKT'));

								$time_period_checkout_with_log_date_obj = new \DateTime($first_single_day_log->date . ' ' . $time_period_checkout_time->format('H:i:s'), new \DateTimeZone('PKT'));

								$checkin_obj = new \DateTime($first_single_day_log->attendance_time);
								$checkin_obj->setTimezone(new \DateTimeZone('PKT'));
								if ($checkin_obj > $time_period_buffer_end_with_log_date_obj) {
									$attendance->is_late_checkin = true;
									$attendance->status          = config('constants.attendance_statuses')[4];
									$attendance->status_id       = 4;

								} else if ($checkin_obj >= $time_period_buffer_start_with_log_date_obj && $checkin_obj <= $time_period_buffer_end_with_log_date_obj) {
									$attendance->is_on_time_checkin = true;
									$attendance->status             = config('constants.attendance_statuses')[5];
									$attendance->status_id          = 5;
								} else if ($checkin_obj < $time_period_buffer_start_with_log_date_obj) {
									$attendance->is_early_checkin = true;
									$attendance->status           = config('constants.attendance_statuses')[6];
									$attendance->status_id        = 6;
								}
								if (count($single_day_logs) > 1) {
									$last_single_day_log = $single_day_logs->last();
									$checkout_obj        = new \DateTime($last_single_day_log->attendance_time);
									$checkout_obj->setTimezone(new \DateTimeZone('PKT'));
									if ($checkout_obj > $time_period_checkout_with_log_date_obj) {
										$attendance->is_late_checkout = true;
									} else if ($checkout_obj == $time_period_checkout_with_log_date_obj) {
										$attendance->is_on_time_checkout = true;
									} else if ($checkout_obj < $time_period_checkout_with_log_date_obj) {
										$attendance->is_early_checkout = true;
									}
									$attendance->check_out_time = $last_single_day_log->attendance_time;
								}
								if (($attendance->check_out_time != null && $attendance->check_out_time != '') && ($attendance->check_in_time != null && $attendance->check_in_time != '')) {
									$working_hour              = date('h:i', strtotime($attendance->check_out_time) - strtotime($attendance->check_in_time));
									$attendance->working_hours = $working_hour;
								}
								$attendance->save();
							} else {
								$attendance                 = new Attendance();
								$attendance->type_name      = config('constants.attendance_types')[1];
								$attendance->type_id        = 1;
								$attendance->name           = $user->display_name;
								$attendance->emp_code       = $user->emp_code;
								$attendance->user_id        = $user->id;
								$time_period_time_slot      = TimeSlot::find($time_period_makeup->time_slot_id);
								$attendance->time_slot_name = $time_period_time_slot->name . ' (' . $time_period_time_slot->start_time . ' - ' . $time_period_time_slot->end_time . ')';
								$attendance->time_slot_id   = $time_period_time_slot->id;
								$attendance->date           = $date_increment->format('Y-m-d');
								$attendance->status         = config('constants.attendance_statuses')[0];
								$attendance->status_id      = 0;
								$attendance->save();
							}
						}
					}
//end makeup class attendance when is repeat is 0

//when is repeat is 1
					foreach ($time_periods as $time_period) {
						if ($time_period) {
							$single_day_logs = AttendanceLog::where('user_id', '=', $user->id)->where('date', '=', $date_increment->format('Y-m-d'))->get();
							if (!empty($single_day_logs->toArray()) && $single_day_logs != null) {
// dd($single_day_logs);
								$time_period_time_slot = TimeSlot::find($time_period->time_slot_id);

								$first_single_day_log = $single_day_logs->first();

								$time_period_buffer_start_obj = new \DateTime($time_period_time_slot->buffer_start_time, new \DateTimeZone('PKT'));
								$time_period_buffer_end_obj   = new \DateTime($time_period_time_slot->buffer_end_time, new \DateTimeZone('PKT'));

								$time_period_checkout_time = new \DateTime($time_period_time_slot->end_time, new \DateTimeZone('PKT'));

								foreach ($time_period->timePeriodSubjectWeekDays as $time_period_subject_week_day) {
									if ($time_period_subject_week_day->week_day_name == $date_increment->format('l')) {

										$attendance                 = new Attendance();
										$attendance->check_in_time  = $first_single_day_log->attendance_time;
										$attendance->status         = config('constants.attendance_statuses')[1];
										$attendance->status_id      = 1;
										$attendance->type_name      = config('constants.attendance_types')[1];
										$attendance->type_id        = 1;
										$attendance->name           = $user->display_name;
										$attendance->emp_code       = $user->emp_code;
										$attendance->user_id        = $user->id;
										$attendance->time_slot_name = $time_period_time_slot->name . ' (' . $time_period_time_slot->start_time . ' - ' . $time_period_time_slot->end_time . ')';
										$attendance->time_slot_id   = $time_period_time_slot->id;
										$attendance->date           = $date_increment->format('Y-m-d');

										$time_period_buffer_start_with_log_date_obj = new \DateTime($first_single_day_log->date . ' ' . $time_period_buffer_start_obj->format('H:i:s'), new \DateTimeZone('PKT'));
										$time_period_buffer_end_with_log_date_obj   = new \DateTime($first_single_day_log->date . ' ' . $time_period_buffer_end_obj->format('H:i:s'), new \DateTimeZone('PKT'));

										$time_period_checkout_with_log_date_obj = new \DateTime($first_single_day_log->date . ' ' . $time_period_checkout_time->format('H:i:s'), new \DateTimeZone('PKT'));

										$checkin_obj = new \DateTime($first_single_day_log->attendance_time);
										$checkin_obj->setTimezone(new \DateTimeZone('PKT'));
										if ($checkin_obj > $time_period_buffer_end_with_log_date_obj) {
											$attendance->is_late_checkin = true;
											$attendance->status          = config('constants.attendance_statuses')[4];
											$attendance->status_id       = 4;

										} else if ($checkin_obj >= $time_period_buffer_start_with_log_date_obj && $checkin_obj <= $time_period_buffer_end_with_log_date_obj) {
											$attendance->is_on_time_checkin = true;
											$attendance->status             = config('constants.attendance_statuses')[5];
											$attendance->status_id          = 5;
										} else if ($checkin_obj < $time_period_buffer_start_with_log_date_obj) {
											$attendance->is_early_checkin = true;
											$attendance->status           = config('constants.attendance_statuses')[6];
											$attendance->status_id        = 6;
										}
										if (count($single_day_logs) > 1) {
											$last_single_day_log = $single_day_logs->last();
											$checkout_obj        = new \DateTime($last_single_day_log->attendance_time);
											$checkout_obj->setTimezone(new \DateTimeZone('PKT'));
											if ($checkout_obj > $time_period_checkout_with_log_date_obj) {
												$attendance->is_late_checkout = true;
											} else if ($checkout_obj == $time_period_checkout_with_log_date_obj) {
												$attendance->is_on_time_checkout = true;
											} else if ($checkout_obj < $time_period_checkout_with_log_date_obj) {
												$attendance->is_early_checkout = true;
											}
											$attendance->check_out_time = $last_single_day_log->attendance_time;
										}
										if (($attendance->check_out_time != null && $attendance->check_out_time != '') && ($attendance->check_in_time != null && $attendance->check_in_time != '')) {
											$working_hour              = date('h:i', strtotime($attendance->check_out_time) - strtotime($attendance->check_in_time));
											$attendance->working_hours = $working_hour;
										}
										$attendance->save();
									}
								}
							} else {
								foreach ($time_period->timePeriodSubjectWeekDays as $time_period_subject_week_day) {
									if ($time_period_subject_week_day->week_day_name == $date_increment->format('l')) {
										$attendance                 = new Attendance();
										$attendance->type_name      = config('constants.attendance_types')[1];
										$attendance->type_id        = 1;
										$attendance->name           = $user->display_name;
										$attendance->emp_code       = $user->emp_code;
										$attendance->user_id        = $user->id;
										$time_period_time_slot      = TimeSlot::find($time_period->time_slot_id);
										$attendance->time_slot_name = $time_period_time_slot->name . ' (' . $time_period_time_slot->start_time . ' - ' . $time_period_time_slot->end_time . ')';
										$attendance->time_slot_id   = $time_period_time_slot->id;
										$attendance->date           = $date_increment->format('Y-m-d');
										$attendance->status         = config('constants.attendance_statuses')[0];
										$attendance->status_id      = 0;
										$attendance->save();
									}
								}
							}
						}
					}
//end when is repeat is 1
				}
			}
			\DB::commit();
		} catch (\Exception $e) {
			dd($e);
			\DB::rollback();
		}
		return redirect(route('attendance.getVisitorEmployeeAttendances'));
	}
}
