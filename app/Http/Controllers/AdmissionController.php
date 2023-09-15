<?php

namespace App\Http\Controllers;

use Alertify;
use App\Exports\Admissions\AdmissionListExport;
use App\Models\AcademicRecord;
use App\Models\Admission;
use App\Models\AdmissionByEnquiryForm;
use App\Models\AdmissionByPwwbForm;
use App\Models\AffiliatedBody;
use App\Models\AffiliatedBodyChecklist;
use App\Models\City;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\OrganizationCampus;
use App\Models\Pwwb\IndexTable;
use App\Models\Reference;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentAttachment;
use App\Models\StudentBook;
use App\Models\StudentContactInformation;
use App\Models\Subject;
use App\Models\SystemRollNumber;
use App\User;
use Carbon\Carbon;
use ConstantStrings;
use Excel;
use Globals;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class AdmissionController extends Controller
{

    public $table_name            = 'students';
    public $model_path            = 'App\Models\Student';
    public $empty_session_title   = 'Whoops!';
    public $empty_session_message = 'Please select session first to proceed.';
    public $empty_campus_message  = 'Please select campus first to proceed.';
    public $filters_configuration = [];

    public function __construct()
    {
        // dd(auth()->user());
        $this->filters_configuration = [
            'addFilters'         => true,
            'can_filters'        => false,
            'clear_filters'      => false,
            'date_filter_column' => 'admission_date',
            'has_joins'          => true,
            'joins'              => [
                'joins_count' => 0,
                'params'      => [
                    'admissions' => [
                        'reference_in_current' => 'students.admission_id',
                        'conditional_sign'     => '=',
                        'reference_in_join'    => 'admissions.id',
                    ], /*
                'fee_packages' => [
                'reference_in_current' => 'admissions.student_id',
                'conditional_sign' => '=',
                'reference_in_join' => 'fee_packages.student_id',
                ],
                'fee_package_installments' => [
                'reference_in_current' => 'fee_packages.id',
                'conditional_sign' => '=',
                'reference_in_join' => 'fee_package_installments.package_id',
                ],*/
                ],
                'select'      => [
                    'students'   => [
                        'selective_columns' => false,
                        'columns'           => [], // Empty array means system will fetch the data for all columns of this table
                    ],
                    'admissions' => [
                        'selective_columns' => true,
                        'columns'           => [
                            'form_no' => [
                                'sum'        => [],
                                'count'      => [],
                                'as'         => null,
                                'conditions' => null,
                            ],
                        ],
                    ], /*
                'fee_packages' => [
                'selective_columns' => true,
                'columns' => [
                'total_package' => [
                'sum' => [],
                'count' => [],
                'as' => null,
                'conditions' => null,
                ],
                ],
                ],
                'fee_package_installments' => [
                'selective_columns' => true,
                'columns' => [
                'amount_per_installment' => [
                'sum' => [
                0 => [
                'as' => 'total_payed',
                'where' => [
                'when_clause' => 'fee_package_installments.status_id=1',
                'else_clause' => '0',
                ],
                ],
                1 => [
                'as' => 'out_standing',
                'where' => [
                'when_clause' => 'fee_package_installments.status_id=0',
                'else_clause' => '0',
                ],
                ],
                3 => [
                'as' => 'receivable_till_date',
                'where' => [
                'when_clause' => 'fee_package_installments.status_id=0 AND fee_package_installments.due_date lessthan ' . date('Y-m-d'),
                'else_clause' => '0',
                ],
                ],
                ],
                'count' => false,
                'as' => null,
                'conditions' => [
                0 => [
                'column_name' => 'staus_id',
                'value' => '1',
                ],
                ],
                ],
                ],
                ],*/
                ],
            ],
            'filters'            => [
                'users'                 => [
                    'id'                   => 'user_id',
                    'label'                => 'Users',
                    'type'                 => 'select',
                    'value'                => \App\User::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                    'visibility'           => true,
                    'column_name'          => 'user_id',
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'conditional_operator' => '=',
                ],
                'students'              => [
                    'id'                   => 'student_id',
                    'label'                => 'Students',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'student_id',
                    'conditional_operator' => '=',
                    'type'                 => 'select',
                    'value'                => \App\Models\Student::orderBy('student_name')->get()->pluck('student_name', 'id')->toArray(),
                ],
                'courses'               => [
                    'label'                => 'Courses',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'course_id',
                    'conditional_operator' => '=',
                    'id'                   => 'course_id',
                    'type'                 => 'select',
                    'value'                => \App\Models\Course::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],
                'affiliated_bodies'     => [
                    'label'                => 'Affiliated Bodies',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'affiliated_body_id',
                    'conditional_operator' => '=',
                    'id'                   => 'affiliated_body_id',
                    'type'                 => 'select',
                    'value'                => \App\Models\AffiliatedBody::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],
                'parts'                 => [
                    'label'                => 'Part/ Semester',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'part_id',
                    'conditional_operator' => '=',
                    'id'                   => 'part_id',
                    'type'                 => 'select',
                ],
                'sessions'              => [
                    'label'                => 'Sessions',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'session_id',
                    'conditional_operator' => '=',
                    'id'                   => 'session_id',
                    'type'                 => 'select',
                ],
                'subjects'              => [
                    'label'                => 'Subejcts',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'subject_id',
                    'conditional_operator' => '=',
                    'id'                   => 'subject_id',
                    'type'                 => 'select',
                ],
                'roles'                 => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'admission_forms'       => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'departments'           => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'designations'          => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'visitor_users'         => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'sections'              => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'admission_types'       => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'enquiry_categories'    => [
                    'label'                => 'Enquiry Category',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'student_category_id',
                    'conditional_operator' => '=',
                    'id'                   => 'student_category_id',
                    'type'                 => 'select',
                    'value'                => config('constants.student_categories'),
                ],
                'admission_categories'  => [
                    'label'                => 'Admission Category',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'student_category_id',
                    'conditional_operator' => '=',
                    'id'                   => 'student_category_id',
                    'type'                 => 'select',
                    'value'                => config('constants.student_categories'),
                ],
                'enquiry_types'         => [
                    'label'                => 'Enquiry Types',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'enquiry_type',
                    'conditional_operator' => '=',
                    'id'                   => 'enquiry_type',
                    'type'                 => 'select',
                    'value'                => config('constants.enquiry_types'),
                ],
                'enquiry_statuses'      => [
                    'label'                => 'Enquiry Statuses',
                    'visibility'           => false,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'status_id',
                    'conditional_operator' => '=',
                    'id'                   => 'status_id',
                    'type'                 => 'select',
                    'value'                => config('constants.followup_statuses'),
                ],
                'source_of_information' => [
                    'label'                => 'Sources of Information',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'source_info_id',
                    'conditional_operator' => '=',
                    'id'                   => 'source_info_id',
                    'type'                 => 'select',
                    'value'                => config('constants.information_sources'),
                ],
                'cities'                => [
                    'label'                => 'Town/ City',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'city_id',
                    'conditional_operator' => '=',
                    'id'                   => 'city_id',
                    'type'                 => 'select',
                    'value'                => \App\Models\City::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],
                'shifts'                => [
                    'label'                => 'Shift',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'shift_id',
                    'conditional_operator' => '=',
                    'id'                   => 'shift_id',
                    'type'                 => 'select',
                    'value'                => config('constants.shifts'),
                ],
                'end_of_registrations'  => [
                    'label'                => 'Registration Status',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'is_end_of_reg',
                    'conditional_operator' => '=',
                    'id'                   => 'is_end_of_reg',
                    'type'                 => 'select',
                    'value'                => ['0' => 'Not Ended' , '1' => 'Ended'],
                ],
                'heads'                 => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'fee_structure_types'   => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'payment_statuses'      => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'voucher_statuses'      => [
                    'visibility'          => false,
                    'search_through_join' => false,
                    'join_table'          => null,
                ],
                'start_date'            => [
                    'label'                => 'Start Date',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'admission_date',
                    'id'                   => 'start_date',
                    'type'                 => 'date',
                    'conditional_operator' => '>=',
                    'value'                => date('Y-m-d'),
                ],
                'end_date'              => [
                    'label'                => 'End Date',
                    'visibility'           => true,
                    'search_through_join'  => false,
                    'join_table'           => null,
                    'column_name'          => 'admission_date',
                    'conditional_operator' => '<=',
                    'id'                   => 'end_date',
                    'type'                 => 'date',
                    'value'                => date('Y-m-d'),
                ],
            ],
        ];
    }


    

    public function profile()
    {
        return view('installmentPlan.create');
    }

    public function index(Request $request)
    {
        return view('admissions.index')->with('table_cols_configuration', Globals::getTableColumnsConfiguation($this->table_name))->with('model_path', $this->model_path)->with('table_name', $this->table_name)->with('filters_configuration', $this->filters_configuration);

        if (!empty(SystemSession::get('organization_campus_id'))) {
            if (!empty(SystemSession::get('selected_session_id'))) {
                return view('admissions.index')->with('table_cols_configuration', Globals::getTableColumnsConfiguation($this->table_name))->with('model_path', $this->model_path)->with('table_name', $this->table_name)->with('filters_configuration', $this->filters_configuration);
            } else {
                Notify::error($this->empty_session_message, $this->empty_session_title = null, $options = []);
                return redirect()->back();
            }
        } else {
            Notify::error($this->empty_campus_message, $this->empty_session_title = null, $options = []);
            return redirect()->back();
        }

        return view('admissions.index')->with('table_cols_configuration', Globals::getTableColumnsConfiguation($this->table_name))->with('model_path', $this->model_path)->with('table_name', $this->table_name)->with('filters_configuration', $this->filters_configuration);
    }

    public function export()
    {
        ob_end_clean();
        return Excel::download(new AdmissionListExport, 'AdmissionLists.xlsx');
    }

    public function getFilteredData(Request $request)
    {
        $admissions = Admission::where('old_roll_no', '=', $request['old_roll_no'])->paginate(ConstantStrings::PAGINATION_RANGE);
        // $admission_keys = [];
        // if (count($admissions) != 0) {
        //     $admission_keys = array_keys($admissions->toArray()[0]);
        // // }

        return view('admissions.index')
            ->with('data', $admissions)->with('filters_configuration', $this::$filters_configuration) /*->with(['admission_keys' => $admission_keys])*/;
    }

    public function create()
    {
        $courses    = Course::all()->pluck('name', 'id');
        $references = Reference::all()->pluck('name', 'id');
        $cities     = City::orderBy('name')->pluck('name', 'id');

        return view('admissions.create')->with(['courses' => $courses, 'cities' => $cities, 'references' => $references]);
    }

    public function getAdmissionFormCode($organization_campus_id, $session_id, $course_id)
    {
        $number;
        $campus_code  = OrganizationCampus::find($organization_campus_id)->code;
        $session_code = SessionCourse::where('session_id', $session_id)->where('course_id', $course_id)->get()->last()->getSessionStartYear();
        $admissions   = Admission::withTrashed()->where('organization_campus_id', $organization_campus_id)->where('session_id', $session_id)->get();
        if (!$admissions) {
            $number = 0;
        } else {
            $number = sizeof($admissions);
        }
        return 'CFE-' . $campus_code . '-' . $session_code . '-' . sprintf('%05d', intval($number) + 1);
    }

    public function store(Request $request)
    {
        $data  = $request->all();
        $input = json_decode($data['data'], true);
        // dd($data['academic_attachments']);
        try {
            \DB::beginTransaction();
            // adding check for dual degree
            if (Admission::where(['student_cnic_no' => $input['student_cnic_no'], 'student_category_id' => $input['student_category_id']])->get()->isNotEmpty()) {
                return response()->json(['success' => false, 'error' => "Student already exists against {$input['student_cnic_no']} CNIC no."], 500);
            }
            $course                          = Course::find($input['course_id']);
            $session                         = Session::find($input['session_id']);
            $input['session_name']           = $session->session_name;
            $input['organization_campus_id'] = SystemSession::get('organization_campus_id');
            // $section_code;
            // $section;

            // if (isset($input['section_id']) && !empty($input['section_id'])) {
            //     $section = Section::find($input['section_id']);
            //     $section_code = $section->code;
            // }

            $input['degree_level_id'] = $course->degree_level_id;
            $admission                = Admission::create($input);

            $student_input                 = $input;
            $student_input['admission_id'] = $admission->id;
            $student                       = Student::create($student_input);

            // if (isset($input['section_id']) && !empty($input['section_id'])) {
            //     $sectionStudentInput = ['section_id' => $input['section_id'], 'student_id' => $student->id, 'organization_campus_id' => $input['organization_campus_id']];
            //     $sectionStudent = SectionStudent::create($sectionStudentInput);
            // }
            $courseWiseStudents = SystemRollNumber::withTrashed()->where('organization_campus_id', '=', $input['organization_campus_id'])->where('course_id', '=', $input['course_id'])->where('session_id', '=', $input['session_id'])->get();
            $courseStudentCount;
            if (!empty($courseWiseStudents) && count($courseWiseStudents) == 0) {
                $courseStudentCount = 1;
            } else {
                $courseStudentCount = $courseWiseStudents->last()->generated_at_length + 1;
            }
            $start_date = SessionCourse::where('session_id', $input['session_id'])->where('course_id', $input['course_id'])->where('academic_term_id', $input['academic_term_id'])->where('organization_campus_id', '=', $input['organization_campus_id'])->get()->last()->session_start_date;

            $session_start_date = new \DateTime(str_replace('/', '-', $start_date));

            $course_code   = $course->courseSessions()->where(['organization_campus_id' => SystemSession::get('organization_campus_id'), 'session_id' => SystemSession::get('selected_session_id')])->get()->last()->course_code ?? 'CODENOTFOUND';
            $student_shift = $student->shift_id == 0 ? 'M' : ($student->shift_id == 1 ? 'E' : ($student->shift_id == 2 ? 'W' : ''));
            $student_roll_no;

            // if (isset($input['section_id']) && !empty($input['section_id']) && $course->wing_id == 2) {
            //     $student_roll_no = OrganizationCampus::find($input['organization_campus_id'])->code . '-' . $session_start_date->format('Y') . '-' . $course_code . '-' . $section_code . '-' . $student_shift . '-' .sprintf('%05d', intval($courseStudentCount));
            // } else {
            $student_roll_no = OrganizationCampus::find($input['organization_campus_id'])->code . '-' . AffiliatedBody::find($admission->affiliated_body_id)->code . '-' . $session_start_date->format('Y') . '-' . $course_code . '-' . $student_shift . '-' . sprintf('%05d', intval($courseStudentCount));

            // }
            $system_roll_no_input = ['roll_no' => $student_roll_no, 'session_id' => $input['session_id'], 'course_id' => $input['course_id'], 'student_id' => $student->id, 'admission_id' => $admission->id, 'session_name' => $input['session_name'], 'student_name' => $student->student_name, 'course_name' => $input['course_name'], 'is_assigned' => true, 'generated_at_length' => $courseStudentCount, 'organization_campus_id' => $input['organization_campus_id']];
            $system_roll_no       = SystemRollNumber::create($system_roll_no_input);

            // if (isset($input['section_id']) && !empty($input['section_id'])) {
            //     $system_roll_no->section_id = $input['section_id'];
            //     $system_roll_no->section_name = $section->name;
            //     $system_roll_no->update();
            // }

            $student->roll_no               = $student_roll_no;
            $student->user_id               = \Auth::user()->id;
            $student->user_name             = \Auth::user()->display_name;
            $student->affiliated_body_id    = $admission->affiliated_body_id;
            $student->system_roll_number_id = $system_roll_no->id;
            $student->update();

            if (isset($input['acadmicRecords']) && !empty($input['acadmicRecords'])) {
                $acadmicRecords = $input['acadmicRecords'];
                $directory      = \FileUploader::makeDirectory(false, $student, 'academic_records');
                // loop
                foreach ($acadmicRecords as $key => $acadmicRecord) {
                    // db store
                    $acadmicRecord['student_id']             = $student->id;
                    $acadmicRecord['admission_id']           = $admission->id;
                    $acadmicRecord['organization_campus_id'] = $input['organization_campus_id'];

                    // upload attachment type_id
                    if (isset($data['academic_attachments'][$acadmicRecord['type_id']])) {
                        $fileName  = '';
                        $file      = $data['academic_attachments'][$acadmicRecord['type_id']];
                        $timestamp = str_slug(Carbon::now()->toDateTimeString());
                        $fileName  = $timestamp . '-' . $acadmicRecord['type_id'] . '-' . rand(1, 10) . '-academic-attachment.' . $file->guessExtension();
                        $file->move($directory, $fileName);
                        // store in table
                        $acadmicRecord['attachment_url'] = $fileName;
                    }
                    AcademicRecord::create($acadmicRecord);
                }
            }
            $admission->student_id               = $student->id;
            $admission->user_id                  = \Auth::user()->id;
            $admission->affiliated_body_id       = $admission->affiliated_body_id;
            $admission->user_name                = \Auth::user()->display_name;
            $form_code                           = $this->getAdmissionFormCode($input['organization_campus_id'], $admission->session_id, $admission->course_id);
            $system_roll_no->admission_form_code = $form_code;
            $system_roll_no->update();
            $admission->form_no = $form_code;
            $admission->update();

            if (isset($input['enquiry_id'])) {
                $enquiry            = Enquiry::find($input['enquiry_id']);
                $enquiry->status_id = 3;
                $enquiry->status    = config('constants.followup_statuses')[3];
                $enquiry->save();
                $admissionByEnquiryForms = AdmissionByEnquiryForm::where('enquiry_id', '=', $input['enquiry_id'])->get();
                foreach ($admissionByEnquiryForms as $key => $value) {
                    $admissionByEnquiryForm              = AdmissionByEnquiryForm::find($value->id);
                    $admissionByEnquiryForm->is_admitted = true;
                    $admissionByEnquiryForm->update();
                }
            }

            // IF ADMISSION IS COMING FROM PWWB CONFIRMATION
            if (isset($input['pwwb_id'])) {
                // FIND PWWB FILE FROM INDEX TABLE
                $pwwbFile               = IndexTable::find($input['pwwb_id']);
                $pwwbFile->admitted     = true;
                $pwwbFile->admission_id = $admission->id;
                $pwwbFile->roll_no      = $student_roll_no;
                $pwwbFile->update();

                // UPDATE ADMISSION
                $admission->pwwb_file_id = $pwwbFile->id;
                $admission->update();

                // ADD ENTRY FOR PWWB FORM
                AdmissionByPwwbForm::create([
                    'admission_id'           => $admission->id,
                    'index_table_id'         => $pwwbFile->id,
                    'is_admitted'            => true,
                    'organization_campus_id' => $input['organization_campus_id'],
                ]);
            }

            $studentAcademicHistory                         = new StudentAcademicHistory;
            $studentAcademicHistory->course_name            = $input['course_name'];
            $studentAcademicHistory->course_id              = $input['course_id'];
            $studentAcademicHistory->session_name           = $input['session_name'];
            $studentAcademicHistory->organization_campus_id = $input['organization_campus_id'];
            $studentAcademicHistory->session_id             = $input['session_id'];
            $studentAcademicHistory->is_promoted            = false;
            $studentAcademicHistory->semester_id            = $admission->semester_id;
            $studentAcademicHistory->semester               = $admission->semester;
            $studentAcademicHistory->student_id             = $student->id;
            $studentAcademicHistory->save();

            foreach ($input['courseBooks'] as $index => $value) {
                $studentBook                              = new StudentBook;
                $studentBook->subject_name                = $value;
                $studentBook->subject_id                  = Subject::where('name', '=', $value)->get()->first()->id;
                $studentBook->student_academic_history_id = $studentAcademicHistory->id;
                $studentBook->organization_campus_id      = $input['organization_campus_id'];
                $studentBook->save();
            }

            // STORE STUDENT CONTACT INFORMATION
            if (isset($input['contact_infos'])) {
                foreach ($input['contact_infos'] as $key => $contact_info) {
                    $contact_info['student_id']   = $student->id;
                    $contact_info['admission_id'] = $admission->id;
                    StudentContactInformation::create($contact_info);
                }
            }

            // save affilated bodies checklists
            if (isset($input['checklist'])) {
                foreach ($input['checklist'] as $key => $checklist) {
                    $admission->affiliatedBodyChecklists()->create([
                        'affiliated_body_checklist_id' => $checklist['id'],
                        'is_checked'                   => $checklist['status'],
                    ]);
                }
            }

            // NOTE: check if there's any false in checklist then update admission
            if (array_search(false, array_column($input['checklist'], 'status'))) {
                $admission->checklist_incomplete = true;
                $admission->update();
            }

            // NOTE: Upload and save profile if exists
            if ($request->has('profile_image')) {
                // create a new directory in specific student folder
                $directory = \FileUploader::makeDirectory(false, $student, 'profile');
                // put profile image in directory and update DB
                \FileUploader::saveProfilePicture($admission, $data['profile_image'], $directory);
            }

            if (isset($data['files'])) {
                $directory = \FileUploader::makeDirectory(false, $student, 'attachments');
                foreach ($data['files'] as $key => $file) {
                    if (isset($input['attachmentData'][$key])) {
                        $attachment_type      = config('constants.attachment_types')[$input['attachmentData'][$key]];
                        $attachment_file_ext  = $file->guessExtension();
                        $attachment_file_name = time() . '_' . Str::snake($attachment_type) . '.' . $attachment_file_ext;
                        // save data to DB
                        $attachment = StudentAttachment::create([
                            'attachment_name'    => $student->student_name . '-' . "Attachment",
                            'attachment_for'     => $student->id,
                            'attachment_url'     => $attachment_file_name,
                            'attachment_from'    => "App\Models\Admission",
                            'attachment_type_id' => $input['attachmentData'][$key],
                            'attachment_type'    => $attachment_type,
                        ]);
                        // move file
                        $file->move($directory, $attachment_file_name);
                    }
                }
            }

            Alertify::success('Admission saved successfully.');
            $student_academic_histories = StudentAcademicHistory::where('student_id', '=', $student->id)->where('organization_campus_id', '=', $input['organization_campus_id'])->get()->last();

            $sessionCourse = SessionCourse::where('session_id', '=', $input['session_id'])->where('course_id', $input['course_id'])->where('academic_term_id', $input['academic_term_id'])->where('organization_campus_id', '=', $input['organization_campus_id'])->first();

            $academic_history_id = $student_academic_histories->id;

            \DB::commit();
            return response()->json(['admission_form_no' => $admission->form_no, 'student' => $student, 'sessionCourse' => $sessionCourse, 'academic_history_id' =>
                $academic_history_id], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message  = str_replace('_unique', '', $exception_message);
                    $message           = str_replace('key', '', $replaced_message);
                    return response()->json(['success' => false, 'error' => $message], 500);
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message                = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message                          = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }

        }
    }

    public function getAffiliatedBodyCheckLists($id)
    {
        $ab = AffiliatedBodyChecklist::where('affiliated_body_id', $id)->get();
        return response()->json($ab, 200);
    }

// public function UploadAdmissionAttachment($id){
    //         $admission = Admission::find($id);
    //     return view('admissions.admission_attachment');
    // }
    // public function StoreAdmissionAttachment(Request $request){
    //     $input = $request->all();
    //     $admission = Admission::get()->first();
    //     $attachment = new Attachment();
    //     $attachment_file_name = $input['attachment']->getClientOriginalName();
    //     $attachment_file_name = time().$attachment_file_name;
    //     $attachment_file_destination = public_path('/files');
    //     $input['attachment']->move($attachment_file_destination,$attachment_file_name);
    //     $attachment->attachment_url = $attachment_file_name;
    //     $attachment->admission_id =  $admission->id;
    //     $attachment->save();
    //     return redirect()->back();
    // }
    public function generateQRCode($student)
    {

        try {
            \DB::beginTransaction();
            $input         = $student->only(['id', 'student_name']);
            $qr_code_name  = $student->student_name . '-' . $student->roll_no . '.png';
            $input['type'] = 'student';
            // $qr_code_server = \QRCode::text(json_encode($input, true));
            // $qr_code_server->setErrorCorrectionLevel('H');
            // $qr_code_server->setSize(4);
            // $qr_code_server->setMargin(2);
            // $qr_code_server->setOutfile(public_path(config('constants.attachment_path.student_qr_destination_path')) . $qr_code_name . '.png');
            // $qr_code_server->png();
            $directory = \FileUploader::makeDirectory(false, $student, 'qr_codes');

            \QrCode::errorCorrection('H')->format('png')->encoding('UTF-8')->size(180)
                ->generate(json_encode($input, true), $directory . $qr_code_name);

            // $qr_code = \QRCode::text(json_encode($input, true));
            // $qr_code->setErrorCorrectionLevel('H');
            // $qr_code->setSize(4);
            // $qr_code->setMargin(2);
            // $qr_code->setOutfile($directory . $qr_code_name);
            // $qr_code->png();

            $student->qr_code_name = $qr_code_name;
            $student->update();
            \DB::commit();
        } catch (\Exception $e) {
            \DB::rollback();
        }
    }

    public function edit($id)
    {
        $admission = Admission::find($id)->first();
        $courses   = Course::all();
        foreach ($courses as $key => $course) {
            foreach ($course->courseSessions()->get() as $course_key => $hascourse) {
                if (!$course['isChecked']) {
                    if ($course->id == $hascourse->course_id) {
                        $course->isChecked = true;
                    } else {
                        $course->isChecked = false;
                    }
                }
            }
        }
        $acadmicRecords = AcademicRecord::where('admission_id', '=', $id)->get();
        if ($admission) {
            return view('admissions.edit')->with(['admission' => $admission, 'acadmicRecords' => $acadmicRecords, 'courses' => $courses]);
        } else {
            Flash::error('No admission form found.');
        }

        return redirect(route('admissions.index'));
    }
    public function update($id, Request $request)
    {
        $input  = $request->all();
        $course = Course::find($id);

        if ($course) {
            $course->name                  = $input['name'];
            $course->duration              = $input['duration'];
            $course->no_of_semesters       = $input['no_of_semesters'];
            $course->duration_per_semester = $input['duration_per_semester'];
            $course->update();
            Flash::success('course details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding course.');
        }

        return redirect(route('admissions.index'));
    }

    public function destroy($id)
    {
        try {
            \DB::beginTransaction();
            $admission = Admission::find($id);
            $student   = Student::withTrashed()->where('admission_id', '=', $admission->id)->get()->first();

            if (empty($admission)) {
                Notify::error('admission not found');
                return redirect(route('admissions.index'));
            }

            if (empty($student)) {
                Notify::error('student not found');
                return redirect(route('admissions.index'));
            }
            // set pwwb file status to false if exists
            if (!empty($admission->pwwb_file_id)) {
                $indexTable = IndexTable::where('id', $admission->pwwb_file_id)->get()->last();
                $indexTable->update([
                    'admitted'     => false,
                    'admission_id' => null,
                    'roll_no'      => null,
                ]);
                // NOTE: delete from main table
                AdmissionByPwwbForm::where('index_table_id', $indexTable->id)->delete();
                Notify::info('Student Against ' . $indexTable->file_module_number . ' is now set to not admitted.', 'Pwwb Student Information');
            }
            $admission->delete();
            if (!$student->trashed()) {
                $student->delete();
            }
            Notify::success('Admission Deleted Successfully.', 'Form Code ' . $admission->form_no);
            \DB::commit();
            return redirect(route('admissions.index'));
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message  = str_replace('_unique', '', $exception_message);
                    $message           = str_replace('key', '', $replaced_message);
                    Notify::warning($message, 'Warning');
                    return redirect(route('admissions.index'));
                } else {
                    Notify::warning('Something went wrong!', 'Warning');
                    return redirect(route('admissions.index'));
                }
            } else {
                $exception_message                = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message                          = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                Notify::warning($message, 'Warning');
                return redirect(route('admissions.index'));
            }
        }
    }

    public function admissionGrowth()
    {
        $courses = Course::get();

        $current_date = new \DateTime();
        $current_date = $current_date->format('Y');
        $years_array  = [];
        for ($i = 0; $i < 5; $i++) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($years_array, $year);
        }

        return view('admissions.admission_growth')->with('years', $years_array)->with('course', $courses);
    }

    public function admissionMonthlyChart(Request $request)
    {

        $input                       = $request->all();
        $chart_array                 = [];
        $month_count                 = [];
        $datasets                    = [];
        $labels                      = [''];
        $chart_x_axis                = [];
        $available_years_with_months = [0];
        $admission_growth            = $input['admission_growth'];
        $admissions_dates            = Admission::whereYear('created_at', '=', $admission_growth)->get()->groupBy(function ($row) {
            return $row->created_at->format('M');
        })->toArray();
        foreach ($admissions_dates as $key => $unformatted_date) {
            array_push($labels, $key);
            array_push($available_years_with_months, count($unformatted_date));

        }

        array_push($chart_x_axis, $labels);
        array_push($datasets, ['data' => $available_years_with_months]);

        $chart_array = ['labels' => $labels, 'datasets' => $available_years_with_months];

        return response()->json(['chart_array' => $chart_array]);
    }
    public function admissionYearlyChart(Request $request)
    {
        $input             = $request->all();
        $value_to_subtract = $input['value_to_subtract'];
        $chart1_array      = [];
        $datasets          = [0];
        $year_counts       = [0];
        $chart_x_axis      = [''];
        for ($i = $value_to_subtract; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);

            $yearly_admission_count = Admission::whereYear('created_at', $year)->get()->count();
            array_push($year_counts, $yearly_admission_count);

        }
        array_push($datasets, ['data' => $year_counts]);
        $chart1_array = ['labels' => $chart_x_axis, 'datasets' => $year_counts];
        return response()->json(['chart1_array' => $chart1_array]);

    }
    public function courseAdmissionMonthlyChart(Request $request)
    {

        $input = $request->all();

        $datasets                    = [];
        $labels                      = [''];
        $datasets1                   = [''];
        $chart_x_axis                = [];
        $chart_array_course          = [];
        $available_course            = [0];
        $available_years_with_months = [0];

        $monthly_course   = $input['monthly_course'];
        $select_course    = $input['course'];
        $admissions_dates = Admission::whereYear('created_at', '=', $monthly_course)->where('course_id', '=', $select_course)->get()->groupBy(function ($row) {
            return $row->created_at->format('M');
        })->toArray();
        foreach ($admissions_dates as $key => $unformatted_date) {
            array_push($labels, $key);
            array_push($available_course, count($unformatted_date));
        }

        array_push($chart_x_axis, $labels);
        array_push($datasets, ['data' => $available_course]);
        $chart_array_course = ['labels' => $labels, 'datasets' => $available_course];
        return response()->json(['chart_array_course' => $chart_array_course]);
    }

    public function courseAdmissionYearlyChart(Request $request)
    {

        $input = $request->all();

        $datasets                    = [];
        $labels                      = [''];
        $chart_x_axis                = [];
        $chart_yearwise_array_course = [];
        $available_course_count      = [0];

        $yearwise_course = $input['yearwise_course'];
        for ($i = $yearwise_course; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);
            $select_course         = $input['getcourse'];
            $admissions_coursewise = Admission::whereYear('created_at', $year)->where('course_id', $select_course)->get()->count();
            array_push($available_course_count, $admissions_coursewise);
        }
        array_push($datasets, ['data' => $available_course_count]);
        $chart_yearwise_array_course = ['labels' => $chart_x_axis, 'datasets' => $available_course_count];
        return response()->json(['chart_yearwise_array_course' => $chart_yearwise_array_course]);
    }

    public function viewReporting(Request $request)
    {

        return view('admissions.reportings.index');
    }

    public function getReport(Request $request)
    {

        $enquiries                = Admission::where('created_at', '>=', $request['start_date'])->where('created_at', '<=', $request['end_date'])->where('session_id', '=', $request['session_id'])->get();
        $date_start_obj           = new \DateTime($request['start_date']);
        $date_end_obj             = new \DateTime($request['end_date']);
        $formated_date_range      = $date_start_obj->format('d-M-Y') . ' - ' . $date_end_obj->format('d-M-Y');
        $course_wise_enquiries    = [];
        $user_wise_enquiries      = [];
        $courses                  = Course::get();
        $users                    = User::with('roles')->get();
        $total_courses_paid_count = 0;
        $total_courses_pwwb_count = 0;
        $total_courses_enq_count  = 0;
        foreach ($courses as $key => $course) {
            $course_wise_enquiry_count = $enquiries->where('course_id', '=', $course->id)->count();
            $total_courses_enq_count   = $total_courses_enq_count + $course_wise_enquiry_count;

            $course_wise_enquiries_pwwb_count = $enquiries->where('course_id', '=', $course->id)->where('student_category_id', '=', '0')->count();
            $total_courses_pwwb_count         = $total_courses_pwwb_count + $course_wise_enquiries_pwwb_count;

            $course_wise_enquiries_paid_count = $enquiries->where('course_id', '=', $course->id)->where('student_category_id', '=', '1')->count();
            $total_courses_paid_count         = $total_courses_paid_count + $course_wise_enquiries_paid_count;

            $reporting_object = ['course_name' => $course->name, 'total_count' => $course_wise_enquiry_count, 'pwwb_count' => $course_wise_enquiries_pwwb_count, 'paid_count' => $course_wise_enquiries_paid_count];
            array_push($course_wise_enquiries, $reporting_object);
        }
        $total_emp_paid_count = 0;
        $total_emp_pwwb_count = 0;
        $total_emp_enq_count  = 0;
        foreach ($users as $key => $user) {
            if ($user->departmentUsers()->get()->first() ? $user->departmentUsers()->get()->first()->department->id == 1 : false) {
                $user_wise_enquiry_count = $enquiries->where('user_id', '=', $user->id)->count();
                $total_emp_enq_count     = $total_emp_enq_count + $user_wise_enquiry_count;

                $user_wise_enquiries_pwwb_count = $enquiries->where('user_id', '=', $user->id)->where('student_category_id', '=', '0')->count();
                $total_emp_pwwb_count           = $total_emp_pwwb_count + $user_wise_enquiries_pwwb_count;

                $user_wise_enquiries_paid_count = $enquiries->where('user_id', '=', $user->id)->where('student_category_id', '=', '1')->count();
                $total_emp_paid_count           = $total_emp_paid_count + $user_wise_enquiries_paid_count;

                $reporting_object = ['user_name' => $user->display_name, 'total_count' => $user_wise_enquiry_count, 'pwwb_count' => $user_wise_enquiries_pwwb_count, 'paid_count' => $user_wise_enquiries_paid_count];
                array_push($user_wise_enquiries, $reporting_object);
            }
        }
        return response()->json(['success' => 'true', 'message' => 'Data retrieved successfully', 'data' => ['formated_date_range' => $formated_date_range, 'user_wise_report' => $user_wise_enquiries, 'course_wise_report' => $course_wise_enquiries, 'total_courses_count' => ['total_courses_enq_count' => $total_courses_enq_count, 'total_courses_pwwb_count' => $total_courses_pwwb_count, 'total_courses_paid_count' => $total_courses_paid_count], 'total_emp_count' => ['total_emp_enq_count' => $total_emp_enq_count, 'total_emp_pwwb_count' => $total_emp_pwwb_count, 'total_emp_paid_count' => $total_emp_paid_count]]], 200);

    }

}
