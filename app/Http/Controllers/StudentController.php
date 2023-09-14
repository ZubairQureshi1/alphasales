<?php

namespace App\Http\Controllers;

use Alertify;
use App\Exports\Students\StudentListExport;
use App\Imports\Imports\AttendanceImport;
use App\Models\AcademicRecord;
use App\Models\Admission;
use App\Models\AffiliatedBody;
use App\Models\Attendance;
use App\Models\Course;
use App\Models\CourseSubject;
use App\Models\FeePackage;
use App\Models\FeePackageInstallment;
use App\Models\OrganizationCampus;
use App\Models\Pwwb\IndexTable;
use App\Models\Reference;
use App\Models\Section;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentAttachment;
use App\Models\StudentBook;
use App\Models\StudentContactInformation;
use App\Models\StudentRegistration;
use App\Models\Subject;
use App\Models\SystemRollNumber;
use Carbon\Carbon;
use ConstantStrings;
use Excel;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class StudentController extends Controller
{
    public static $filters_configuration = [
        'addFilters' => true,
        // 'route' => '../accounts/reportings',
        'model_path' => 'App\Models\Student',
        'index_path' => 'students.index',
        'date_filter_column' => 'admission_date',
        'controller_path' => 'App\Http\Controllers\StudentController',
        'can_filters' => true,
        'clear_filters' => true,
        'filters' => [
            'users' => false,
            'students' => false,
            'courses' => true,
            'parts' => false,
            'sessions' => true,
            'subjects' => false,
            'roles' => false,
            'visitor_users' => false,
            'admission_forms' => false,
            'departments' => false,
            'designations' => false,
            'sections' => false,
            'admission_types' => true,
            'end_of_registrations' => true,
            'heads' => false,
            'fee_structure_types' => false,
            'payment_statuses' => false,
            'voucher_statuses' => false,
            'start_date' => true,
            'end_date' => false,
        ],
    ];
    public function index(Request $request)
    {
        $students = Student::orderBy('roll_no')->paginate(ConstantStrings::PAGINATION_RANGE);
        // $student_keys = [];
        // if (count($students) != 0) {
        //     $student_keys = array_keys($students->toArray()[0]);
        // }
        foreach ($students->items() as $key => $student) {
            if ($student->profile_pic != null && $student->profile_pic != '') {
                $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . /*$student->roll_no . '/Profile_Pictures/' .*/$student->profile_pic);
            } else {
                $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
            }
        }
        return view('students.index')
            ->with('data', $students)->with('filters_configuration', $this::$filters_configuration) /*->with(['student_keys' => $student_keys])*/;
    }

    public function getFilteredData(Request $request)
    {
        $students = Student::where('old_roll_no', '=', $request['old_roll_no'])->paginate(ConstantStrings::PAGINATION_RANGE);
        // $student_keys = [];
        // if (count($students) != 0) {
        //     $student_keys = array_keys($students->toArray()[0]);
        // // }
        foreach ($students->items() as $key => $student) {
            if ($student->profile_pic != null && $student->profile_pic != '') {
                $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') . /*$student->roll_no . '/Profile_Pictures/' .*/$student->profile_pic);
            } else {
                $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
            }
        }
        return view('students.index')
            ->with('data', $students)->with('filters_configuration', $this::$filters_configuration) /*->with(['student_keys' => $student_keys])*/;
    }

    public function import(Request $request)
    {
        $data = Excel::toArray(new AttendanceImport, $request->file('import'));
        // dd($data);
        $data = $data[1];
        $import_keys = $data[0];
        // dd($data);
        foreach ($data as $key => $sub_data) {
            if ($key > 0) {
                $attendance_log;
                $not_found = false;
                $new_one = false;
                $attendanceFor = null;
                foreach ($sub_data as $sub_data_key => $value) {
                    if ($import_keys[$sub_data_key] != 'break') {
                        $roll_no;
                        if ($import_keys[$sub_data_key] == 'roll_no') {
                            $roll_no = $value;
                            // dd($value);
                            $attendanceFor = Student::/*withTrashed()->*/where('roll_no', '=', $value)->get();
                            // \Log::info($attendanceFor);
                            if (count($attendanceFor->toArray()) > 0) {
                                $attendanceFor = $attendanceFor->first();
                                // \Log::info($value . ' - ' . $attendanceFor['student_name']);
                            }
                        }
                        if ($import_keys[$sub_data_key] == 'student_name') {
                            // $attendanceFor = Student::withTrashed()->find($value);
                            // dd($value);
                            if (empty($attendanceFor->toArray()) || count($attendanceFor->toArray()) == 0) {
                                $attendanceFor = Student::/*withTrashed()->*/where('student_name', '=', $value)->get()->first();
                            }
                            // \Log::info($value . ' - ' . $attendanceFor['student_name']);
                            // dd($attendanceFor);
                        }
                        if ($attendanceFor != null && count($attendanceFor->toArray()) > 0) {
                            $not_found = false;
                            $date;
                            // $attendanceFor = $attendanceFor->toArray();
                            if ($import_keys[$sub_data_key] == 'Date') {
                                // \Log::info($import_keys[$sub_data_key]);
                                // \Log::info($value);
                                // From Local Date to Excel Date
                                // $EXCEL_DATE = 25569 + ($value / 86400);

                                // From Excel Date to Local Date
                                $UNIX_DATE = (($value) - 25569) * 86400;
                                $date = new \DateTime();
                                $date->setTimestamp((int) $UNIX_DATE);
                                // dd($date->format('Y-m-d'));
                                $date = $date->format('Y-m-d');
                                // dd($date);
                                // dd($attendanceFor);
                                $attendance_log = Attendance::where('student_id', '=', $attendanceFor->id)->where('date', '=', $date)->get()->first();
                                if ($attendance_log == null) {
                                    $attendance_log = new Attendance();
                                    $attendance_log->check_in_time = '2019-01-10UTC07:47:27.0350';
                                    $attendance_log->type_name = config('constants.attendance_type')[0];
                                    $attendance_log->type_id = 0;
                                    $attendance_log->name = $attendanceFor->student_name;
                                    $attendance_log->roll_number = $attendanceFor->roll_no;
                                    $attendance_log->student_id = $attendanceFor->id;
                                    $attendance_log->date = $date;
                                    $new_one = true;
                                }
                                // dd($attendance_log->toArray());
                            }
                        } else {
                            $not_found = true;
                        }
                    } else {
                        $key = $sub_data_key - 1;
                        \Log::info($attendance_log->date);
                        if ($new_one) {
                            if (($sub_data[$sub_data_key - 1] != null && $sub_data[$sub_data_key - 1] == 'Absent') && !$not_found) {
                                $attendance_log->status_id = 0;
                                $attendance_log->status = config('constants.attendance_statuses')[0];
                                $attendance_log->save();
                            } else if (($sub_data[$sub_data_key - 1] == null && $sub_data[$sub_data_key - 1] != 'Absent') && !$not_found) {
                                $attendance_log->status_id = 1;
                                $attendance_log->status = config('constants.attendance_statuses')[1];
                                $attendance_log->save();
                                \Log::info($attendance_log->date . ' - ID - ' . $attendance_log->student_id . '- Present Saved');
                            }
                        } else {

                            if (($sub_data[$sub_data_key - 1] != null && $sub_data[$sub_data_key - 1] == 'Absent') && !$not_found) {
                                $attendance_log->status_id = 0;
                                $attendance_log->status = config('constants.attendance_statuses')[0];
                                $attendance_log->update();
                                \Log::info($attendance_log->date . ' - ID - ' . $attendance_log->student_id . ' - Absent Update');
                            } else if (($sub_data[$sub_data_key - 1] == null && $sub_data[$sub_data_key - 1] != 'Absent') && !$not_found) {
                                $attendance_log->status_id = 1;
                                $attendance_log->status = config('constants.attendance_statuses')[1];
                                $attendance_log->update();
                                \Log::info($attendance_log->date . ' - ID - ' . $attendance_log->student_id . ' - Present Update');
                            }
                        }
                    }
                    // $attendance_log = new AttendanceLog();
                    // $not_found = false;
                    // $attendanceFor = null;
                    // foreach ($sub_data as $sub_data_key => $value) {
                    // if ($import_keys[$sub_data_key] != 'break') {
                    //     if ($import_keys[$sub_data_key] == 'roll_no') {
                    //         // dd($value);
                    //         $attendanceFor = Student::withTrashed()->where('roll_no', '=', $value)->get();
                    //         // \Log::info($attendanceFor);
                    //         if (count($attendanceFor->toArray()) > 0) {
                    //             $attendanceFor = $attendanceFor->first();
                    //             // \Log::info($value . ' - ' . $attendanceFor['student_name']);
                    //         }
                    //     }
                    //     if ($import_keys[$sub_data_key] == 'student_name') {
                    //         // $attendanceFor = Student::withTrashed()->find($value);
                    //         // dd($value);
                    //         if (empty($attendanceFor->toArray()) || count($attendanceFor->toArray())) {
                    //             $attendanceFor = Student::withTrashed()->where('student_name', '=', $value)->get()->first();
                    //         }
                    //         // \Log::info($value . ' - ' . $attendanceFor['student_name']);
                    //         // dd($attendanceFor);
                    //     }
                    //     if ($attendanceFor != null && count($attendanceFor->toArray()) > 0) {
                    //         $not_found = false;
                    //         // $attendanceFor = $attendanceFor->toArray();

                    //         $attendance_log->roll_number = $attendanceFor['roll_no'];
                    //         $attendance_log->student_id = $attendanceFor['id'];
                    //         // \Log::info($attendanceFor);
                    //         if ($import_keys[$sub_data_key] == 'Date') {
                    //             // \Log::info($import_keys[$sub_data_key]);
                    //             // \Log::info($value);
                    //             \Log::info('-------------');
                    //             // From Local Date to Excel Date
                    //             // $EXCEL_DATE = 25569 + ($value / 86400);

                    //             // From Excel Date to Local Date
                    //             $UNIX_DATE = (($value) - 25569) * 86400;
                    //             $date = new \DateTime();
                    //             $date->setTimestamp((int) $UNIX_DATE);
                    //             // dd($date->format('Y-m-d'));
                    //             $attendance_log->date = $date->format('Y-m-d');
                    //         }
                    //         $dateTime = '2019-01-10UTC07:47:27.0350';
                    //         $attendance_log->attendance_time = $dateTime;
                    //         if ($import_keys[$sub_data_key] == 'student_name') {
                    //             $attendance_log->name = $value;
                    //         }
                    //         $attendance_log->type_name = 'student';
                    //         $attendance_log->type_id = 0;
                    //     } else {
                    //         $not_found = true;
                    //     }
                    // } else {
                    //     $key = $sub_data_key - 1;
                    //     if (($sub_data[$sub_data_key - 1] != null && $sub_data[$sub_data_key - 1] != 'Absent') && !$not_found) {
                    //         dd('enteredinsave');
                    //         $attendance_log->save();
                    //         \Log::info($attendance_log->date . ' - Saved');
                    //     }
                    //     dd($sub_data[$key]);
                    //     $attendance_log = new AttendanceLog();
                    // }

                }
            }
        }
        /*Excel::load($request->file('import'), function ($reader) {
        try {
        dd($reader);
        \DB::beginTransaction();
        foreach ($reader->toArray() as $key => $value) {
        $student = Student::withTrashed()->where('roll_no', '=', $value['roll_no'])->get()->first();
        if (isset($student)) {
        if ($value['old_roll_no'] != '') {
        \Log::info($student);
        $student->old_roll_no = $value['old_roll_no'];
        $student->update();
        } else {
        $student->old_roll_no = '';
        $student->update();

        }
        }*/
        //     $student = Student::create($value);1
        //     $sectionStudentInput = ['section_id' => $value['section_id'], 'student_id' => $student->id];
        //     $sectionStudent = SectionStudent::create($sectionStudentInput);
        //     $sectionWiseStudents = SectionStudent::where('section_id', '=', $value['section_id'])->get()->toArray();

        //     $sectionStudentCount;
        //     if (!$sectionWiseStudents) {
        //         $sectionStudentCount = 1;
        //     } else {
        //         $sectionStudentCount = sizeof($sectionWiseStudents);
        //     }
        //     $end_date = Session::find($value['session_id'])->session_end_date;
        //     $session_end_date = new \DateTime(str_replace('/', '-', $end_date));
        //     $section_code = Section::find($value['section_id'])->code;
        //     $course_code = Course::find($value['course_id'])->course_code;
        //     $student_roll_no = 'CFE-' . $session_end_date->format('Y') . '-' . $course_code . '-' . $section_code . '-' . sprintf('%05d', intval($sectionStudentCount));
        //     $student->roll_no = $student_roll_no;
        //     $student->session_name = Session::find($value['session_id'])->session_name;
        //     $student->update();
        //     $this->generateQRCode($student);
        /*}
    \DB::commit();
    return redirect()->back();
    } catch (Exception $e) {
    \DB::rollback();
    return redirect()->back();

    }
    });*/
    }

    public function show(Student $student)
    {
        if ($student->profile_pic != null && $student->profile_pic != '') {
            $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') /*. $student->roll_no . '/Profile_Pictures/' .*/ . $student->profile_pic);
        } else {
            $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
        }
        $student = $student->toArray();
        $admission = Admission::where('student_id', $student['id'])->get()->last();
        $courses = Course::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        $sections = Section::get()->pluck('name', 'id');
        $references = Reference::get()->pluck('name', 'id');
        $attachments = StudentAttachment::where('attachment_for', $student['id'])->get();
        $studentAcademicHistory = StudentAcademicHistory::where('student_id', $student['id'])->get()->last();
        $academicRecord = AcademicRecord::where('student_id', $student['id'])->get();
        $student_book = StudentBook::where('student_academic_history_id', '=', $studentAcademicHistory['id'])->get();
        $fee_package = FeePackage::where(['student_id' => $student['id'], 'academic_history_id' => $studentAcademicHistory['id']])->get()->last();
        $fee_package_installments = FeePackageInstallment::where(['package_id' => !empty($fee_package) ? $fee_package->id : null, 'academic_history_id' => $studentAcademicHistory['id']])->get();
        $getsubjects = CourseSubject::where('course_id', '=', $student['course_id'])->get();
        $contactInfos = StudentContactInformation::where('student_id', $student['id'])->get();
        $studentRegistration = StudentRegistration::where(['student_id' => $student['id'], 'academic_history_id' => $studentAcademicHistory->id])->first();

        return view('students.show')
            ->with(['student' => $student, 'references' => $references, 'courses' => $courses, 'sessions' => $sessions, 'sections' => $sections])
            ->with('student_book', $student_book)
            ->with('getsubjects', $getsubjects)
            ->with('studentAcademicHistory', $studentAcademicHistory)
            ->with('fee_package', $fee_package)
            ->with('fee_instalments', $fee_package_installments)
            ->with('attachments', $attachments)
            ->with('contactInfos', $contactInfos)
            ->with('academicRecord', $academicRecord)
            ->with('admission', $admission)
            ->with('studentRegistration', $studentRegistration);

    }

    public function edit(Student $student)
    {
        if ($student->profile_pic != null && $student->profile_pic != '') {
            $student->picture_pic_directory_url = asset(config('constants.attachment_path.student_qr_destination_path') /*. $student->roll_no . '/Profile_Pictures/'*/ . $student->profile_pic);
        } else {
            $student->picture_pic_directory_url = asset('assets/images/users/dummy.png');
        }
        $student = $student->toArray();
        $admission = Admission::where('student_id', $student['id'])->get()->last();
        $courses = Course::get()->pluck('name', 'id');
        $sessions = Session::get()->pluck('session_name', 'id');
        $sections = Section::get()->pluck('name', 'id');
        $references = Reference::get()->pluck('name', 'id');
        $attachments = StudentAttachment::where('attachment_for', $student['id'])->get();
        $studentAcademicHistory = StudentAcademicHistory::where('student_id', $student['id'])->get()->last();
        $academicRecord = AcademicRecord::where('student_id', $student['id'])->get();
        $student_book = StudentBook::where('student_academic_history_id', '=', $studentAcademicHistory['id'])->get();
        $fee_package = FeePackage::where(['student_id' => $student['id'], 'academic_history_id' => $studentAcademicHistory['id']])->get()->last();
        $fee_package_installments = FeePackageInstallment::where(['package_id' => !empty($fee_package) ? $fee_package->id : null, 'academic_history_id' => $studentAcademicHistory['id']])->get();
        $getsubjects = CourseSubject::where('course_id', '=', $student['course_id'])->get();
        $contactInfos = StudentContactInformation::where('student_id', $student['id'])->get();
        $studentRegistration = StudentRegistration::where(['student_id' => $student['id'], 'academic_history_id' => $studentAcademicHistory->id])->first();

        return view('students.edit')
            ->with(['student' => $student, 'references' => $references, 'courses' => $courses, 'sessions' => $sessions, 'sections' => $sections])
            ->with('student_book', $student_book)
            ->with('getsubjects', $getsubjects)
            ->with('studentAcademicHistory', $studentAcademicHistory)
            ->with('fee_package', $fee_package)
            ->with('fee_instalments', $fee_package_installments)
            ->with('attachments', $attachments)
            ->with('contactInfos', $contactInfos)
            ->with('academicRecord', $academicRecord)
            ->with('admission', $admission)
            ->with('studentRegistration', $studentRegistration);
    }

    public function export()
    {
        ob_end_clean();
        return Excel::download(new StudentListExport, 'StudentLists.xlsx');
    }

    public function update($id, Request $request)
    {
        try {
            \DB::beginTransaction();
            $student = Student::find($id);
            $old_roll_no = $student->roll_no;
            $admission = Admission::where('student_id', $student->id)->first();
            $input = $request->all();
            // dd($input);
            $keys = array_keys($input);
            // NOTE: update student roll if shift id is changed
            if ($student->shift_id !== (int) $request->shift_id) {
                // NOTE: Fetch course
                $course = Course::find($student->course_id);
                // NOTE: Fetch session start date
                $start_date = SessionCourse::where([
                    'session_id' => $student->session_id,
                    'course_id' => $course->id,
                    'organization_campus_id' => $student->organization_campus_id,
                    'academic_term_id' => $student->academic_term_id,
                ])->get()->last()->session_start_date;
                $session_start_date = new \DateTime(str_replace('/', '-', $start_date));
                // NOTE: Fetch student roll number from system roll number
                $system_roll_number = SystemRollNumber::find($student->system_roll_number_id);
                // NOTE: Roll Number requirements
                $course_code = $course->courseSessions()->where(['organization_campus_id' => $student->organization_campus_id, 'session_id' => $student->session_id])->get()->last()->course_code ?? 'CODENOTFOUND';
                // NOTE: Generating shift id
                $student_shift = $request->shift_id == 0 ? 'M' : ($request->shift_id == 1 ? 'E' : ($request->shift_id == 2 ? 'W' : ''));
                // NOTE: updated roll number
                $student_roll_no = OrganizationCampus::find($student->organization_campus_id)->code . '-' . AffiliatedBody::find($student->affiliated_body_id)->code . '-' . $session_start_date->format('Y') . '-' . $course_code . '-' . $student_shift . '-' . sprintf('%05d', intval($system_roll_number->generated_at_length));
                // NOTE: updated system roll number
                $system_roll_number->update(['roll_no' => $student_roll_no]);
                // NOTE: Update in student model
                $student->update(['roll_no' => $student_roll_no, 'shift_id' => $request->shift_id]);

                // also update student roll number in pwwb module
                // update new roll number to pwwb file if student category is pwwb
                if ($student->student_category_id == 0) {
                    $pwwbFile = IndexTable::find($admission->pwwb_file_id);
                    $pwwbFile->roll_no = $student_roll_no;
                    $pwwbFile->update();
                }

                // NOTE" shift uploaded content to new folder if roll number is updated

                /*if (is_dir(config('constants.attachment_path.file_destination_path') . '/Students/' . $old_roll_no)) {
                rename(config('constants.attachment_path.file_destination_path') . '/Students/' . $old_roll_no, config('constants.attachment_path.file_destination_path') . '/Students/' . $student->roll_no); //rename folder
                }*/
                // NOTE: clear out user section details
                if (isset($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks) && !empty($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks) && !empty($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->first()->section_id)) {
                    $student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->update([
                        'section_id' => null,
                        'section_name' => null,
                        'section_detail_id' => null,
                        'section_subject_detail_id' => null,
                    ]);
                    Notify::success('Student is removed from section. You can assign student again in section management.', 'Section Alert');
                }
                Notify::success('New roll number is updated successfully.', 'Roll Number: ' . $student_roll_no);
            } elseif($request->exists('is_end_of_reg') && $request->is_end_of_reg) {
                if (isset($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks) && !empty($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks) && !empty($student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->first()->section_id)) {
                    $student->studentAcademicHistories()->where('is_promoted', false)->get()->last()->studentBooks()->update([
                        'section_id' => null,
                        'section_name' => null,
                        'section_detail_id' => null,
                        'section_subject_detail_id' => null,
                    ]);
                    Notify::success('Student is removed from section.', 'Section Alert');
                }
            }

            /*$student_course = $student->course()->get()->first();
            $student_section = $student->section()->get()->first();
            $student_session = $student->session()->get()->first();

            $student_start_date = SessionCourse::where('session_id', $student_session->id)->where('course_id', $student_course->id)->get()->first()->session_start_date;
            $student_session_start_date = new \DateTime(str_replace('/', '-', $student_start_date));

            $selected_course = Course::find($input['course_id']);
            $selected_section = Section::find($input['section_id']);
            $selected_session = Session::find($input['session_id']);

            $selected_start_date = SessionCourse::where('session_id', $selected_session->id)->where('course_id', $selected_course->id)->get()->first()->session_start_date;
            $selected_session_start_date = new \DateTime(str_replace('/', '-', $selected_start_date));

            $course_name = $selected_course->name;
            $course_code = $selected_course->course_code;

            $section_name = $selected_section->name;
            $section_code = $selected_section->code;

            $session_name = $selected_session->session_name;

            if ($selected_course->course_code != $student_course->course_code || $selected_section->code != $student_section->code || $selected_session_start_date != $student_session_start_date) {
            // if ($selected_section->code != $student_section->code) {
            $courseWiseStudents = SystemRollNumber::withTrashed()->where('course_id', '=', $input['course_id'])->where('session_id', '=', $input['session_id'])->get();
            $courseStudentCount;
            if (!$courseWiseStudents) {
            $courseStudentCount = 1;
            } else {
            if ($selected_section->code != $student_section->code && $selected_course->course_code == $student_course->course_code && $selected_session_start_date == $student_session_start_date) {

            $courseStudentCount = SystemRollNumber::withTrashed()->where('course_id', '=', $input['course_id'])->where('session_id', '=', $input['session_id'])->where('student_id', $student->id)->get()->last()->generated_at_length;
            } else {
            $courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1;
            }
            }
            $session_start_date = $selected_session_start_date;

            if ($selected_course->degree_level_id != 0) {
            $student_roll_no = 'CFE1-' . AffiliatedBody::find($input['affiliated_body_id'])->code . '-' . $session_start_date->format('Y') . '-' . $course_code . '-' . sprintf('%05d', intval($courseStudentCount));
            } else {
            $student_roll_no = 'CFE2-' . $session_start_date->format('Y') . '-' . $course_code . '-' . $section_code . '-' . sprintf('%05d', intval($courseStudentCount));
            }

            $system_roll_no;

            if ($selected_section->code != $student_section->code && $selected_course->course_code == $student_course->course_code && $selected_session_start_date == $student_session_start_date) {
            $system_roll_no = SystemRollNumber::find($student->system_roll_number_id);
            $system_roll_no->roll_no = $student_roll_no;
            $system_roll_no->section_id = $input['section_id'];
            $system_roll_no->section_name = $section_name;
            $system_roll_no->update();

            } else {

            $system_roll_no_input = ['roll_no' => $student_roll_no, 'session_id' => $input['session_id'], 'section_id' => $input['section_id'], 'course_id' => $input['course_id'], 'student_id' => $student->id, 'admission_id' => $student->admission_id, 'session_name' => $session_name, 'section_name' => $section_name, 'student_name' => $student->student_name, 'course_name' => $course_name, 'is_assigned' => true, 'generated_at_length' => $courseStudentCount];
            $system_roll_no = SystemRollNumber::create($system_roll_no_input);
            if ($student->admission_id != null) {
            $admission = Admission::find($student->admission_id);
            $system_roll_no->admission_form_code = $admission->form_no;
            }
            $system_roll_no->update();
            // dd($student_roll_no);

            $student_assigned_roll_no = SystemRollNumber::find($student->system_roll_number_id);
            $student_assigned_roll_no->admission_id = null;
            $student_assigned_roll_no->is_assigned = false;
            $student_assigned_roll_no->admission_form_code = null;
            $student_assigned_roll_no->student_name = null;
            $student_assigned_roll_no->student_id = null;
            $student_assigned_roll_no->update();
            $student->system_roll_number_id = $system_roll_no->id;
            }

            $student->roll_no = $student_roll_no;

            }*/
            $student->is_end_of_reg = false;
            foreach ($keys as $key => $value) {
                if ($value != '_method' && $value != '_token' && $value != 'contact_nos' && $value != 'contact_info_types' && $value != 'contact_other_names' && $value != 'edit_hostel') {
                    if ($value == 'is_end_of_reg') {
                        $student->is_end_of_reg = true;
                    } else {
                        $student->$value = $input[$value];
                    }
                }
            }
            if (!$student->is_end_of_reg) {
                $student->remark_end_of_reg = '';
            }
            if ($student->reason_end_of_reg_id) {
                $student->reason_end_of_reg = config('constants.drop_statuses')[$student->reason_end_of_reg_id];
            }
            if (isset($section_name)) {
                $student->section_name = $section_name;
            }
            if (isset($course_name)) {
                $student->course_name = $course_name;
            }
            if (isset($input['semester_id'])) {
                $student->semester = config('constants.semesters_years')[$input['semester_id']];
            }
            if (isset($session_name)) {
                $student->session_name = $session_name;
            }
            if (isset($input['reference_id'])) {
                $student->reference_name = Reference::find($input['reference_id'])->name;
            }
            if (isset($input['gender_id'])) {
                $student->gender = config('constants.genders')[$input['gender_id']];
            }
            if (isset($input['shift_id'])) {
                $student->shift = config('constants.shifts')[$input['shift_id']];
            }
            if (isset($input['student_category_id'])) {
                $student->admission_type = config('constants.student_categories')[$input['student_category_id']];
            }
            if (isset($input['student_category_id'])) {
                $student->student_category_id = $input['student_category_id'];
            }
            if (isset($input['self_worker'])) {
                $student->self_worker = $input['self_worker'];
            }
            if (isset($input['cfe_file_no'])) {
                $student->cfe_file_no = $input['cfe_file_no'];
            }
            if (isset($input['dairy_no'])) {
                $student->dairy_no = $input['dairy_no'];
            }
            if (isset($input['experience'])) {
                $student->experience = $input['experience'];
            }
            if (isset($input['designation'])) {
                $student->designation = $input['designation'];
            }
            if (isset($input['eobi'])) {
                $student->eobi = $input['eobi'];
            }
            if (isset($input['ssc'])) {
                $student->ssc = $input['ssc'];
            }
            if (isset($input['factory_name'])) {
                $student->factory_name = $input['factory_name'];
            }
            if (isset($input['factory_city'])) {
                $student->factory_city = $input['factory_city'];
            }
            if (isset($input['r_eight'])) {
                $student->r_eight = $input['r_eight'];
            }
            if (isset($input['factory_reg_no'])) {
                $student->factory_reg_no = $input['factory_reg_no'];
            }
            if (isset($input['is_transport'])) {
                $student->is_transport = $input['is_transport'];
            }
            if (isset($input['transport_route_id'])) {
                $student->transport_route_id = $input['transport_route_id'];
            }
            if (isset($input['guardian_cnic'])) {
                $student->guardian_cnic = $input['guardian_cnic'];
            }
            if (isset($request->edit_hostel)) {
                $student->is_hostel = $request->edit_hostel;
            }
            if (isset($input['is_provisional_letter'])) {
                $student->is_provisional_letter = $input['is_provisional_letter'];
            }
            // update contact details
            if (isset($input['contact_nos'])) {
                $student->contactInfos()->delete();
                foreach ($input['contact_nos'] as $key => $contact_info) {
                    $student->contactInfos()->create([
                        'admission_id' => $student->admission_id,
                        'contact_no' => $contact_info,
                        'contact_type_id' => $input['contact_info_types'][$key],
                        'contact_type_name' => config('constants.contact_types')[$input['contact_info_types'][$key]],
                        'contact_type_other_name' => $input['contact_other_names'][$key] != null ? $input['contact_other_names'][$key] : '',
                    ]);
                }
            }
            Notify::success('Student information updated successfully.', 'Success', $options = []);
            $student->update();
            // update admission also
            $admission->update($input);
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            dd($e);
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('students_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    return response()->json(['success' => false, 'error' => $message], 500);
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }
        }

    }

    // public function download(Request $request)
    // {
    //     $input = $request->all();
    //     $student = Student::find($input['id']);
    //     $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');
    //     $downloadPath = $directory . $student['qr_code_name'] . ".png";
    //     //dd($directory);
    //     //  $file = public_path() . " / uploads / students / " . $qr_code . "";

    //     return response()->download($downloadPath);

    // }
    public function semesterFreeze(Request $request, $id)
    {
        $input = $request->all();
        $student = Student::find($id);
        $student->semester_freeze_id = $input['semester_status_id'];
        $student->semester_freeze_reason = $input['semester_freeze_reason'];
        $student->update();
        return redirect()->back();
    }
    public function generateQRCode($id)
    {
        // Personal Information
        // $name = $student->student_name;
        // $id = $student->id;
        // $roll_no = $student->roll_no;
        // $type = 'student';
        // $contacts = [
        //     ['student_cell_no' => $student->student_cell_no],
        //     ['father_contact_info' => $student->father_cell_no],
        // ];
        // $qr_code_name = $student->student_name . time();
        // $qr_code = \QRCode::text(json_encode($student->toArray(), true));
        // $qr_code->setErrorCorrectionLevel('H');
        // $qr_code->setSize(4);
        // $qr_code->setMargin(2);
        // $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');
        // $qr_code->setOutfile($directory . $qr_code_name . '.png');
        // $qr_code->png();
        $student = Student::find($id);
        $input = $student->only(['id', 'student_name']);
        $qr_code_name = $student->student_name . '-' . $student->old_roll_no . '.png';
        $input['type'] = 'student';

        $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');
        \QrCode::errorCorrection('H')->format('png')->encoding('UTF-8')->size(180)
            ->generate(json_encode($input, true), ($directory . $qr_code_name));

        // $qr_code_server = \QRCode::text(json_encode($input, true));
        // $qr_code_server->setErrorCorrectionLevel('H');
        // $qr_code_server->setSize(4);
        // $qr_code_server->setMargin(2);
        // $qr_code_server->setOutfile($directory . $qr_code_name . '.png');
        // $qr_code_server->png();
        $student->qr_code_name = $qr_code_name;
        $student->update();
        ob_end_clean();

        return response()->download($directory . $qr_code_name);
    }

    public function changeProfilePicture(Request $request)
    {
        // dd($request->all());
        $student = Student::findOrFail($request->id);
        $admission = Admission::where('student_id', $student->id)->firstOrFail();
        if ($request->hasFile('profile_pic')) {
            $profile_pic = $request->file('profile_pic');
            // create a new directory in specific student folder
            $directory = \FileUploader::makeDirectory(false, $student, 'profile');
            // put profile image in directory and update DB
            \FileUploader::saveProfilePicture($admission, $profile_pic, $directory);
        }
        Notify::success('Profile updated successfully!', 'Success', $options = []);
        return redirect()->back();
    }

    /**
     * @param Student id
     * @return Save attachments accordingly
     */
    public function addAttachment(Request $request, Student $student)
    {
        $request->validate([
            'attachment_type' => 'required',
            'attachment_file' => 'required',
        ]);
        // store in local
        $file = $request->file('attachment_file');
        $directory = \FileUploader::makeDirectory(false, $student, 'attachments');
        $attachment_type = config('constants.attachment_types')[$request->attachment_type];
        $attachment_file_ext = $file->guessExtension();
        // save data to DB
        $attachment = StudentAttachment::create([
            'attachment_name' => $student->student_name . '-' . "Attachment",
            'attachment_for' => $student->id,
            'attachment_from' => "App\Models\Admission",
            'attachment_type_id' => $request->attachment_type,
            'attachment_type' => $attachment_type,
        ]);
        $attachment_file_name = time() . $student->id . '_' . $attachment->id . '_' . $attachment_type . '.' . $attachment_file_ext;
        $attachment->attachment_url = $attachment_file_name;
        $attachment->save();
        // move file
        $file->move($directory, $attachment_file_name);
        // return
        Notify::success('Attachment saved successfully.', 'Success', $options = []);
        return redirect()->back();
    }

    public function removeAttachment(StudentAttachment $attachment)
    {
        $student = $attachment->student;
        $path = \FileUploader::studentDestinationPath($student, 'attachments', $attachment->attachment_url);

        // delete file from server if exists
        if (file_exists($path)) {
            @unlink($path);
        }
        // delete from db
        $attachment->delete();
        return response()->json(['success' => true], 200);
    }

    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $student = Student::find($id);

            if (empty($student)) {
                Alertify::error('student not found');

                return redirect(route('admissions.index'));
            }
            $student->delete();
            Alertify::success('Student deleted successfully.');

            \DB::commit();
            return redirect(route('students.index'));
        } catch (\Exception $e) {
            \DB::rollback();
        }
    }

    public function studentgrowth()
    {
        $current_date = new \DateTime();
        $current_date = $current_date->format('Y');
        $years_array = [];
        for ($i = 0; $i < 5; $i++) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($years_array, $year);
        }
        return view('students.student_growth')->with(['years' => $years_array]);
    }

    public function loadExpelStudentRate(Request $request)
    {

        $input = $request->all();
        $choose_year = $input['choose_year'];
        $conversion_array = [];
        $datasets = [0];
        $datasets1 = [0];
        $year_counts = [0];
        $year_counts1 = [0];
        $chart_x_axis = [''];
        for ($i = $choose_year; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);

            $student_expel = Student::whereYear('created_at', '=', $year)->where('is_end_of_reg', '=', 1)->get()->count();
            $student_registered = Student::whereYear('created_at', '=', $year)->get()->count();

            array_push($year_counts, $student_expel);
            array_push($year_counts1, $student_registered);

        }
        array_push($datasets, ['data' => $year_counts]);
        array_push($datasets1, ['data' => $year_counts1]);
        $conversion_array = ['labels' => $chart_x_axis, 'datasets' => $year_counts, 'datasets1' => $year_counts1];
        // $estimated_value = $this->chartEstimatedValues($yearly_enquiry_count);
        // dd($estimated_value);
        return response()->json(['conversion_array' => $conversion_array]);

    }

    public function WrongEntry($id)
    {
        $student_book = StudentBook::find($id)->delete();
        return redirect()->back();

    }

    public function addSubject($id, Request $request)
    {
        $student = Student::find($id);
        $input = $request->all();
        $curr_student = StudentAcademicHistory::where('student_id', $student['id'])->get()->last();
        foreach ($input['selected_books'] as $key => $selected_book) {
            $student_book = StudentBook::create([
                'subject_name' => CourseSubject::find($selected_book)->subject_name,
                'subject_id' => CourseSubject::find($selected_book)->id,
                'student_academic_history_id' => $curr_student['id'],
            ]);
        }
        return redirect()->back();
    }

    public function updateStudentCourse(Request $request, Student $student)
    {
        $input = $request->all();
        try {
            \DB::beginTransaction();
            $course = Course::find($input['course_id']);
            $session = Session::find(SystemSession::get('selected_session_id'));
            $admission = Admission::where('student_id', $student->id)->first();
            $input['organization_campus_id'] = $request->organization_campus_id ?? SystemSession::get('organization_campus_id');
            $old_roll_no = $student->roll_no;

            // NOTE: Count all entries against this course
            $courseWiseStudents = SystemRollNumber::withTrashed()->where('organization_campus_id', $input['organization_campus_id'])->where('course_id', $course->id)->where('session_id', $session->id)->get();
            $courseStudentCount;
            if (!empty($courseWiseStudents) && count($courseWiseStudents) == 0) {
                $courseStudentCount = 1;
            } else {
                $courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1;
            }
            // dd($student->academic_term_id);
            // NOTE: where('academic_term_id', $input['academic_term_id'])->
            $start_date = SessionCourse::where([
                'session_id' => $session->id,
                'course_id' => $course->id,
                'organization_campus_id' => $input['organization_campus_id'],
                // 'academic_term_id' => $student->academic_term_id,
            ])->get()->last()->session_start_date;

            $session_start_date = new \DateTime(str_replace('/', '-', $start_date));
            // NOTE: get course code
            $course_code = $course->courseSessions()->where(['organization_campus_id' => $student->organization_campus_id, 'session_id' => $student->session_id])->get()->last()->course_code ?? 'CODENOTFOUND';
            // NOTE: Generating shift id
            $student_shift = $student->shift_id == 0 ? 'M' : ($student->shift_id == 1 ? 'E' : ($student->shift_id == 2 ? 'W' : ''));

            // NOTE: Find Previous Roll Number
            SystemRollNumber::where('student_id', $student->id)->update([
                'student_id' => null,
            ]);

            // NOTE: Create New Roll Number
            $student_roll_no = OrganizationCampus::find($input['organization_campus_id'])->code . '-' . AffiliatedBody::find($input['affiliated_body_id'])->code . '-' . $session_start_date->format('Y') . '-' . $course_code . '-' . $student_shift . '-' . sprintf('%05d', intval($courseStudentCount));

            // NOTE: System roll number generation array
            $system_roll_no_input = [
                'is_assigned' => true,
                'course_id' => $course->id,
                'session_id' => $session->id,
                'student_id' => $student->id,
                'course_name' => $course->name,
                'roll_no' => $student_roll_no,
                'generated_at_length' => $courseStudentCount,
                'admission_form_code' => $admission->form_no,
                'student_name' => $student->student_name,
                'session_name' => $session->session_name,
                'admission_id' => $student->admission_id,
                'organization_campus_id' => $input['organization_campus_id'],
            ];
            $system_roll_no = SystemRollNumber::create($system_roll_no_input);
            // NOTE: Update Roll Number on Student Table
            $student->course_id = $course->id;
            $student->course_name = $course->name;
            $student->roll_no = $student_roll_no;
            $student->affiliated_body_id = $input['affiliated_body_id'];
            $student->system_roll_number_id = $system_roll_no->id;
            $student->academic_term_id = $course->courseSessions()->where(['organization_campus_id' => $input['organization_campus_id'], 'session_id' => $student->session_id])->get()->last()->academic_term_id;
            $student->organization_campus_id = $input['organization_campus_id'];
            $student->update();

            //NOTE: update from admissions
            $admission = Admission::where('student_id', $student->id)->latest()->first();
            $admission->course_id = $course->id;
            $admission->course_name = $course->name;
            $admission->affiliated_body_id = $input['affiliated_body_id'];
            $admission->organization_campus_id = $input['organization_campus_id'];
            $admission->update();

            // NOTE" shift uploaded content to new folder if roll number is updated

            /*if (is_dir(config('constants.attachment_path.file_destination_path') . '/Students/' . $old_roll_no)) {
            rename(config('constants.attachment_path.file_destination_path') . '/Students/' . $old_roll_no, config('constants.attachment_path.file_destination_path') . '/Students/' . $student->roll_no); //rename folder
            }*/

            // NOTE: DELETE previous academic history
            StudentAcademicHistory::where('student_id', $student->id)->get()->last()->delete();

            // NOTE: Create academic history
            $studentAcademicHistory = new StudentAcademicHistory;
            $studentAcademicHistory->student_id = $student->id;
            $studentAcademicHistory->course_id = $course->id;
            $studentAcademicHistory->course_name = $course->name;
            $studentAcademicHistory->session_id = $session->id;
            $studentAcademicHistory->session_name = $session->session_name;
            $studentAcademicHistory->is_promoted = false;
            $studentAcademicHistory->semester = $student->semester;
            $studentAcademicHistory->semester_id = $student->semester_id;
            $studentAcademicHistory->organization_campus_id = $input['organization_campus_id'];
            $studentAcademicHistory->save();

            // NOTE: Update Student Course Subjects
            if (isset($input['subject_names'])) {
                // NOTE: SAVE NEW RECORDS
                foreach ($input['subject_names'] as $index => $value) {
                    $studentBook = new StudentBook;
                    $studentBook->subject_name = $value;
                    $studentBook->subject_id = Subject::where('name', '=', $value)->get()->first()->id;
                    $studentBook->student_academic_history_id = $studentAcademicHistory->id;
                    $studentBook->organization_campus_id = $input['organization_campus_id'];
                    $studentBook->save();
                }
            }

            // update new roll number to pwwb file if student category is pwwb
            if ($student->student_category_id == 0) {
                $pwwbFile = IndexTable::find($admission->pwwb_file_id);
                $pwwbFile->roll_no = $student_roll_no;
                $pwwbFile->update();
            }

            Notify::success('Student Course Updated Successfully!', 'New Roll Number: ' . $student_roll_no);
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    Notify::error($message, 'Code: ' . $e->getCode());
                    return redirect()->back();
                } else {
                    Notify::error('Something went wrong!', 'Code: ' . $e->getCode());
                    return redirect()->back();
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[0])) . '"';
                Notify::error($message, 'Code: ' . $e->getCode());
                return redirect()->back();
            }
        }
    }

    public function updateAcademicRecords(Request $request, Student $student)
    {
        // dd($request->all());
        try {
            // update department if exists
            if ($request->exists('records')) {
                foreach ($request->records as $key => $record) {
                    // Save attachments
                    $academicRecord = AcademicRecord::updateOrCreate(['id' => $record['id']],
                        [
                            'type_id' => $record['type_id'] ?? '',
                            'type_name' => config('constants.previous_degrees')[$record['type_id']] ?? '',
                            'year' => $record['years'] ?? '',
                            'roll_no' => $record['rollNumbers'] ?? '',
                            'marks' => $record['marks'] ?? '',
                            'total_marks' => $record['totalMarks'] ?? '',
                            'percentage' => $record['percentages'] ?? '',
                            'grade' => $record['grades'] ?? '',
                            'board_uni' => $record['boards'] ?? '',
                            'student_id' => $student->id,
                            'admission_id' => $student->admission_id,
                            'school_college' => $record['schools'] ?? '',
                            'other_degree_name' => $record['other_degree_name'] ?? '',
                            // 'attachment_url' => $record['newAttachments'] ?? '',
                            'organization_campus_id' => $student->organization_campus_id,
                        ]);
                }
            }
            \DB::commit();
            Notify::success('Student Academic Records Updated Successfully!', 'Sucess');
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message = str_replace('_unique', '', $exception_message);
                    $message = str_replace('key', '', $replaced_message);
                    Notify::error($message);
                    return redirect()->back();
                } else {
                    Notify::error($message);
                    return redirect()->back();
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[0])) . '"';
                Notify::error($message);
                return redirect()->back();
            }
        }
    }

    public function deleteAcademicRecords(Request $request, AcademicRecord $record)
    {
        if (request()->ajax()) {
            $student = Student::find($record->student_id);
            $path = \FileUploader::studentDestinationPath($student, 'academic_records', $record->attachment_url);

            // delete file from server if exists
            if (file_exists($path)) {
                @unlink($path);
            }
            // delete from db
            $record->delete();
            return response()->json('Record Deleted Successfully!');
        }
    }

    public function uploadAcademicAttachment(Request $request, AcademicRecord $record)
    {
        if (request()->ajax()) {
            $student = Student::find($record->student_id);
            // Ready Attachment
            if (isset($request->attachment)) {
                $directory = \FileUploader::makeDirectory(false, $student, 'academic_records');
                $fileName = '';
                $file = $request->attachment;
                $timestamp = str_slug(Carbon::now()->toDateTimeString());
                $fileName = $timestamp . '-' . $record->type_id . '-' . rand(1, 10) . '-academic-attachment.' . $file->guessExtension();
                $file->move($directory, $fileName);
                // store in table
                $record->attachment_url = $fileName;
                $record->update();
                return response()->json(['success' => true]);
            }
        }
    }

}
