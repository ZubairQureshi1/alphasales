<?php

namespace App\Http\Controllers\Pwwb;

use App\Models\AcademicRecord;
use App\Models\AffiliatedBody;
use App\Models\City;
use App\Models\Course;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use App\Models\Wing;
use Illuminate\Routing\Controller;
use App\Fields\IndexTableFields;
use App\Fields\WorkerFamilyMemberDetailFields;
use App\Models\Pwwb\IndexTable;
use App\Models\Pwwb\WorkerFamilyMemberDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;
use App\Models\Pwwb\ImsDetail;
use App\Models\Pwwb\VtiDetail;
use App\Models\Pwwb\AfDetail;
use App\Models\Pwwb\BiseDetail;
use App\Models\Enquiry;

use Illuminate\Support\Arr;

class IndexTableController extends Controller
{

    public function loadMainPage(){

        if(!SystemSession::get('selected_session_id')){

            return redirect('/');

        }

        $selectedSession = SystemSession::get('selected_session_id');
        $sessionStartEndDate = SessionCourse::where('session_id', '=', $selectedSession)->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->first();
        $affiliated_bodies = AffiliatedBody::get();
        $sessionDates = ['2019-2021','2021-2023','2023-2025'];
        $districtNames = ['RahimYarKhan','Lahore','Attock','Bahawalpur'];
        $sessions = Session::get();
        $wings = Wing::get();
        $cities = City::get();
        $courseList = Course::get();
//        $sessionStartEndDate->session_start_date;
        return view('pwwb.welcome',['data' => null,'sessionDates' => $sessionDates,'districtNames' => $districtNames, 'sessions' => $sessions, 'wings' => $wings, 'selectedSession' => $selectedSession, 'affiliated_bodies' => $affiliated_bodies, 'sessionStartEndDate' => $sessionStartEndDate, 'cities' =>$cities, 'courseList' => $courseList]);
    }

    // Get Courses g...
    function getCoursesEwingSessions($wing_id, $session_id){
        $session_courses = SessionCourse::where('wing_id', '=', $wing_id)->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('session_id', '=', SystemSession::get('selected_session_id'))->get();

        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->course_id)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);


//        dd($response);
        return response()->json($response,200);
