<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AppBaseController;
use App\Http\Requests\CreateEnquiryRequest;
use App\Models\AdmissionByEnquiryForm;
use App\Models\AffiliatedBody;
use App\Models\City;
use App\Models\Country;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\EnquiryContactInfo;
use App\Models\EnquiryFollowup;
use App\Models\EnquiryWorker;
use App\Models\Reference;
use App\Models\Wing;
use App\Models\Session;
use App\Repositories\EnquiryRepository;
use App\User;
use ConstantStrings;
use Flash;
use Globals;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use odannyc\Alertify\Alertify;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use DB;
use Auth;
class EnquiryController extends AppBaseController
{
    private $enquiryRepository;
    public $table_name = 'enquiries';
    public $model_path = 'App\Models\Enquiry';
    public $empty_session_title = 'Whoops!';
    public $empty_session_message = 'Please select session first to proceed.';
    public $empty_campus_message = 'Please select campus first to proceed.';
    public $filters_configuration = [];
    public $user;

    public function __construct(EnquiryRepository $enquiryRepo)
    {
        $this->middleware(['auth', 'is_guest'])->except(['store', 'update']);
        $this->enquiryRepository = $enquiryRepo;
    }
    public function filterConfig()
    {
        $this->filters_configuration = [
            'addFilters' => true,
            'can_filters' => false,
            'clear_filters' => false,
            'date_filter_column' => 'enquiry_date',
            'has_joins' => true,
            'joins' => [
                'joins_count' => 2,
                'params' => [
                    'enquiry_contact_infos' => [
                        'reference_in_current' => 'enquiries.id',
                        'conditional_sign' => '=',
                        'reference_in_join' => 'enquiry_contact_infos.enquiry_id',
                    ],
                    'enquiry_workers' => [
                        'reference_in_current' => 'enquiries.id',
                        'conditional_sign' => '=',
                        'reference_in_join' => 'enquiry_workers.enquiry_id',
                    ],
                ],
                'select' => [
                    'enquiries' => [
                        'selective_columns' => false,
                        'columns' => [], // Empty array means system will fetch the data for all columns of this table
                    ],
                    'enquiry_contact_infos' => [
                        'selective_columns' => true,
                        'columns' => [
                            'id' => [
                                'sum' => [],
                                'count' => [],
                                'as' => 'contact_info_id',
                                'conditions' => null,
                            ],
                            'phone_no' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                        ],
                    ],
                    'enquiry_workers' => [
                        'selective_columns' => true,
                        'columns' => [
                            'factory_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                        ],
                    ],
                ],
            ],
            'filters' => [
                'users' => [
                    'label' => 'Enquiry By',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'user_id',
                    'conditional_operator' => '=',
                    'id' => 'user_id',
                    'type' => 'select',
                    'value' => \App\User::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],
                'entry_by' => [
                    'label' => 'Enquiry Entered By',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'entry_by',
                    'conditional_operator' => '=',
                    'id' => 'entry_by',
                    'type' => 'select',
                    'value' => \App\User::permission(['create_enquiries_management', 'update_enquiries_management'])->pluck('name', 'id')->toArray(),
                ],
                // 'students' => [
                //     'label' => 'Students',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'student_id',
                //     'conditional_operator' => '=',
                //     'id' => 'student_id',
                //     'type' => 'select',
                //     'value' => \App\Models\Student::orderBy('student_name')->get()->pluck('student_name', 'id')->toArray(),
                // ],

                // 'affiliated_bodies' => [
                //     'label' => 'Affiliated Bodies',
                //     'visibility' => true,
                //     'search_through_join' => true,
                //     'join_table' => 'enquiries',
                //     'column_name' => 'affiliated_body_id',
                //     'conditional_operator' => '=',
                //     'id' => 'affiliated_body_id',
                //     'type' => 'select',
                //     'value' => \App\Models\AffiliatedBody::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                // ],
                // 'parts' => [
                //     'label' => 'Part/ Semester',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'part_id',
                //     'conditional_operator' => '=',
                //     'id' => 'part_id',
                //     'type' => 'select',
                // ],
                // 'sessions' => [
                //     'label' => 'Sessions',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'session_id',
                //     'conditional_operator' => '=',
                //     'id' => 'session_id',
                //     'type' => 'select',
                // ],
                // 'subjects' => [
                //     'label' => 'Subejcts',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'subject_id',
                //     'conditional_operator' => '=',
                //     'id' => 'subject_id',
                //     'type' => 'select',
                // ],
                // 'roles' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'admission_forms' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'departments' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'designations' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'visitor_users' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'sections' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'admission_types' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'enquiry_categories' => [
                //     'label' => 'Enquiry Category',
                //     'visibility' => true,
                //     'search_through_join' => true,
                //     'join_table' => 'enquiries',
                //     'column_name' => 'student_category_id',
                //     'conditional_operator' => '=',
                //     'id' => 'student_category_id',
                //     'type' => 'select',
                //     'value' => config('constants.student_categories'),
                // ],
                'enquiry_types' => [
                    'label' => 'Enquiry Type(s)',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'enquiry_type',
                    'conditional_operator' => '=',
                    'id' => 'enquiry_type',
                    'type' => 'select',
                    'value' => config('constants.enquiry_types'),
                ],
                'enquiry_statuses' => [
                    'label' => 'Enquiry Status(s)',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'status',
                    'conditional_operator' => '=',
                    'id' => 'status_id',
                    'type' => 'select',
                    'value' => array_slice(config('constants.followup_statuses'), 0, 3, true),
                ],
                'source_of_information' => [
                    'label' => 'Source(s) of Information',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'source_info_id',
                    'conditional_operator' => '=',
                    'id' => 'source_info_id',
                    'type' => 'select',
                    'value' => config('constants.information_sources'),
                ],
                'cities' => [
                    'label' => 'City',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'city_id',
                    'conditional_operator' => '=',
                    'id' => 'city_id',
                    'type' => 'select',
                    'value' => \App\Models\City::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],
                'project' => [
                    'label' => 'Project(s)',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'project_id',
                    'conditional_operator' => '=',
                    'id' => 'project_id',
                    'type' => 'select',
                    'value' => \App\Models\Wing::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],
                'courses' => [
                    'label' => 'Product(s)',
                    'visibility' => true,
                    'search_through_join' => true,
                    'join_table' => 'enquiries',
                    'column_name' => 'product_id',
                    'conditional_operator' => '=',
                    'id' => 'course_id',
                    'type' => 'select',
                    'value' => \App\Models\Course::orderBy('name')->get()->pluck('name', 'id')->toArray(),
                ],

                // 'form_bypass' => [
                //     'label' => 'Form Bypass',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'form_bypassed',
                //     'conditional_operator' => '=',
                //     'id' => 'form_bypassed',
                //     'type' => 'select',
                //     'value' => config('constants.form_bypass'),
                // ],
                // 'provisional_letter_application_recieved' => [
                //     'label' => 'Provisional Letter Application Recieved',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'provisional_letter_application_recieved',
                //     'conditional_operator' => '=',
                //     'id' => 'provisional_letter_application_recieved',
                //     'type' => 'select',
                //     'value' => config('constants.enquiry_general_options'),
                // ],
                // 'stamp_paper_filled' => [
                //     'label' => 'Stamp Paper Filled',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'stamp_paper_filled',
                //     'conditional_operator' => '=',
                //     'id' => 'stamp_paper_filled',
                //     'type' => 'select',
                //     'value' => config('constants.enquiry_general_options'),
                // ],
                // 'end_of_registrations' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'heads' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'fee_structure_types' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'payment_statuses' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                // 'voucher_statuses' => [
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => null,
                // ],
                'start_date' => [
                    'label' => 'Start Date',
                    'visibility' => true,
                    'search_through_join' => false,
                    'join_table' => null,
                    'column_name' => 'enquiry_date',
                    'id' => 'start_date',
                    'type' => 'date',
                    'conditional_operator' => '>=',
                    'value' => null,
                ],
                'end_date' => [
                    'label' => 'End Date',
                    'visibility' => true,
                    'search_through_join' => false,
                    'join_table' => null,
                    'column_name' => 'enquiry_date',
                    'conditional_operator' => '<=',
                    'id' => 'end_date',
                    'type' => 'date',
                    'value' => null,
                ],
                // 'creation_start_date' => [
                //     'label' => 'Created On (Range Start)',
                //     'visibility' => true,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'created_at',
                //     'id' => 'creation_start_date',
                //     'type' => 'date',
                //     'conditional_operator' => '>=',
                //     'value' => date('Y-m-d'),
                // ],
                // 'creation_end_date' => [
                //     'label' => 'Created On (Range End)',
                //     'visibility' => true,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'created_at',
                //     'conditional_operator' => '<=',
                //     'id' => 'creation_end_date',
                //     'type' => 'date',
                //     'value' => date('Y-m-d'),
                // ],
            ],
        ];
    }
    public function index(Request $request)
    {
        $this->enquiryRepository->pushCriteria(new RequestCriteria($request));
        $users = \App\User::get()->toArray();
        
        $this->filterConfig();
        
        return view('enquiries.index')->with('table_cols_configuration', Globals::getTableColumnsConfiguation($this->table_name))->with('model_path', $this->model_path)->with('table_name', $this->table_name)->with('filters_configuration', $this->filters_configuration)->with('users' , $users);
    }

    public function filteredReportings()
    {
        return view('reporting.enquiryModule.index');
    }

    public function getFilteredData(Request $request)
    {
        $enquiries = Enquiry::where('created_at', '>=', $request['start_date'])->where('created_at', '<=', $request['end_date'])->where('session_id', '=', $request['session_id'])->get();
        $date_start_obj = new \DateTime($request['start_date']);
        $date_end_obj = new \DateTime($request['end_date']);
        $formated_date_range = $date_start_obj->format('d-M-Y') . ' - ' . $date_end_obj->format('d-M-Y');
        $course_wise_enquiries = [];
        $user_wise_enquiries = [];
        $courses = Course::get();
        $users = User::with('roles')->get();
        $total_courses_paid_count = 0;
        $total_courses_pwwb_count = 0;
        $total_courses_enq_count = 0;
        foreach ($courses as $key => $course) {
            $course_wise_enquiry_count = $enquiries->where('course_id', '=', $course->id)->count();
            $total_courses_enq_count = $total_courses_enq_count + $course_wise_enquiry_count;

            $course_wise_enquiries_pwwb_count = $enquiries->where('course_id', '=', $course->id)->where('student_category_id', '=', '0')->count();
            $total_courses_pwwb_count = $total_courses_pwwb_count + $course_wise_enquiries_pwwb_count;

            $course_wise_enquiries_paid_count = $enquiries->where('course_id', '=', $course->id)->where('student_category_id', '=', '1')->count();
            $total_courses_paid_count = $total_courses_paid_count + $course_wise_enquiries_paid_count;

            $reporting_object = ['course_name' => $course->name, 'total_count' => $course_wise_enquiry_count, 'pwwb_count' => $course_wise_enquiries_pwwb_count, 'paid_count' => $course_wise_enquiries_paid_count];
            array_push($course_wise_enquiries, $reporting_object);
        }
        $total_emp_paid_count = 0;
        $total_emp_pwwb_count = 0;
        $total_emp_enq_count = 0;
        foreach ($users as $key => $user) {
            if ($user->departmentUsers()->get()->first() ? $user->departmentUsers()->get()->first()->department->id == 1 : false) {
                $user_wise_enquiry_count = $enquiries->where('user_id', '=', $user->id)->count();
                $total_emp_enq_count = $total_emp_enq_count + $user_wise_enquiry_count;

                $user_wise_enquiries_pwwb_count = $enquiries->where('user_id', '=', $user->id)->where('student_category_id', '=', '0')->count();
                $total_emp_pwwb_count = $total_emp_pwwb_count + $user_wise_enquiries_pwwb_count;

                $user_wise_enquiries_paid_count = $enquiries->where('user_id', '=', $user->id)->where('student_category_id', '=', '1')->count();
                $total_emp_paid_count = $total_emp_paid_count + $user_wise_enquiries_paid_count;

                $reporting_object = ['user_name' => $user->display_name, 'total_count' => $user_wise_enquiry_count, 'pwwb_count' => $user_wise_enquiries_pwwb_count, 'paid_count' => $user_wise_enquiries_paid_count];
                array_push($user_wise_enquiries, $reporting_object);
            }
        }
        return response()->json(['success' => 'true', 'message' => 'Data retrieved successfully', 'data' => ['formated_date_range' => $formated_date_range, 'user_wise_report' => $user_wise_enquiries, 'course_wise_report' => $course_wise_enquiries, 'total_courses_count' => ['total_courses_enq_count' => $total_courses_enq_count, 'total_courses_pwwb_count' => $total_courses_pwwb_count, 'total_courses_paid_count' => $total_courses_paid_count], 'total_emp_count' => ['total_emp_enq_count' => $total_emp_enq_count, 'total_emp_pwwb_count' => $total_emp_pwwb_count, 'total_emp_paid_count' => $total_emp_paid_count]]], 200);
    }

    public function create()
    {
        $countries = Country::all();
        $references = Reference::all();
        $cities = City::orderBy('name')->pluck('name', 'id');
        $affiliated_bodies = AffiliatedBody::pluck('name', 'id');
        $sessions = Session::pluck('session_name', 'id');
        $courses = Course::pluck('name', 'id');
        $users = User::with('roles')->get();
        $statuses = ConstantStrings::statuses();
        //dd($statuses);
        return view('enquiries.create')->with(['references' => $references, 'users' => $users, 'statuses' => $statuses, 'cities' => $cities, 'countries' => $countries, 'affiliated_bodies' => $affiliated_bodies, 'sessions' => $sessions, 'courses' => $courses]);
        //return view('enquiries.create');
    }

    public function getSessionCourses($id)
    {
    }

    public function moveToFollowups($id, Request $request)
    {
        $input = $request->all();
        $status_name = config('constants.followup_statuses')[$input['followup_status_id']];
        $enquiryFollowup = new EnquiryFollowup();
        $enquiryFollowup->enq_form_code = $input['enq_form_code'];
        $enquiryFollowup->enquiry_id = $id;
        $enquiryFollowup->next_date = $input['next_date'];
        $enquiryFollowup->status_id = $input['followup_status_id'];
        $enquiryFollowup->status = $status_name;
        $enquiryFollowup->remarks = $input['remarks'];
        $enquiryFollowup->user_id = Auth::id();
        $enquiryFollowup->save();
        $enquiry = Enquiry::find($id);
        $enquiry->status = ConstantStrings::statuses()[6];
        $enquiry->status_id = 6;

        $enquiry->update();
        alertify()->success('completed');
        return redirect()->back();
    }

    public function moveToAdmissions(Request $request)
    {
        $input = $request->all();
        $enquiry = Enquiry::find($input['id']);

        $admissionByEnquiryForm = new AdmissionByEnquiryForm();
        $admissionByEnquiryForm->enquiry_id = $enquiry->id;
        $admissionByEnquiryForm->save();

        $followup = EnquiryFollowup::where('enquiry_id', '=', $enquiry->id)->get()->last();
        $followup->status = config('constants.followup_statuses')[3];
        $followup->status_id = 3;
        $followup->remarks = "Action performed from enquiry module upon file completion.";
        $followup->update();

        $enquiry->status = config('constants.followup_statuses')[3];
        $enquiry->status_id = 3;
        $enquiry->remarks = "Action performed from enquiry module upon file completion. File Received.";
        $enquiry->update();

        alertify()->success('completed');
        return redirect()->back();
    }

    public function store(CreateEnquiryRequest $request)
    {

        // dd($request->all());
        try {
            // \DB::beginTransaction();
        $input = $request->all();
        //dd($input['source_info_id']);
        // $enquiries = Enquiry::withTrashed()->get()->toArray();
        $enquiries = Enquiry::select('form_code')->latest('id')->first();
        // dd($enquiries);
        if(isset($enquiries->form_code))
        {
            $enquiries = explode('-', $enquiries->form_code);
            $enquiries = intval($enquiries[1]) + 1;
        }
        else
        {
           $enquiries=1; 
        }
        $enq_form_code =    'ENQ-' . $enquiries;
        $cityName = City::select('name')->where('id', $input['city_id'])->first();
        $cityName = isset($cityName->name)?$cityName->name:null;
        $user_name = User::select('name')->where('id', $input['user_id'])->first();
        $user_name = isset($user_name->name)?$user_name->name:null;
        $entry_by_name = User::select('name')->where('id', $input['entry_by'])->first();
        $entry_by_name = isset($entry_by_name->name)?$entry_by_name->name:null;

        $project_name = Wing::select('name')->where('id', $input['project_id'])->first();
        $project_name = isset($project_name->name)?$project_name->name:null;

        $product_name = Course::select('name')->where('id', $input['product_id'])->first();
        $product_name = isset($product_name->name)?$product_name->name:null;

        $developer_name = AffiliatedBody::select('name')->where('id', $input['developer_id'])->first();
        $developer_name = isset($developer_name->name)?$developer_name->name:null;

        // dd($entry_by_name);


        //$enq_form_code = config('constants.system_codes.enquiry_form_code') . (sizeof($enquiries) + 1);
        
        $enquiry = Enquiry::create([
            'form_code' => $enq_form_code,
            'user_id' => !empty($input['user_id']) ? $input['user_id'] : 0,
            'user_name' => !empty($user_name) ? $user_name : 0,
            'entry_by' => !empty($input['entry_by']) ? $input['entry_by'] : 0,
            'entry_by_name' => !empty($entry_by_name) ? $entry_by_name : 0,
            'status' => !empty($input['followup_status_id']) ? $input['followup_status_id'] : 0,
            'follow_up_interested_level_id' => !empty($input['follow_up_interested_level_id']) ? $input['follow_up_interested_level_id'] : 0,

            'enquiry_type' => !empty($input['enquiry_type']) ? $input['enquiry_type'] : 0,
            'name_other_enquiry_type' => !empty($input['name_other_enquiry_type']) ? $input['name_other_enquiry_type'] : 0,

            'income_range' => $input['income_range'],
            'enquiry_date' => $input['enquiry_date'],
            'name' => $input['name'],
            'student_cnic_no' => $input['student_cnic_no'],
            'dob' => $input['dob'],
            'email' => $input['email'],
            'father_name' => $input['father_name'],
            'gender_id' => $input['gender_id'],
            'city_id' => $input['city_id'],
            'city_name' => $cityName,
            'present_address' => $input['present_address'],
            'permanent_address' => $input['permanent_address'],
            'phone1' => $input['phone1'],
            'phone2' => $input['phone2'],
            'landline' => $input['landline'],
            'project_id' => $input['project_id'],
            'project_name' => $project_name,
            'product_id' => $input['product_id'],
            'product_name' => $product_name,
            'developer_id' => $input['developer_id'],
            'developer_name' => $developer_name,
            'price_offer' => $input['price_offer'],
            'source_info_id' => $input['source_info_id'],
            'introduced_by' => $input['introduced_by'],
            'other_source_of_info' => $input['other_source_of_info'],
            'remarks' => $input['remarks'],
            'address' => $input['address'],

        ]);

        if ($input['source_info_id']) {
            $input['move_to_follow_up'] = "true";
        } else {
            $input['move_to_follow_up'] = "false";
        }
        // dd($input['move_to_follow_up']);
        //dd($enquiry->form_code);
        // $enquiry = new Enquiry();
        // $enquiry->form_code = $enq_form_code;
        // $enquiry->user_id = !empty($input['user_id']) ? $input['user_id'] : 0;
        // // $enquiry->user_id = !empty($input['file_received_status']) ? $input['file_received_status'] : 0;


        // $enquiry->save();
        //dd('ok');
        // $enquiry_object = $request->all();
        $status_name = isset($input['followup_status_id']) ? config('constants.followup_statuses')[$input['followup_status_id']] : '---';
        // $enquiry_object['user_name'] = !empty(User::find($enquiry_object['user_id'])) ? User::find($enquiry_object['user_id'])->display_name : '---';
        // $enquiry_object['organization_campus_id'] = SystemSession::get('organization_campus_id');
        // $enquiry2 = $this->enquiryRepository->create($enquiry_object);
        // NOTE: Store worker details
        if (isset($input['worker_details'])) {
            $enquiry_worker_details = $input['worker_details'];
            foreach ($enquiry_worker_details as $key => $detail) {
                $detail['enquiry_id'] = $enquiry->id;
                $worker = EnquiryWorker::create($detail);
            }
        }
        // NOTE: save file received status
        if (isset($input['student_category_id']) && $input['student_category_id'] == 0 && $input['followup_status_id'] == 3) {
            $enquiry->file_received_status = !empty($input['file_received_status']) ? $input['file_received_status'] : 0;
            $enquiry->file_received_number = $input['file_received_number'];
            $enquiry->file_module_number = $input['file_module_number'];
        }
        // NOTE: Store contact infos
        if (isset($input['contact_infos'])) {
            foreach ($input['contact_infos'] as $key => $contact_info) {
                $contact_info['enquiry_id'] = $enquiry->id;
                $contact_info['organization_campus_id'] = SystemSession::get('organization_campus_id');
                EnquiryContactInfo::create($contact_info);
            }
        }
        
        // TODO: Handle follow up information
        if ($input['move_to_follow_up'] == "true" || $input['followup_status_id'] == "Follow Up Required") {
            $move_to_follow_up = new EnquiryFollowup();
            $move_to_follow_up->next_date = $input['next_followup_date'];
            $move_to_follow_up->status_id = $input['followup_status_id'];
            $move_to_follow_up->organization_campus_id = SystemSession::get('organization_campus_id');
            $move_to_follow_up->session_id = SystemSession::get('selected_session_id');

            if (isset($input['follow_up_interested_level_id'])) {
                $move_to_follow_up->interest_level_id = $input['follow_up_interested_level_id'];
                $move_to_follow_up->interest_level = config('constants.follow_up_interested_levels')[$input['follow_up_interested_level_id']];
            }
            $move_to_follow_up->status = $status_name;
            $move_to_follow_up->remarks = $input['remarks'];
            $move_to_follow_up->enq_form_code = $enquiry->form_code;
            
            if(Auth::id() > 1){
               //user_id 
                $move_to_follow_up->user_id = $input['user_id'];
                $move_to_follow_up->organization_id = '7';
            }
            $move_to_follow_up->enquiry_id = $enquiry->id;
            $move_to_follow_up->save();
        }
        // NOTE: store prospect information
        if (isset($input['prospects'])) {
            $prospect_increment = 1;
            foreach ($input['prospects'] as $key => $prospect) {
                $success = $this->saveProspectEnquiry($input, $enquiry, $prospect, $prospect_increment);
                if ($success) {
                    $prospect_increment++;
                } else {
                    break;
                }

                // $move_to_follow_up = new EnquiryFollowup();
                // $move_to_follow_up->next_date = $prospect['prospect_followup_date'];
                // $move_to_follow_up->organization_campus_id = SystemSession::get('organization_campus_id');
                // $move_to_follow_up->enq_form_code = $enquiry_object['form_code'];
                // $move_to_follow_up->enquiry_id = $enquiry->id;
                // $move_to_follow_up->followup_type_id = 1;
                // $move_to_follow_up->prospect_name = $prospect['prospect_name'];
                // $move_to_follow_up->prospect_relationship = $prospect['prospect_relationship'];
                // $move_to_follow_up->prospect_course = $prospect['prospect_course'];
                // $move_to_follow_up->prospect_father_name = $prospect['prospect_father_name'];
                // $move_to_follow_up->prospect_shift_id = $prospect['prospect_shift_id'];
                // $move_to_follow_up->prospect_is_transport = $prospect['prospect_is_transport'];
                // $move_to_follow_up->prospect_contact_number = $prospect['prospect_contact_number'];
                // if (isset($prospect['prospect_transport_stop'])) {
                //     $move_to_follow_up->prospect_transport_stop = $prospect['prospect_transport_stop'];
                // }
                // $move_to_follow_up->save();
            }
        }
        // NOTE: move to admission confirmation
        if (isset($input['move_to_confirmed_admission']) && $input['move_to_confirmed_admission'] == "true") {
            $admissionByEnquiryForm = new AdmissionByEnquiryForm();
            $admissionByEnquiryForm->enquiry_id = $enquiry->id;
            $admissionByEnquiryForm->organization_campus_id = SystemSession::get('organization_campus_id');
            $admissionByEnquiryForm->save();
        }
        $enquiry->status = $status_name;
        $enquiry->entry_by = $input['entry_by'];
        $enquiry->provisional_letter_application_recieved = isset($input['provisional_letter_application_recieved']) ? $input['provisional_letter_application_recieved'] : null;
        $enquiry->stamp_paper_filled = isset($input['stamp_paper_filled']) ? $input['stamp_paper_filled'] : null;
        $enquiry->status_id = isset($input['followup_status_id']) ? $input['followup_status_id'] : null;
        
        $uploadPath=null;
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
             $image=$_FILES['image']['name']; 
             $imageArr=explode('.',$image); //first index is file name and second index file type
             $rand=rand(10000,99999);
             $newImageName=$imageArr[0].$rand.'.'.$imageArr[1];
             $uploadPath=base_path()."/public/assets/images/".$newImageName;
             $isUploaded=move_uploaded_file($_FILES["image"]["tmp_name"],$uploadPath);
             $uploadPath=$newImageName;
        }
        $enquiry->image = $uploadPath;

        $enquiry->update();
        //dd($request->all());
        // Flash::success('Enquiry saved successfully.');
        return redirect('enquiries');
        // return redirect()->route('enquiries');
        // \DB::commit();
        return response()->json(['message' => 'Enquiry created successfully.', 'enquiry_form_code' => $enquiry->form_code], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            \Log::info($e);
            if ($e->getCode() != 0) {
                if (!empty($e) && $e != '') {
                    if (in_array(1062, $e->errorInfo)) {
                        $exception_message = str_replace('', '', $e->errorInfo[2]);
                        $replaced_message = str_replace('', '', $exception_message);
                        $message = str_replace('key', '', $replaced_message);
                        return response()->json(['success' => false, 'error' => $message], 500);
                    } else {
                        return response()->json(['success' => false, 'error' => $e->errorInfo[2]], 500);
                    }
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', isset($exception_message_semi_col_split[1])?$exception_message_semi_col_split[1]:$exception_message_semi_col_split[0])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }
        }
    }
    public function saveProspectEnquiry($input, $enquiry, $prospect, $count)
    {
        $status_name = config('constants.followup_statuses')[$prospect['prospect_followup_status_id']];
        $prospect_enquiry = $enquiry->replicate();
        $prospect_enquiry->form_code = $enquiry->form_code . ' (' . $count . ')';
        $prospect_enquiry->name = $prospect['prospect_name'];
        $prospect_enquiry->father_name = $prospect['prospect_father_name'];
        $prospect_enquiry->shift_id = $prospect['prospect_shift_id'];
        $prospect_enquiry->is_transport = $prospect['prospect_is_transport'];

        if ($prospect['prospect_is_transport'] != 1) {
            $prospect_enquiry->transport_stop = $prospect['prospect_transport_stop'];
        }

        $prospect_enquiry->organization_campus_id = $prospect['prospect_campus'];
        $prospect_enquiry->course_id = $prospect['prospect_course'];
        $prospect_enquiry->affiliated_body_id = $prospect['prospect_affiliated_body_id'];
        $prospect_enquiry->academic_term_id = $prospect['prospect_academic_term_id'];
        $prospect_enquiry->parent_id = $enquiry->id;
        $prospect_enquiry->save();

        if (isset($input['worker_details'])) {
            $enquiry_worker_details = $input['worker_details'];
            foreach ($enquiry_worker_details as $key => $detail) {
                $detail['enquiry_id'] = $prospect_enquiry->id;
                $worker = EnquiryWorker::create($detail);
            }
        }

        if (isset($input['contact_infos'])) {
            $has_self_number = false;
            foreach ($input['contact_infos'] as $key => $contact_info) {
                if ($contact_info['contact_type_id'] == 5) {
                    $contact_info['phone_no'] = $prospect['prospect_contact_number'];
                    $has_self_number = true;
                }
                $contact_info['enquiry_id'] = $prospect_enquiry->id;
                $contact_info['organization_campus_id'] = $prospect['prospect_campus'];
                EnquiryContactInfo::create($contact_info);
            }
            if (!$has_self_number) {
                $contact_info['enquiry_id'] = $prospect_enquiry->id;
                $contact_info['organization_campus_id'] = $prospect['prospect_campus'];
                $contact_info['phone_no'] = $prospect['prospect_contact_number'];
                $contact_info['contact_type_id'] = 5;
                $contact_info['contact_type_name'] = config('constants.contact_types')[5];
                EnquiryContactInfo::create($contact_info);
            }
        }

        if ($prospect['prospect_followup_status_id'] == 0 || $prospect['prospect_followup_status_id'] == 1) {
            $move_to_follow_up = new EnquiryFollowup();
            $move_to_follow_up->status_id = $prospect['prospect_followup_status_id'];
            $move_to_follow_up->prospect_relationship = $prospect['prospect_relationship'];
            $move_to_follow_up->next_date = $prospect['prospect_followup_date'];
            $move_to_follow_up->organization_campus_id = $prospect['prospect_campus'];
            $move_to_follow_up->session_id = SystemSession::get('selected_session_id');
            $move_to_follow_up->prospect_father_cnic = $enquiry->father_cnic_no;
            $move_to_follow_up->status = $status_name;
            $move_to_follow_up->enq_form_code = $prospect_enquiry->form_code;
            $move_to_follow_up->enquiry_id = $prospect_enquiry->id;
            $move_to_follow_up->save();
        }

        if ($prospect['prospect_followup_status_id'] == 3) {
            $admissionByEnquiryForm = new AdmissionByEnquiryForm();
            $admissionByEnquiryForm->enquiry_id = $prospect_enquiry->id;
            $admissionByEnquiryForm->organization_campus_id = $prospect['prospect_campus'];
            $admissionByEnquiryForm->save();
        }

        $prospect_enquiry->status = $status_name;
        $prospect_enquiry->status_id = $prospect['prospect_followup_status_id'];
        $prospect_enquiry->update();

        \DB::commit();
        return true;
    }

    public function show($id)
    {
        $enquiry = $this->enquiryRepository->findWithoutFail($id);
        if (empty($enquiry)) {
            Flash::error('Enquiry not found');
            return redirect(route('enquiries.index'));
        }
        // Notify::info('Enquiry preivew is not available', $title = null, $options = []);
        return view('enquiries.show', [
            'enquiry' => $enquiry,
            'countries' => Country::all(),
            'references' => Reference::all(),
            'cities' => City::pluck('name', 'id'),
            'courses' => Course::pluck('name', 'id'),
            'users' => User::with('roles')->get(),
            'statuses' => ConstantStrings::statuses(),
        ]);
    }

    public function edit(Enquiry $enquiry)
    {
        $countries = Country::all();
        $references = Reference::all();
        $cities = City::pluck('name', 'id');
        $courses = Course::pluck('name', 'id');
        $users = User::with('roles')->get();
        $statuses = ConstantStrings::statuses();

        // return $enquiry->enquiryContactInfos;
        if (empty($enquiry)) {
            Flash::error('Enquiry not found');
            return redirect(route('enquiries.index'));
        }

        // return $enquiry;

        return view('enquiries.edit')->with([
            'enquiry' => $enquiry,
            'references' => $references,
            'users' => $users,
            'statuses' => $statuses,
            'cities' => $cities,
            'countries' => $countries,
            'courses' => $courses,
        ]);
    }

    public function update(Enquiry $enquiry, Request $request)
    {
        if (empty($enquiry)) {
            Flash::error('Enquiry not found');
            return response()->json(['success' => false, 'message' => 'no enquiry found!'], 404);
        }

        $input = $request->all();
        //dd($input);
        $cityName = City::select('name')->where('id', $input['city_id'])->first();
        $cityName = isset($cityName->name)?$cityName->name:null;
        $user_name = User::select('name')->where('id', $input['user_id'])->first();
        $user_name = $user_name->name;
        $entry_by_name = "";
        if(!empty($input['entry_by'])){
            $entry_by_name = User::select('name')->where('id', $input['entry_by'])->first();
            $entry_by_name = $entry_by_name->name;
        }
        $project_name = Wing::select('name')->where('id', $input['project_id'])->first();
        $project_name = $project_name->name;

        $product_name = Course::select('name')->where('id', $input['product_id'])->first();
        if(!empty($product_name)){
            $product_name = $product_name->name;    
        }
        

        $developer_name = AffiliatedBody::select('name')->where('id', $input['developer_id'])->first();
        if(!empty($developer_name)){
            $developer_name = $developer_name->name;
        }
        // dd($_FILES);
        $uploadPath=null;
        if(isset($_FILES['image']) && !empty($_FILES['image']['name'])){
             $image=$_FILES['image']['name']; 
             $imageArr=explode('.',$image); //first index is file name and second index file type
             $rand=rand(10000,99999);
             $newImageName=$imageArr[0].$rand.'.'.$imageArr[1];
             $uploadPath=base_path()."/public/assets/images/".$newImageName;
             $isUploaded=move_uploaded_file($_FILES["image"]["tmp_name"],$uploadPath);
             $uploadPath=$newImageName;
        }
        
        $enquiry = Enquiry::where('id', $input['id'])->update([

            'user_id' => !empty($input['user_id']) ? $input['user_id'] : 0,
            'user_name' => !empty($user_name) ? $user_name : 0,
            'entry_by' => !empty($input['entry_by']) ? $input['entry_by'] : 0,
            'entry_by_name' => !empty($entry_by_name) ? $entry_by_name : 0,
            'status' => !empty($input['followup_status_idedit']) ? $input['followup_status_idedit'] : 0,
            'follow_up_interested_level_id' => !empty($input['follow_up_interested_level_idedit']) ? $input['follow_up_interested_level_idedit'] : 0,

            'enquiry_type' => !empty($input['enquiry_type']) ? $input['enquiry_type'] : 0,
            'name_other_enquiry_type' => !empty($input['name_other_enquiry_type']) ? $input['name_other_enquiry_type'] : 0,

            'income_range' => $input['income_range'],
            'enquiry_date' => $input['enquiry_date'],
            'name' => $input['name'],
            'student_cnic_no' => $input['student_cnic_no'],
            'dob' => $input['dob'],
            'email' => $input['email'],
            'father_name' => $input['father_name'],
            'gender_id' => $input['gender_id'],
            'city_id' => $input['city_id'],
            'city_name' => $cityName,
            'present_address' => $input['present_address'],
            'permanent_address' => $input['permanent_address'],
            'phone1' => $input['phone1'],
            'phone2' => $input['phone2'],
            'landline' => $input['landline'],
            'project_id' => $input['project_id'],
            'project_name' => $project_name,
            'product_id' => $input['product_id'],
            'product_name' => $product_name,
            'developer_id' => $input['developer_id'],
            'developer_name' => $developer_name,
            'price_offer' => $input['price_offer'],
            'source_info_id' => $input['source_info_id'],
            'introduced_by' => $input['introduced_by'],
            'other_source_of_info' => $input['other_source_of_info'],
            'remarks' => $input['remarks'],
            'address' => $input['address'],
            'image' => $uploadPath
        ]);
        $status_name = isset($input['followup_status_id']) ? config('constants.followup_statuses')[$input['followup_status_id']] : '---';
        $enq_form_code = EnquiryFollowup::select('enq_form_code')->where('enquiry_id', $input['id'])->first();
        //echo '<pre>';print_r($input);die;
        $enqData = Enquiry::select('form_code')->where('id', $input['id'])->first();
        // TODO: Handle follow up information
        if (empty($enq_form_code) && ($input['followup_status_idedit'] == "true" || $input['followup_status_idedit'] == "Follow Up Required") ) {
            $move_to_follow_up = new EnquiryFollowup();
            if(isset($input['next_followup_date'])){
                $move_to_follow_up->next_date = $input['next_followup_date'];
            }
            if(isset($input['followup_status_id'])){
                $input['followup_status_id'] = $input['followup_status_id'];
            }else{
                $input['followup_status_id'] = 0;
            }
            $move_to_follow_up->status_id = $input['followup_status_id'];
            $move_to_follow_up->organization_campus_id = SystemSession::get('organization_campus_id');
            $move_to_follow_up->session_id = SystemSession::get('selected_session_id');

            if (isset($input['follow_up_interested_level_idedit'])) {
                $move_to_follow_up->interest_level_id = $input['follow_up_interested_level_idedit'];
                $move_to_follow_up->interest_level = config('constants.follow_up_interested_levels')[$input['follow_up_interested_level_idedit']];
            }
            $move_to_follow_up->status = $status_name;
            $move_to_follow_up->remarks = $input['remarks'];
            $move_to_follow_up->enq_form_code = $enqData->form_code;
            
            if(Auth::id() > 1){
               //user_id 
                $move_to_follow_up->user_id = $input['user_id'];
                $move_to_follow_up->organization_id = '7';
            }
            $move_to_follow_up->enquiry_id = $input['id'];
            $move_to_follow_up->save();
        }
        
        
        
        return redirect('enquiries');
        // return $request;
        // if enquiry is empty
        //dd($developer_name);

        // try {
        //     \DB::beginTransaction();
        //     // FORM DATA
        //     $input = $request->all();
        //     // USERNAME
        //     $enquiry['user_name'] = !empty(User::find($input['user_id'])) ? User::find($input['user_id'])->display_name : '---';
        //     // update worker details
        //     if (isset($input['worker_details'])) {
        //         $enquiry_worker_details = $input['worker_details'];
        //         //delete previous
        //         $enquiry->enquiryWorkers()->delete();
        //         // loop to save
        //         foreach ($enquiry_worker_details as $key => $detail) {
        //             if (!empty($detail)) {
        //                 $enquiry->enquiryWorkers()->create($detail);
        //             }
        //         }
        //     }
        // CONTACT INFORMATION
        // if (isset($input['contact_infos'])) {
        //     //// delete previous contacts
        //     $enquiry->enquiryContactInfos()->delete();
        //     foreach ($input['contact_infos'] as $key => $contact_info) {
        //         if (!empty($contact_info)) {
        //             $enquiry->enquiryContactInfos()->create($contact_info);
        //         }
        //     }
        // }
        // UPDATE
        // $enquiry->entry_by = $request->entry_by;
        // $enquiry->update(request()->all());
        // \DB::commit();
        // return response()->json(['message' => 'Enquiry updates successfully.'], 200);
        // } catch (\Exception $e) {
        //     \DB::rollback();
        //     \Log::info($e);
        //     if ($e->getCode() != 0) {
        //         if (!empty($e) && $e != '') {
        //             if (in_array(1062, $e->errorInfo)) {
        //                 $exception_message = str_replace('', '', $e->errorInfo[2]);
        //                 $replaced_message = str_replace('', '', $exception_message);
        //                 $message = str_replace('key', '', $replaced_message);
        //                 return response()->json(['success' => false, 'error' => $message], 500);
        //             } else {
        //                 return response()->json(['success' => false, 'error' => $e->errorInfo[2]], 500);
        //             }
        //         } else {
        //             return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
        //         }
        //     } else {
        //         $exception_message = $e->getMessage();
        //         $exception_message_semi_col_split = explode(":", $exception_message);
        //         $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
        //         return response()->json(['success' => false, 'error' => $message], 500);
        //     }
        // }
    }

    public function destroy($id)
    {
        $enquiry = $this->enquiryRepository->findWithoutFail($id);

        if (empty($enquiry)) {
            Notify::error('Enquiry not found.', 'Not Found', $options = []);
            return redirect()->route('enquiries.index');
        }

        $followups = EnquiryFollowup::where('enquiry_id', $enquiry->id)->get();
        $contacts = EnquiryContactInfo::where('enquiry_id', $enquiry->id)->get();
        $workers = EnquiryWorker::where('enquiry_id', $enquiry->id)->get();
        // if followups then delete
        if (count($followups) > 0) {
            EnquiryFollowup::where('enquiry_id', $enquiry->id)->forceDelete();
        }
        // delete contact infos
        if (count($contacts) > 0) {
            EnquiryContactInfo::where('enquiry_id', $enquiry->id)->forceDelete();
        }
        // delete worker details
        if (count($workers) > 0) {
            EnquiryWorker::where('enquiry_id', $enquiry->id)->forceDelete();
        }
        // delete from repo
        $this->enquiryRepository->delete($id);
        // redirect back
        Notify::success($enquiry->form_code . ' deleted successfully.', 'Success', $options = []);
        return redirect()->back();
    }

    public function growth()
    {
        $current_date = new \DateTime();
        $current_date = $current_date->format('Y');
        $years_array = [];
        for ($i = 0; $i < 5; $i++) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($years_array, $year);
        }
        return view('enquiries.growth')->with(['years' => $years_array]);
    }

    public function getMonthlyEnquiryData(Request $request)
    {

        $input = $request->all();
        $chart1_array = [];
        $month_count = [];
        $datasets = [];
        $labels = [''];
        $chart_x_axis = [];
        $available_years_with_months = [0];
        $select_year = $input['select_year'];
        $enquiries_dates = Enquiry::whereYear('created_at', '=', $select_year)->get()->groupBy(function ($row) {
            return $row->created_at->format('M');
        })->toArray();
        foreach ($enquiries_dates as $key => $unformatted_date) {
            array_push($labels, $key);
            array_push($available_years_with_months, count($unformatted_date));
        }

        array_push($chart_x_axis, $labels);
        array_push($datasets, ['data' => $available_years_with_months]);
        $chart1_array = ['labels' => $labels, 'datasets' => $available_years_with_months];
        return response()->json(['chart1_array' => $chart1_array]);
    }

    public function getYearlyEnquiryData(Request $request)
    {
        $input = $request->all();
        $value_to_minus = $input['value_to_minus'];
        $chart_array = [];
        $datasets = [0];
        $year_counts = [0];
        $chart_x_axis = [''];
        for ($i = $value_to_minus; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);

            $yearly_enquiry_count = Enquiry::whereYear('created_at', $year)->get()->count();
            array_push($year_counts, $yearly_enquiry_count);
        }
        array_push($datasets, ['data' => $year_counts]);
        $chart_array = ['labels' => $chart_x_axis, 'datasets' => $year_counts];

        return response()->json(['chart_array' => $chart_array]);
    }

    public function getYearlyConversionData(Request $request)
    {
        $input = $request->all();
        $conversion_array = [];
        $datasets = [];
        $conversion_counts = [];
        $chart_x_axis = [];
        $choose_year = $input['choose_year'];
        for ($i = 0; $i < 4; $i++) {
            $data = config('constants.followup_statuses')[$i];
            $enquiries = Enquiry::where('status_id', '=', $i)->whereYear('created_at', '=', $choose_year)->get()->count($data);
            array_push($chart_x_axis, $data);
            array_push($conversion_counts, $enquiries);
            array_push($datasets, ['data' => $conversion_counts]);
        }
        $conversion_array = ['labels' => $chart_x_axis, 'datasets' => $conversion_counts];
        return response()->json(['conversion_array' => $conversion_array]);
    }

    public function multiConversionRate(Request $request)
    {
        $input = $request->all();
        $chart_x_axis = [];
        $year_counts = [];
        $year_counts1 = [];
        $year_counts2 = [];
        $year_counts3 = [];
        $year_counts4 = [];
        $multi_chart = [];
        $datasets = [];
        $datasets1 = [];
        $datasets2 = [];
        $datasets3 = [];
        $datasets4 = [];
        $multi_choose_year = $input['multi_choose_year'];
        for ($i = $multi_choose_year; $i >= 0; $i--) {
            $year = date('Y', strtotime('-' . $i . 'years'));
            array_push($chart_x_axis, $year);
            $data = config('constants.followup_statuses')[0];
            $yearly_enquiry_count = Enquiry::whereYear('created_at', $year)->where('status_id', '=', 0)->get()->count($data);
            array_push($year_counts, $yearly_enquiry_count);

            array_push($datasets, ['data' => $year_counts]);
            $data1 = config('constants.followup_statuses')[1];
            $yearly_enquiry_count1 = Enquiry::whereYear('created_at', $year)->where('status_id', '=', 1)->get()->count($data1);
            array_push($year_counts1, $yearly_enquiry_count1);
            array_push($datasets1, $year_counts1);
            $data2 = config('constants.followup_statuses')[2];
            $yearly_enquiry_count2 = Enquiry::whereYear('created_at', $year)->where('status_id', '=', 2)->get()->count($data2);
            array_push($year_counts2, $yearly_enquiry_count2);
            array_push($datasets2, $year_counts2);
            $data3 = config('constants.followup_statuses')[3];
            $yearly_enquiry_count3 = Enquiry::whereYear('created_at', $year)->where('status_id', '=', 3)->get()->count($data3);
            array_push($year_counts3, $yearly_enquiry_count3);
            array_push($datasets3, $year_counts3);
        }
        $multi_chart = ['labels1' => $chart_x_axis, 'datasets' => $year_counts, 'datasets1' => $year_counts1, 'datasets2' => $year_counts2, 'datasets3' => $year_counts3, 'datasets4' => $year_counts4];

        return response()->json(['multi_chart' => $multi_chart]);
    }
    public function checkNumberDuplicacy(Request $request)
    {

        $input = $request->all();
        $has_duplication = false;
        // $has_cnic_duplication = false;
        $number_duplication_count = 0;
        $duplicacy_message = "";
        // dd($input['phone']);
        // foreach ($input['phone'] as $key => $contact) {
        // $contact_count = EnquiryContactInfo::where('contact_type_id', $contact['contact_type_id'])->where('phone_no', $contact['phone_no'])->count();
        $contact_count = EnquiryContactInfo::where('phone_no', $input['phone'])->count();
        if ($contact_count > 0) {
            $has_duplication = true;
            $number_duplication_count++;
            $duplicacy_message = $duplicacy_message . ($number_duplication_count > 1 ? ', ' : '') . $contact['contact_type_name'];
        }
        // }
        if ($has_duplication) {
            $duplicacy_message = $duplicacy_message . ($number_duplication_count > 1 ? ' numbers' : ' number') . ($number_duplication_count > 1 ? ' are' : ' is') . ' already exists in system.';
        }
        return response()->json(['duplicate' => $has_duplication, 'duplicacy_message' => $duplicacy_message]);
    }

    public function getOrganizationCampuses(Request $request)
    {
        $campuses = auth()->user()->campusDetails()->get()->pluck('organization_campus_name', 'organization_campus_id');
        return response()->json(['success' => true, 'campuses' => $campuses], 200);
    }

    public function getProduct($projectId = 0)
    {

        // Fetch Employees by Departmentid
        $productData['data']  = Course::orderby("name", "asc")
            ->select('id', 'name')
            ->where('project', $projectId)
            ->get();

        return response()->json($productData);
    }

    public function getDeveloper($productId = 0)
    {

        // Fetch Employees by Departmentid
        // $developertData['data']  = AffiliatedBody::orderby("affiliated_bodies.name", "asc")
        //     ->select('affiliated_bodies.id', 'affiliated_bodies.name')
        //     ->leftJoin('course_affiliated_bodies', 'course_affiliated_bodies.affiliated_body_id', 'affiliated_bodies.id')
        //     ->leftJoin('courses', 'courses.id', 'course_affiliated_bodies.course_id')
        //     ->where('courses.id', $productId)
        //     ->get();
        $developertData['data']  = DB::select("SELECT ab.* FROM
                    `courses` c
                    join wings w on w.id = c.project
                    join affiliated_bodies ab on ab.id = w.wing_type_id
                    WHERE c.id = ".$productId);
        return response()->json($developertData);
    }
    public function ImportEnq()
    {
        
        if(!empty($_FILES['csv-enquiries'])){
            
            $tmpName = $_FILES['csv-enquiries']['tmp_name'];
            $csvAsArray = array_map('str_getcsv', file($tmpName));
            $headers = $csvAsArray[0]; 
            
            if(count($headers)<3){
                alertify()->success('Columns does not match.');
                return redirect()->back();
                exit;
            }
            $body = array();

            foreach($csvAsArray as $key => $value){
                if($key == 0){
                    continue;
                }
                $lastId = Enquiry::orderBy('id' , 'desc')->get('id')->first()->toArray();
                
                if(!empty($lastId)){
                    $lastId = $lastId['id']+1;
                }else{
                    $lastId = 1;
                } 
                $enDate = '';
                if(strtotime($value[2])){
                    $enDate =date('Y-m-d', strtotime($value[2]));
                }else{
                    $date=date_create_from_format("d/m/Y" , $value[2]);
                    $enDate =date_format($date,"Y-m-d");
                }
                $enquiry = Enquiry::create([
                    'name' => $value[0],
                    'father_occupation' => "SHEET",
                    'phone1' => $value[1],
                    'enquiry_date' => $enDate,
                    'user_id' => Auth::id(),
                    'form_code'=>"ENQ-".$lastId,
                ]);

                
                 
            }
            alertify()->success('Imported successfully.');
            return redirect()->back();
        }
    }

    public function updateEnquiryStatus(){

        $input = request()->all();
        $enquiry = Enquiry::where('id', $input['enquiry_id'])->update([
            'status' => $input['status'],
            "remarks"=> $input['remarks'],
        ]);
        $followup = EnquiryFollowup::where('id', $input['followup_id'])->update([
            'status' => $input['status'],
            "remarks"=> $input['remarks'],
            "call_status_name"=> $input['remarks'],
        ]);
        return redirect('followups');
    }
    
}
