<?php

namespace App\Http\Controllers;

use App\Exports\Followups\FollowupsExport;
use App\Models\AdmissionByEnquiryForm;
use App\Models\Enquiry;
use App\Models\EnquiryFollowup;
use App\Models\MessageTemplates;
use App\Models\WhatsappGroups;
use App\User;
use Excel;
use Flash;
use Globals;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use Notify;
use Auth;
class FollowupController extends Controller
{
    public $table_name = 'enquiry_followups';
    public $model_path = 'App\Models\EnquiryFollowup';
    public $empty_session_title = 'Whoops!';
    public $empty_session_message = 'Please select session first to proceed.';
    public $empty_campus_message = 'Please select campus first to proceed.';
    public $filters_configuration = [];

    public function __construct()
    {
        
    }

    public function filterConfig()
    {
        $this->filters_configuration = [
            'addFilters' => true,
            'date_filter_column' => 'enquiry_date',
            'can_filters' => false,
            'clear_filters' => false,
            'has_joins' => true,
            'joins' => [
                'joins_count' => 1,
                'params' => [
                    'enquiries' => [
                        'reference_in_current' => 'enquiry_followups.enquiry_id',
                        'conditional_sign' => '=',
                        'reference_in_join' => 'enquiries.id',
                    ],
                ],
                'select' => [
                    'enquiry_followups' => [
                        'selective_columns' => false,
                        'columns' => [], // Empty array means system will fetch the data for all columns of this table
                    ],
                    'enquiries' => [
                        'selective_columns' => true,
                        'columns' => [
                            'id' => [
                                'sum' => [],
                                'count' => [],
                                'as' => 'enquiry_id',
                                'conditions' => null,
                            ],
                            'organization_campus_id' => [
                                'sum' => [],
                                'count' => [],
                                'as' => 'enquiry_organization_campus_id',
                                'conditions' => null,
                            ],
                            'name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'father_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'course_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'enquiry_type' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'user_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'session_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'affiliated_body_id' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'affiliated_body_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'total_marks' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'percentage' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'previous_degree_name' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'marks_obtained' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                            'enquiry_date' => [
                                'sum' => [],
                                'count' => [],
                                'as' => null,
                                'conditions' => null,
                            ],
                        ], // Empty array means system will fetch the data for all columns of this table
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
                // 'courses' => [
                //     'label' => 'Courses',
                //     'visibility' => false,
                //     'search_through_join' => true,
                //     'join_table' => 'enquiries',
                //     'column_name' => 'course_id',
                //     'conditional_operator' => '=',
                //     'id' => 'course_id',
                //     'type' => 'select',
                //     'value' => \App\Models\Course::orderBy('name')->get()->pluck('name', 'id')->toArray(),
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

                // 'enquiry_statuses' => [
                //     'label' => 'Enquiry Statuses',
                //     'visibility' => false,
                //     'search_through_join' => false,
                //     'join_table' => 'enquiries',
                //     'column_name' => 'status_id',
                //     'conditional_operator' => '=',
                //     'id' => 'status_id',
                //     'type' => 'select',
                //     'value' => config('constants.followup_statuses'),
                // ],
                // 'followup_statuses' => [
                //     'label' => 'Followup Status(es)',
                //     'visibility' => true,
                //     'search_through_join' => false,
                //     'join_table' => null,
                //     'column_name' => 'status_id',
                //     'conditional_operator' => '=',
                //     'id' => 'status_id',
                //     'type' => 'select',
                //     'value' => config('constants.followup_statuses'),
                // ],
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
                    'column_name' => 'next_date',
                    'id' => 'start_date',
                    'type' => 'date',
                    'conditional_operator' => '>=',
                    'value' => date('Y-m-d'),
                ],
                'end_date' => [
                    'label' => 'End Date',
                    'visibility' => true,
                    'search_through_join' => false,
                    'join_table' => null,
                    'column_name' => 'next_date',
                    'conditional_operator' => '<=',
                    'id' => 'end_date',
                    'type' => 'date',
                    'value' => date('Y-m-d'),
                ],
            ],
        ];
    }
    public function index(Request $request)
    {
        $this->filterConfig();
        $users = \App\User::get()->toArray();


         // dd($this->filters_configuration);
        return view('enquiryFollowups.index')->with('table_cols_configuration', Globals::getTableColumnsConfiguation($this->table_name))->with('model_path', $this->model_path)->with('table_name', $this->table_name)->with('filters_configuration', $this->filters_configuration)
        ->with('users' ,$users);
    }
    public function getFilteredData(Request $request)
    {
        $followups = EnquiryFollowup::where('status_id', '=', $request['followup_status_id'])->where('next_date', '>=', $request['start_date'])->where('next_date', '<=', $request['end_date'])->whereHas('enquiry', function ($query) use ($request) {
            $query->where('session_id', $request->session_id)->where('student_category_id', $request->student_category_id);
        })->orderBy('next_date')->get();

        foreach ($followups as $key => $followup) {
            $date_obj = new \DateTime($followup->next_date);
            $followups[$key]['date_formated'] = $date_obj->format(config('constants.date_formats.current_active'));
        }
        // $admission_keys = [];
        // if (count($followups) != 0) {
        //     $admission_keys = array_keys($followups->toArray()[0]);
        // // }
        \Log::info($followups);
        return response()->json(['success' => 'true', 'message' => 'Data retrieved successfully.', 'data' => $followups->toArray()]);
    }

    public function reporting()
    {

        return view('enquiryFollowups.reportings.index');
    }

    public function getReportingData(Request $request)
    {

        $start_date = $request['start_date'];
        $end_date = $request['end_date'];
        $data = [];
        $obj = null;
        $followups = null;

        $test = EnquiryFollowup::where('next_date', '>=', $request['start_date'])->where('next_date', '<=', $request['end_date'])->get();

        $admitted = $test->where('status_id', '2')->count();
        $interested = $test->where('status_id', '1')->count();
        $notInterested = $test->where('status_id', '0')->count();

        while (strtotime($start_date) <= strtotime($end_date)) {

            $followups = EnquiryFollowup::whereDate('created_at', '=', $start_date)->get();

            if ($followups != null && count($followups) != 0) {

                $obj = (object) [];
                $obj->admitted = $followups->where('status_id', '2')->count();
                $obj->interested = $followups->where('status_id', '1')->count();
                $obj->notInterested = $followups->where('status_id', '0')->count();
                $followup = $followups->last();
                $obj->date = $followup['created_at'];

                array_push($data, $obj);
            }

            $start_date = date("Y-m-d", strtotime("+1 days", strtotime($start_date)));
        }

        return response()->json(['success' => 'true', 'message' => 'Data retrieved successfully', 'data' => $data, 'admitted' => $admitted, 'interested' => $interested, 'notInterested' => $notInterested, 200]);
    }

    public function export()
    {
        return Excel::download(new FollowupsExport, 'FollowupsExport.xlsx');
    }

    public function store(Request $request)
    {
            // echo Auth::id(); die;
        try {
            \DB::beginTransaction();
            $input = $request->all();
            $enquiry = Enquiry::findOrFail($input['enquiry_id']);
            $enquiryFollowup                = new EnquiryFollowup();
            $enquiryFollowup->enquiry_id    = $input['enquiry_id'];
            $enquiryFollowup->enq_form_code = $enquiry->form_code;
            $enquiryFollowup->user_id = Auth::id();

            if ($input['status'] == 2 || $input['status'] == 3) {
                $enquiryFollowup->next_date = Date('Y-m-d');
            } else {
                $enquiryFollowup->next_date = $input['next_date'];
            }

            $enquiryFollowup->status_id     = $input['status'];
            /*if ($input['status'] == 1 || $input['status'] == 2 || $input['status'] == 3) {
            $enquiryFollowup->followup_status_group_name = 'Call Answered';
            } else {
            $enquiryFollowup->followup_status_group_name = 'Call Not Answered';
            }
             */
            // $enquiryFollowup->status = config('constants.followup_statuses')[$enquiryFollowup->followup_status_group_name][$input['status']];
            $enquiryFollowup->status = config('constants.followup_statuses')[$input['status']];
            $enquiryFollowup->organization_campus_id = SystemSession::get('organization_campus_id');
            $enquiryFollowup->session_id = SystemSession::get('selected_session_id');
            if (isset($input['interest_level_id'])) {
                $enquiryFollowup->interest_level_id = $input['interest_level_id'];
                $enquiryFollowup->interest_level = config('constants.follow_up_interested_levels')[$input['interest_level_id']];
            }

            if (isset($input['prospect_parent_id'])) {
                $enquiryFollowup->prospect_parent_id = $input['prospect_parent_id'];
            }

            $enquiryFollowup->remarks = $input['remarks'];
            $enquiryFollowup->followup_type_id = $input['followup_type_id'];
            $enquiryFollowup->called_by = $input['called_by'];
            $enquiryFollowup->call_status_id = $input['call_status'];
            $enquiryFollowup->revised_price = $input['revised_price'];
            $enquiryFollowup->call_status_name = config('constants.call_statuses')[$input['call_status']];
            // $enquiryFollowup->answered_by = $input['answered_by'];
            $enquiryFollowup->save();

            if ($input['status'] == 3 || $input['status'] == '3') {
                $admissionByEnquiryForm = new AdmissionByEnquiryForm();
                $admissionByEnquiryForm->enquiry_id = $enquiry->id;
                $admissionByEnquiryForm->organization_campus_id = SystemSession::get('organization_campus_id');
                $admissionByEnquiryForm->save();
            }

            $enquiry->status = config('constants.followup_statuses')[$input['status']];
            $enquiry->status_id = $input['status'];
            $enquiry->update();

            Notify::success('Followup added successfully!', 'Success', $options = []);
            \DB::commit();
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            $exception_message = $e->getMessage();
            $exception_message_semi_col_split = explode(":", $exception_message);
            $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
            Notify::error($message, $title = null, $options = []);
            return redirect()->back();
        }
    }

    public function destroy($id)
    {
        $followup = EnquiryFollowup::find($id);

        if (empty($followup)) {
            Flash::error('followup not found');

            return redirect(route('followups.index'));
        }

        $followup->delete();

        Flash::success('followups deleted successfully.');

        return redirect(route('followups.index'));
    }

    public function addFollowUpForm(EnquiryFollowup $followup)
    {

        $enquiry_followups = EnquiryFollowup::where('enquiry_id', $followup->enquiry_id)->orderBy('created_at', 'desc')->get();
        $enquiry = Enquiry::find($followup->enquiry_id);
        // dd($enquiry->parent_id);
        // dd($enquiry_followups); 
        $parent_enquiry;
        if (isset($enquiry->parent_id) and $enquiry->parent_id != null) {
            
            $parent_enquiry = Enquiry::find($enquiry->parent_id);
        } else {
            $parent_enquiry = $enquiry;
        }

        if($parent_enquiry->id){
        $child_enquiries = Enquiry::where('parent_id', $parent_enquiry->id)->get();
            // dd($child_enquiries);
                $parent_enquiry->childs = $child_enquiries;
        }
        // $prospect_parent_ids = EnquiryFollowup::where('enquiry_id', $followup->enquiry_id)->where('followup_type_id', 1)->where('prospect_parent_id', '!=', null)->pluck('prospect_parent_id');
        // $prospect_followups = \App\Models\EnquiryFollowup::whereIn('id', $prospect_parent_ids)->get();

        // dd($enquiry_prospects_followups);
        $templates = MessageTemplates::get()->toArray();
        $groups = WhatsappGroups::get()->toArray();
        // dd($followup->enquiry_data->toArray());
        return view('enquiryFollowups.add_to_follow_up')
            ->with('followup', $followup)
            ->with('parent_enquiry', $parent_enquiry)
            ->with('enquiry_followups', $enquiry_followups)
            ->with('templates', $templates)
            ->with('groups', $groups);
        // ->with('enquiry_prospects', $enquiry_prospects);
        // ->With('prospect_followups', $prospect_followups);
    }


    public function deleteEnquiryFollowUp(EnquiryFollowup $followup)
    {
        $followup->delete();
        if ($followup) {
            Notify::success('Followup against ' . $followup->enq_form_code ?? '---' . ' deleted successfully!', 'Success', $options = []);
        }
        return redirect()->back();
    }

    public function show(EnquiryFollowup $followup)
    {
        // dd($enquiry_prospects->toArray());
        $enquiry_followups = EnquiryFollowup::where('enquiry_id', $followup->enquiry_id)->orderBy('created_at', 'desc')->get();
        $enquiry = Enquiry::find($followup->enquiry_id);
        $parent_enquiry;
        if ($enquiry->parent_id != null) {
            $parent_enquiry = Enquiry::find($enquiry->parent_id);
        } else {
            $parent_enquiry = $enquiry;
        }

        $child_enquiries = Enquiry::where('parent_id', $parent_enquiry->id)->get();
        $parent_enquiry->childs = $child_enquiries;
        // $prospect_parent_ids = EnquiryFollowup::where('enquiry_id', $followup->enquiry_id)->where('followup_type_id', 1)->where('prospect_parent_id', '!=', null)->pluck('prospect_parent_id');
        // $prospect_followups = \App\Models\EnquiryFollowup::whereIn('id', $prospect_parent_ids)->get();

        // dd($enquiry_prospects_followups);
        return view('enquiryFollowups.view')
            ->with('followup', $followup)
            ->with('parent_enquiry', $parent_enquiry)
            ->with('enquiry_followups', $enquiry_followups);
    }


    public function assignEnquiry()
    {
        
        $request = request();
        $enqIds = explode(',' , $request['enquiry_ids']);
        
        if(!empty($enqIds) and count($enqIds)>0){
            foreach($enqIds as $enq){
                if(!empty($enq)){
                   $enqIsFollowup =  EnquiryFollowup::where('enquiry_id', '=', $enq)->first();
                        $enquiry = Enquiry::where('id', $enq)->update([
                        'user_id' => !empty($request['user_id']) ? $request['user_id'] : 0,
                        'organization_campus_id' => 7
                    ]);
                    // dd($enqIsFollowup);
                    if(!empty($enqIsFollowup)){
                        $enquiryFollow = $enqIsFollowup->toArray();
                        $enquiryFollow = EnquiryFollowup::where('id', $enqIsFollowup['id'])->update([
                        'user_id' => !empty($request['user_id']) ? $request['user_id'] : 0,
                        //'organization_campus_id' => 7
                    ]);
                    }
                }
                
            }
        }
        // redirect back
        Notify::success('Assigned successfully.', 'Success');
        return redirect()->back();
    }
}