//        return response()->json(['output' => $return_arr],200);
    }

    // IMS course enrolled ID ...
    function getIMSEnrolledInfo($wing_id, $session_id, $index_id){
        $session_courses = ImsDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->ims_course_enrolled_in_cfe)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);
    }

    function getIMSRegisteredInfo($wing_id, $session_id, $index_id){
        $session_courses = ImsDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->ims_course_registered)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);   
    }

    // AF course enrolled ID ...
    function getAFEnrolledInfo($wing_id, $session_id, $index_id){
        $session_courses = AfDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->af_course_enrolled_in)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);
    }

    function getAFRegisteredInfo($wing_id, $session_id, $index_id){
        $session_courses = AfDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->af_course_registered_in)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);   
    }

      // BISE course enrolled ID ...
    function getBISEEnrolledInfo($wing_id, $session_id, $index_id){
        $session_courses = BiseDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->bise_course_enrolled_cfe)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);
    }

    function getBISERegisteredInfo($wing_id, $session_id, $index_id){
        $session_courses = BiseDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->bise_course_registered_in)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);   
    }

      // VTI course enrolled ID ...
    function getVTIEnrolledInfo($wing_id, $session_id, $index_id){
        $session_courses = VtiDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->vti_diploma_enrolled_in)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);
    }

    function getVTIRegisteredInfo($wing_id, $session_id, $index_id){
        $session_courses = VtiDetail::where('index_table_id', '=', $index_id)->get();
        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->vti_diploma_registered_in)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);
        return response()->json($response,200);   
    }


    //for dual degree...
    function getCoursesEwingSessions_dual($session_id){
        $session_courses = SessionCourse::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('session_id', '=', SystemSession::get('selected_session_id'))->get();

        $return_arr = array();
        foreach ($session_courses as $session_course){
            $courses = Course::where('id', '=', $session_course->course_id)->get();
            $return_arr[] = array( "id" => $courses[0]->id, "name" => $courses[0]->name);
        }
        $response=array('output'=>$return_arr);

        return response()->json($response,200);
//        return response()->json(['output' => $return_arr],200);
    }

    function getAcademicTerm($affiliatedbody_id, $wing_id, $course_id){
        $academicTerms = SessionCourse::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('session_id', '=', SystemSession::get('selected_session_id'))->where('wing_id','=', $wing_id)->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliatedbody_id)->get();
        return response()->json($academicTerms, 200);
    }

    function getAcademicTerm_dual($affiliatedbody_id, $course_id){
        $academicTerms = SessionCourse::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('session_id', '=', SystemSession::get('selected_session_id'))->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliatedbody_id)->get();
        return response()->json($academicTerms, 200);
    }

    function getAnnualSemesterCount($affiliatedbody_id, $wing_id, $course_id){
        $session_id = SessionCourse::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('session_id', '=', SystemSession::get('selected_session_id'))->where('wing_id','=', $wing_id)->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliatedbody_id)->first();
        $count_get = SessionCourseSubject::groupBy('annual_semester')->where('session_course_id', '=', $session_id->id)->get();
        $total_count = count($count_get);
        return response()->json($total_count, 200);
    }

    function getAnnualSemesterCount_dual($affiliatedbody_id, $course_id){
        $session_id = SessionCourse::where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('session_id', '=', SystemSession::get('selected_session_id'))->where('course_id', '=', $course_id)->where('affiliated_body_id', '=', $affiliatedbody_id)->first();
        $count_get = SessionCourseSubject::groupBy('annual_semester')->where('session_course_id', '=', $session_id->id)->get();
        $total_count = count($count_get);
        return response()->json($total_count, 200);
    }

    function getIMSAffiliatedID($affiliated_id){
        $getID = SessionCourse::where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->where('course_id', '=', $affiliated_id)->first();
//        $getID = SessionCourse::where('session_id', '=', SystemSession::get('selected_session_id'))->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->first();
        return response()->json($getID->affiliated_body_id, 200);
    }


    public function post(Request $request){
        $params = $request->all();

        $session = Arr::get($params,IndexTableFields::SESSION);
        $organization_campus_id = Arr::get($params,IndexTableFields::ORGANIZATION_CAMPUS_ID);
        $district = Arr::get($params,IndexTableFields::DISTRICT);
        $district_other = Arr::get($params,IndexTableFields::DISTRICT_OTHER);
        $fileReceivedNumber = 'R-'.str_replace('R-','',Arr::get($params,IndexTableFields::FILE_RECEIVED_NUMBER));
        $wing_selected_from_page_07 = Arr::get($params,IndexTableFields::WING_SELECTED_FROM_PAGE_07);
        $course_selected_from_page_07 = Arr::get($params,IndexTableFields::COURSE_SELECTED_FROM_PAGE_07);
        $course_registered_selected_from_page_07 = Arr::get($params,IndexTableFields::COURSE_REGISTERED_SELECTED_FROM_PAGE_07);
        $course_enrolled_selected_from_page_07_name = Arr::get($params,IndexTableFields::COURSE_ENROLLED_SELECTED_FROM_PAGE_07_NAME);
        $course_selected_from_page_07_name = Arr::get($params,IndexTableFields::COURSE_SELECTED_FROM_PAGE_07_NAME);
        $dual_course_from_page_07 = Arr::get($params,IndexTableFields::DUAL_COURSE_FROM_PAGE_07);
        $course_registered_selected_from_page_07_name = Arr::get($params,IndexTableFields::COURSE_REGISTERED_SELECTED_FROM_PAGE_07_NAME);
        $course_enrolled_selected_from_page_07 = Arr::get($params,IndexTableFields::COURSE_ENROLLED_SELECTED_FROM_PAGE_07);
        $affiliated_body_selected_from_page_07 = Arr::get($params,IndexTableFields::AFFILIATED_BODY_SELECTED_FROM_PAGE_07);
        $annual_semester_selected_from_page_07 = Arr::get($params,IndexTableFields::ANNUAL_SEMESTER_SELECTED_FROM_PAGE_07);
        $admission_set_submitted = Arr::get($params,IndexTableFields::ADMISSION_SET_SUBMITTED);
        $file_submitted_to_pwwb = Arr::get($params,IndexTableFields::FILE_SUBMITTED_TO_PWWB);
        $receivingDateExplode = explode('/',Arr::get($params,IndexTableFields::RECEIVING_DATE));
        if(count($receivingDateExplode) == 3)
            $receivingDate = Carbon::createFromDate($receivingDateExplode[2],$receivingDateExplode[1],$receivingDateExplode[0])->format('Y-m-d');
        else
            $receivingDate = Arr::get($params,IndexTableFields::RECEIVING_DATE);

        // Ali Naeem Edit .
        $submissionDateExplode = explode('/',Arr::get($params,IndexTableFields::SUBMISSION_DATE));
        if(count($submissionDateExplode) == 3)
            $submissionDate = Carbon::createFromDate($submissionDateExplode[2],$submissionDateExplode[1],$submissionDateExplode[0])->format('Y-m-d');
        else
            $submissionDate = Arr::get($params,IndexTableFields::SUBMISSION_DATE);
        // |Ali Naeem Edit ENd.
        $fileReceiptVoucherNumber = Arr::get($params,IndexTableFields::FILE_RECEIPT_VOUCHER_NUMBER);

        $fileReceiptVoucherDateExplode = explode('/',Arr::get($params,IndexTableFields::FILE_RECEIPT_VOUCHER_DATE));
        if(count($fileReceiptVoucherDateExplode) == 3)
            $fileReceiptVoucherDate = Carbon::createFromDate($fileReceiptVoucherDateExplode[2],$fileReceiptVoucherDateExplode[1],$fileReceiptVoucherDateExplode[0])->format('Y-m-d');
        else
            $fileReceiptVoucherDate = Arr::get($params,IndexTableFields::FILE_RECEIPT_VOUCHER_DATE);

        $file_module_number = 'M-'.str_replace('M-','',Arr::get($params,IndexTableFields::FILE_MODULE_NUMBER));
        $freshFileSubmissionInPwwbNumber = 'S-'.str_replace('S-','',Arr::get($params,IndexTableFields::FRESH_FILE_SUBMISSION_IN_PWWB_NUMBER));
        $priorityOfSubmission = Arr::get($params,IndexTableFields::PRIORITY_OF_SUBMISSION);
        $pwwbDiaryNumber = Arr::get($params,IndexTableFields::PWWB_DIARY_NUMBER);

        $pwwbDiaryDateExplode = explode('/',Arr::get($params,IndexTableFields::PWWB_DIARY_DATE));
        if(count($pwwbDiaryDateExplode) == 3)
            $pwwbDiaryDate = Carbon::createFromDate($pwwbDiaryDateExplode[2],$pwwbDiaryDateExplode[1],$pwwbDiaryDateExplode[0])->format('Y-m-d');
        else
            $pwwbDiaryDate = Arr::get($params,IndexTableFields::PWWB_DIARY_DATE);

        $pendingFilesWithRemarks = Arr::get($params,IndexTableFields::PENDING_FILES_WITH_REMARKS);

        //Worker Family Details
        $serialNo = Arr::get($params,WorkerFamilyMemberDetailFields::SERIAL_NO);
        $workerName = Arr::get($params,WorkerFamilyMemberDetailFields::WORKER_NAME);
        $workerCNIC = Arr::get($params,WorkerFamilyMemberDetailFields::WORKER_CNIC);
        // Ali Naeem Edit.
        $workerfollowup = Arr::get($params,WorkerFamilyMemberDetailFields::WORKER_FOLLOW_UP);
        $studentName = Arr::get($params,WorkerFamilyMemberDetailFields::STUDENT_NAME);
        $passedDegree = Arr::get($params,WorkerFamilyMemberDetailFields::PASSED_DEGREE);
        $potentialDegree = Arr::get($params,WorkerFamilyMemberDetailFields::POTENTIAL_DEGREE);
        $followUp = Arr::get($params,WorkerFamilyMemberDetailFields::FOLLOW_UP);
        $fileReceivedStatus = Arr::get($params,WorkerFamilyMemberDetailFields::FILE_RECEIVED_STATUS);


        $index_id = Arr::get($params,'index_id');

        if(!$index_id) {
            $index_table = new IndexTable();
        }
        else{
            $index_table = IndexTable::find($index_id);
        }

        $index_table->session = $session;
        $index_table->organization_campus_id = SystemSession::get('organization_campus_id');
        $index_table->district = $district;
        $index_table->district_other = $district_other;
        $index_table->wing_id = $wing_selected_from_page_07;
        $index_table->course_id = $course_selected_from_page_07;
        $index_table->course_registered_id = $course_registered_selected_from_page_07;
        $index_table->course_enrolled_id = $course_enrolled_selected_from_page_07;
        $index_table->course_name = $course_selected_from_page_07_name;
        $index_table->dual_course = $dual_course_from_page_07;
        $index_table->course_registered_name = $course_registered_selected_from_page_07_name;
        $index_table->course_enrolled_name = $course_enrolled_selected_from_page_07_name;
        $index_table->affiliated_body_id = $affiliated_body_selected_from_page_07;
        $index_table->annual_semester_id = $annual_semester_selected_from_page_07;
        $index_table->file_received_number = $fileReceivedNumber;
        $index_table->receiving_date = $receivingDate;
        $index_table->submission_date = $submissionDate;
        $index_table->file_receipt_voucher_number = $fileReceiptVoucherNumber;
        $index_table->file_receipt_voucher_date = $fileReceiptVoucherDate;
        $index_table->fresh_file_submission_in_pwwb_number = $freshFileSubmissionInPwwbNumber;
        $index_table->priority_of_submission = $priorityOfSubmission;
        $index_table->pwwb_diary_number = $pwwbDiaryNumber;
        $index_table->pwwb_diary_date = $pwwbDiaryDate;
        $index_table->pending_files_with_remarks = $pendingFilesWithRemarks;
        $index_table->file_module_number = $file_module_number;
        $index_table->admission_set_submitted = $admission_set_submitted;
        $index_table->file_submitted_to_pwwb = $file_submitted_to_pwwb;
        $index_table->save();

        if(!$index_id){
            for($i = 0 ; $i < count($serialNo); $i++){
                $workerFamilyMemberDetail = new WorkerFamilyMemberDetail();
                $this->fillWorkerFamilyDetailData($i,$workerFamilyMemberDetail,$serialNo,$index_table,$workerName,$workerCNIC,$workerfollowup,$passedDegree,$potentialDegree,$studentName,$fileReceivedStatus,$followUp);
            }
        }
        else{
            $j = 0;
            foreach(WorkerFamilyMemberDetail::where('index_table_id',$index_table->id)->get() as $workerFamilyMemberDetail){
                $workerFamilyMemberDetailSingle = WorkerFamilyMemberDetail::find($workerFamilyMemberDetail->id);
                $this->fillWorkerFamilyDetailData($j,$workerFamilyMemberDetailSingle,$serialNo,$index_table,$workerName,$workerCNIC,$workerfollowup,$passedDegree,$potentialDegree,$studentName,$fileReceivedStatus,$followUp);
                $j++;
            }
            if($j < count($serialNo)){
                for($k = $j ; $k < count($serialNo); $k++){
                    $workerFamilyMemberDetail = new WorkerFamilyMemberDetail();
                    $this->fillWorkerFamilyDetailData($k,$workerFamilyMemberDetail,$serialNo,$index_table,$workerName,$workerCNIC,$workerfollowup,$passedDegree,$potentialDegree,$studentName,$fileReceivedStatus,$followUp);
                }
            }
        }

        //$file_module_number
        // Store M- Number To Enquiry Start...
        Enquiry::where('file_received_number','=', $fileReceivedNumber)->update(['file_module_number' => $file_module_number]);
        // Store M- Number To Enquiry End...

        return response()->json([
            'indexObject' => $index_table,
        ],200);
    }

    private function fillWorkerFamilyDetailData($index,$workerObject,$serialNo,$index_table,$workerName,$workerCNIC,$workerfollowup,$passedDegree,$potentialDegree,$studentName,$fileReceivedStatus,$followUp){
        $workerObject->serial_no = isset($serialNo[$index]) ? $serialNo[$index] : null;
        $workerObject->index_table_id = $index_table->id;
        $workerObject->worker_name = isset($workerName[$index]) ? $workerName[$index] : null;
        $workerObject->worker_cnic = isset($workerCNIC[$index]) ? $workerCNIC[$index] : null;
        // ALi Naeem Edit.
        $workerObject->follow_up_status = WorkerFamilyMemberDetailFields::WORKER_FOLLOW_UP;
        $workerObject->passed_degree = isset($passedDegree[$index]) ? $passedDegree[$index] : null;
        $workerObject->potential_degree = isset($potentialDegree[$index]) ? $potentialDegree[$index] : null;
        $workerObject->student_name = isset($studentName[$index]) ? $studentName[$index] : null;
        $workerObject->file_received_status = isset($fileReceivedStatus[$index]) ? $fileReceivedStatus[$index] : null;

        $followUpValue = null;
        if(isset($followUp[$index])){
            $followUpExplode = explode('/',$followUp[$index]);
            if(count($followUpExplode) == 3)
                $followUpValue = Carbon::createFromDate($followUpExplode[2],$followUpExplode[1],$followUpExplode[0])->format('Y-m-d');
            else
                $followUpValue = $followUp[$index];
        }

        $workerObject->follow_up = $followUpValue;
        $workerObject->change = 1;
        $workerObject->save();
    }

    public function deleteWorkerDetail(Request $request){
        $params = $request->all();
        $serialNo = Arr::get($params,WorkerFamilyMemberDetailFields::SERIAL_NO);
        $indexId = Arr::get($params,'index_id');
        $object = WorkerFamilyMemberDetail::where('serial_no',$serialNo)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    //ALi Naeem Edit.
    // public function familyMemberFollowUp(){
    //     echo 'test';
    // }
}
