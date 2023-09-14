<?php

namespace App\Http\Controllers\Pwwb;

use PDF;        
use App\Exports\Followups\PwwbFowwowupExportList;
use App\Exports\Pwwbs\PwwbFilteredListExport;
use App\Exports\Pwwbs\PwwbListExport;
use App\Models\Admission;
use App\Models\AffiliatedBody;
use App\Models\City;
use App\Models\Course;
use App\Models\Enquiry;
use App\Models\EnquiryContactInfo;
use App\Models\EnquiryWorker;
use App\Models\OrganizationCampus;
use App\Models\Pwwb\AfDetail;
use App\Models\Pwwb\BiseDetail;
use App\Models\Pwwb\DocumentAttachmentDetail;
use App\Models\Pwwb\DualCourseDetail;
use App\Models\Pwwb\EducationalWingCfe;
use App\Models\Pwwb\EighthSemesterDetail;
use App\Models\Pwwb\EighthSemesterResultStatusDetail;
use App\Models\Pwwb\FactoryDeathManagerDetail;
use App\Models\Pwwb\FactoryDeathManagerDetailContact;
use App\Models\Pwwb\FactoryDetail;
use App\Models\Pwwb\FifthSemesterDetail;
use App\Models\Pwwb\FifthSemesterResultStatusDetail;
use App\Models\Pwwb\FirstAnnualDetail;
use App\Models\Pwwb\FirstAnnualResultStatusDetail;
use App\Models\Pwwb\FirstSemesterDetail;
use App\Models\Pwwb\FirstSemesterResultStatusDetail;
use App\Models\Pwwb\FourthSemesterDetail;
use App\Models\Pwwb\FourthSemesterResultStatusDetail;
use App\Models\Pwwb\ImsDetail;
use App\Models\Pwwb\IndexTable;
use App\Models\Pwwb\ProvisionalClaim;
use App\Models\Pwwb\ProvisionalClaimDetail;
use App\Models\Pwwb\SecondAnnualPartDetail;
use App\Models\Pwwb\SecondAnnualPartResultStatusDetail;
use App\Models\Pwwb\SecondSemesterDetail;
use App\Models\Pwwb\SecondSemesterResultStatusDetail;
use App\Models\Pwwb\ServiceDetail;
use App\Models\Pwwb\SeventhSemesterDetail;
use App\Models\Pwwb\SeventhSemesterResultStatusDetail;
use App\Models\Pwwb\SixthSemesterDetail;
use App\Models\Pwwb\SixthSemesterResultStatusDetail;
use App\Models\Pwwb\StudentContactNumber;
use App\Models\Pwwb\StudentPersonalDetail;
use App\Models\Pwwb\ThirdSemesterDetail;
use App\Models\Pwwb\ThirdSemesterResultStatusDetail;
use App\Models\Pwwb\VtiDetail;
use App\Models\Pwwb\WorkerBankSecurityDetail;
use App\Models\Pwwb\WorkerContactNumber;
use App\Models\Pwwb\WorkerFamilyMemberDetail;
use App\Models\Pwwb\WorkerFollowupsCalls;
use App\Models\Pwwb\WorkerPersonalDetail;
use App\Models\Session;
use App\Models\SessionCourse;
use App\Models\Student;
use App\Models\Wing;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Session as SystemSession;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\Pwwb\Claim;

// Important

//use App\transportHotelDetail;

class PwwbHomeController extends Controller
{

    public $exportArray;

    private $x;

    public function __construct()
    {
        // Fetch the Site Settings object
        // $this->exportArray = new Globals;
    }

    public function index()
    {
        if (!SystemSession::get('selected_session_id')) {
            return redirect('/');

        }
//        dd(IndexTable::find(99)->self_contact);
        // return $mainTable = IndexTable::with('TransportHostelDetail')->get();
        $mainTable = IndexTable::get();
        $courses = Course::get();
        $affiliatedBodies = AffiliatedBody::get();
        $wings = Wing::get();
        return view('pwwb.home', ['data' => null, 'mainTable' => $mainTable, 'courses' => $courses, 'wings' => $wings, 'affiliatedBodies' => $affiliatedBodies]);
    }

//    public function index(){
    //        if(!SystemSession::get('selected_session_id')){
    //            return redirect('/');
    //
    //        }
    //        $mainTable = IndexTable::all();
    //        return view('pwwb.home',['mainTable' => $mainTable]);
    //    }

    public function exportExcelSheet($mailTable)
    {

        $dataAll = $mailTable;
        $excelQuery = array();
        foreach ($mailTable as $val) {

            $excelQuery[] = $val->id;

            // $excelQuery[] = IndexTable::
            // select(
            //     'index_tables.id', 'index_tables.district', 'index_tables.district_other', 'index_tables.priority_of_submission', 'index_tables.file_received_number',
            //     'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.receiving_date', 'index_tables.submission_date',
            //     'index_tables.file_receipt_voucher_number','index_tables.file_receipt_voucher_date','index_tables.pwwb_diary_number','index_tables.pwwb_diary_date',
            //     'index_tables.pending_files_with_remarks','index_tables.admitted',
            //     'index_tables.wing_id','index_tables.course_id', 'index_tables.course_id', 'index_tables.course_id',
            //     'index_tables.affiliated_body_id','index_tables.annual_semester_id',
            //     'index_tables.annual_semesteR_id',
            //     'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',

            //     'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic',
            //     'worker_personal_details.photograph_uploaded', 'worker_personal_details.photograph_attested',
            //     'worker_personal_details.photograph_quantity', 'worker_personal_details.applicant_name',
            //     'worker_personal_details.worker_cnic_attested', 'worker_personal_details.worker_current_status',
            //     'worker_personal_details.worker_job_nature', 'worker_personal_details.factory_status',
            //     'worker_personal_details.worker_relationship', 'worker_personal_details.specify_relationship',
            //     'worker_personal_details.date_of_birth', 'worker_personal_details.pwwb_scholarship_form',
            //     'worker_personal_details.factory_card', 'worker_personal_details.service_letter',

            //     'factory_details.factory_name', 'factory_details.factory_address',
            //     'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            //     'factory_details.factory_registration_certificate_attested_by_manager', 'factory_details.factory_registration_certificate_attested_by_officer',
            //     'factory_details.factory_registration_certificate_attested_by_director', 'factory_details.signature_of_worker',
            //     'factory_details.date_of_submission',

            //     'student_personal_details.name', 'student_personal_details.cnic_no',
            //     'student_personal_details.father_name', 'student_personal_details.quantity',
            //     'student_personal_details.student_cnic_attested', 'student_personal_details.date_of_birth',
            //     'student_personal_details.present_address', 'student_personal_details.marital_status',
            //     'student_personal_details.postal_address', 'student_personal_details.email',
            //     'student_personal_details.signature',

            //     'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name',
            //     'transport_hostel_details.hostel_facility', 'transport_hostel_details.transport_facility',
            //     'transport_hostel_details.address', 'transport_hostel_details.manager_name',
            //     'transport_hostel_details.manager_contact',

            //     'provisional_claims.claim_status', 'provisional_claims.serial_no',
            //     'provisional_claims.claim_due', 'provisional_claims.type_of_claim',
            //     'provisional_claims.type_of_claim_other', 'provisional_claims.claim_received',
            //     'provisional_claims.claim_date', 'provisional_claims.reason',
            //     'provisional_claims.cfe_fee', 'provisional_claims.recovery_from_student',

            //     'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            //     'first_semester_result_status_details.fail AS seme1_fail', 'first_semester_result_status_details.next_appearance AS seme1_next_appearance',
            //     'first_semester_result_status_details.next_appearance_date AS sem1_next_appearance_date', 'first_semester_result_status_details.last_chance_date AS seme1_last_chance_date',
            //     'first_semester_result_status_details.passing_date AS seme1_passing_date',

            //     'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            //     'second_semester_result_status_details.fail AS seme2_fail', 'second_semester_result_status_details.next_appearance AS seme2_next_appearance',
            //     'second_semester_result_status_details.next_appearance_date AS seme2_next_appearance_date', 'second_semester_result_status_details.last_chance_date AS seme2_last_chance_date',
            //     'second_semester_result_status_details.passing_date AS seme2_passing_date',

            //     'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            //     'third_semester_result_status_details.fail AS seme3_fail', 'third_semester_result_status_details.next_appearance AS seme3_next_appearance',
            //     'third_semester_result_status_details.next_appearance_date AS seme3_next_appearance_date', 'third_semester_result_status_details.last_chance_date AS seme3_last_chance_date',
            //     'third_semester_result_status_details.passing_date AS seme3_passing_date',

            //     'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            //     'fourth_semester_result_status_details.fail AS seme4_fail', 'fourth_semester_result_status_details.next_appearance AS seme4_next_appearance',
            //     'fourth_semester_result_status_details.next_appearance_date AS seme4_next_appearance_date', 'fourth_semester_result_status_details.last_chance_date AS seme4_last_chance_date',
            //     'fourth_semester_result_status_details.passing_date AS seme4_passing_date',

            //     'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            //     'fifth_semester_result_status_details.fail AS seme5_fail', 'fifth_semester_result_status_details.next_appearance AS seme5_next_appearance',
            //     'fifth_semester_result_status_details.next_appearance_date AS seme5_next_appearance_date', 'fifth_semester_result_status_details.last_chance_date AS seme5_last_chance_date',
            //     'fifth_semester_result_status_details.passing_date AS seme5_passing_date',

            //     'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            //     'sixth_semester_result_status_details.fail AS seme6_fail', 'sixth_semester_result_status_details.next_appearance AS seme6_next_appearance',
            //     'sixth_semester_result_status_details.next_appearance_date AS seme6_next_appearance_date', 'sixth_semester_result_status_details.last_chance_date AS seme6_last_chance_date',
            //     'sixth_semester_result_status_details.passing_date AS seme6_passing_date',

            //     'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            //     'seventh_semester_result_status_details.fail AS seme7_fail', 'seventh_semester_result_status_details.next_appearance AS seme7_next_appearance',
            //     'seventh_semester_result_status_details.next_appearance_date AS seme7_next_appearance_date', 'seventh_semester_result_status_details.last_chance_date AS seme7_last_chance_date',
            //     'seventh_semester_result_status_details.passing_date AS seme7_passing_date',

            //     'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            //     'eighth_semester_result_status_details.fail AS seme8_fail', 'eighth_semester_result_status_details.next_appearance AS seme8_next_appearance',
            //     'eighth_semester_result_status_details.next_appearance_date AS seme8_next_appearance_date', 'eighth_semester_result_status_details.last_chance_date AS seme8_last_chance_date',
            //     'eighth_semester_result_status_details.passing_date AS seme8_passing_date'
            // )
            //     ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            //     ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            //     ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            //     ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            //     ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            //     ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            //     ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            //     ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            //     ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            //     ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            //     ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            //     ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            //     ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            //     ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            //     ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            //     ->orderByRaw('length(file_received_number)','ASC')->orderBy('file_received_number', 'ASC');

        }
//        }

//            dd(count($excelQuery), count($mailTable));

        // dd($excelQuery);
        // return $excelQuery;

        // return Excel::download(new PwwbListExport($excelQuery), 'Pwwb_List.xlsx');

        // $globalResult =  Globals::SayHello($excelQuery);
        // $glob = new Globals();
        $this->x = '22';

        return $this->exportArray = $excelQuery;
        // return $this->exportArray->pwwbExportList = $excelQuery;

        // return $globalResult;
        // return $this->export($excelQuery);

    }

    public function recordsExportCSVFilter(request $request)
    {

        // $search_ = '';
        $districtSearchFilter = '';
        $priorityofsubmission = '';
        $wingSearchFilter = '';
        $courseSearchFilter = '';
        $courseEnrollerdInSearchFilter = '';
        $courseRegisteredInSearchFilter = '';
        $courseaffiliatedbody = '';
        $pwwbtransportfacility = '';
        $pwwbhostelfacility = '';
        $provisionalclaimstatus = '';
        $pwwbacademicterm = '';
        $semesterOne = '';
        $annualCheck = '';
        // Dates...
        $dataEntryDateEnd = '';
        $dataEntryDateStart = '';
        // Date 2..
        $submissionDateStart = '';
        $submissionDateEnd = '';
        $resultSearchFilter = '';

        $districtSearchFilter = $request['districtSearchFilter'];
        $priorityofsubmission = $request->priorityofsubmission;
        $wingSearchFilter = $request->wingSearchFilter;
        $courseSearchFilter = $request->courseSearchFilter;
        $courseEnrollerdInSearchFilter = $request->courseEnrollerdInSearchFilter;
        $courseRegisteredInSearchFilter = $request->courseRegisteredInSearchFilter;
        $courseaffiliatedbody = $request->courseaffiliatedbody;
        $pwwbtransportfacility = $request->pwwbtransportfacility;
        $pwwbhostelfacility = $request->pwwbhostelfacility;
        $provisionalclaimstatus = $request->provisionalclaimstatus;
        $pwwbacademicterm = $request->pwwbacademicterm;
        $semesterOne = $request->semesterOne;
        $annualCheck = $request->annualCheck;
        // Dates...
        $dataEntryDateEnd = $request->dataEntryDateEnd;
        $dataEntryDateStart = $request->dataEntryDateStart;
        // Date 2..
        $submissionDateStart = $request->submissionDateStart;
        $submissionDateEnd = $request->submissionDateEnd;
        $resultSearchFilter = $request->resultSearchFilter;
        // $search_ = $request->serachDataResult;

        if ($districtSearchFilter == 'nulled_sent') {
            $districtSearchFilter = '';
        }
        if ($priorityofsubmission == 'nulled_sent') {
            $priorityofsubmission = '';
        }
        if ($wingSearchFilter == 'nulled_sent') {
            $wingSearchFilter = '';
        }
        if ($courseSearchFilter == 'nulled_sent') {
            $courseSearchFilter = '';
        }
        if ($courseEnrollerdInSearchFilter == 'nulled_sent') {
            $courseEnrollerdInSearchFilter = '';
        }
        if ($courseRegisteredInSearchFilter == 'nulled_sent') {
            $courseRegisteredInSearchFilter = '';
        }
        if ($courseaffiliatedbody == 'nulled_sent') {
            $courseaffiliatedbody = '';
        }
        if ($pwwbtransportfacility == 'nulled_sent') {
            $pwwbtransportfacility = '';
        }
        if ($pwwbhostelfacility == 'nulled_sent') {
            $pwwbhostelfacility = '';
        }
        if ($provisionalclaimstatus == 'nulled_sent') {
            $provisionalclaimstatus = '';
        }
        if ($pwwbacademicterm == 'nulled_sent') {
            $pwwbacademicterm = '';
        }
        if ($semesterOne == 'nulled_sent') {
            $semesterOne = '';
        }
        if ($annualCheck == 'nulled_sent') {
            $annualCheck = '';
        }
        if ($dataEntryDateEnd == 'nulled_sent') {
            $dataEntryDateEnd = '';
        }
        if ($dataEntryDateStart == 'nulled_sent') {
            $dataEntryDateStart = '';
        }
        if ($submissionDateStart == 'nulled_sent') {
            $submissionDateStart = '';
        }
        if ($submissionDateEnd == 'nulled_sent') {
            $submissionDateEnd = '';
        }
        if ($resultSearchFilter == 'nulled_sent') {
            $resultSearchFilter = '';
        }

        if (!empty($dataEntryDateStart)) {
            $startTime = new Carbon($dataEntryDateStart);
            $dataEntryDateStart = $startTime->format('Y-m-d');
        }

        if (!empty($dataEntryDateEnd)) {
            $startTime = new Carbon($dataEntryDateEnd);
            $dataEntryDateEnd = $startTime->format('Y-m-d');
        }

        if (!empty($submissionDateStart)) {
            $startTime = new Carbon($submissionDateStart);
            $submissionDateStart = $startTime->format('Y-m-d');
        }

        if (!empty($submissionDateEnd)) {
            $startTime = new Carbon($submissionDateEnd);
            $submissionDateEnd = $startTime->format('Y-m-d');
        }
        // array Conversio

        $districtSearchFilter = preg_split("/[,]/", $districtSearchFilter);
        $priorityofsubmission = preg_split("/[,]/", $priorityofsubmission);
        $wingSearchFilter = preg_split("/[,]/", $wingSearchFilter);
        $courseSearchFilter = preg_split("/[,]/", $courseSearchFilter);
        $courseEnrollerdInSearchFilter = preg_split("/[,]/", $courseEnrollerdInSearchFilter);
        $courseRegisteredInSearchFilter = preg_split("/[,]/", $courseRegisteredInSearchFilter);
        $courseaffiliatedbody = preg_split("/[,]/", $courseaffiliatedbody);
        $pwwbtransportfacility = preg_split("/[,]/", $pwwbtransportfacility);

        $pwwbhostelfacility = preg_split("/[,]/", $pwwbhostelfacility);
        $provisionalclaimstatus = preg_split("/[,]/", $provisionalclaimstatus);
        $pwwbacademicterm = preg_split("/[,]/", $pwwbacademicterm);
        $semesterOne = preg_split("/[,]/", $semesterOne);
        $annualCheck = preg_split("/[,]/", $annualCheck);

        $dataEntryDateEnd = preg_split("/[,]/", $dataEntryDateEnd);
        $dataEntryDateStart = preg_split("/[,]/", $dataEntryDateStart);
        $submissionDateStart = preg_split("/[,]/", $submissionDateStart);

        $submissionDateEnd = preg_split("/[,]/", $submissionDateEnd);
        $resultSearchFilter = preg_split("/[,]/", $resultSearchFilter);

        $search_ = '';
        if ($request['serachDataResult'] != 'nulled_sent') {

            $search_ = $request['serachDataResult'];
        }

        $mainTable = IndexTable::
            select('index_tables.id', 'index_tables.district', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.file_module_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'index_tables.receiving_date', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'factory_details.factory_name', 'student_personal_details.name',
            'student_personal_details.cnic_no', 'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name', 'index_tables.wing_id',
            'index_tables.course_id', 'index_tables.course_id', 'index_tables.course_id', 'index_tables.affiliated_body_id', 'index_tables.annual_semester_id', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.hostel_facility', 'provisional_claims.claim_status', 'index_tables.annual_semesteR_id',
//            'student_contact_numbers.student_contact_relationship', 'student_contact_numbers.contact_no',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',
            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result',
            'wings.short_name As wings_short_name',
            'affiliated_bodies.code AS affiliated_bodies_code'
            // 'wings.id AS wings_id', 'wings.name AS wings_name', 'wings.short_name As wings_short_name',
            // 'affiliated_bodies.id AS affiliated_bodies_id', 'affiliated_bodies.name AS affiliated_bodies_name', 'affiliated_bodies.code AS affiliated_bodies_code',
        )
        // ->orwhere('roll_no', 'like', '%' . $search_ . '%')
            ->orwhere('hostel_name', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('factory_name', 'like', '%' . $search_ . '%')
            ->orwhere('student_personal_details.name', 'like', '%' . $search_ . '%')
            ->orwhere('cnic_no', 'like', '%' . $search_ . '%')
            ->orwhere('bus_stop', 'like', '%' . $search_ . '%')
//            ->whereBetween('receiving_date', [$dataEntryDateStart, $dataEntryDateEnd])
            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            ->leftjoin('wings', 'index_tables.wing_id', '=', 'wings.id')
            ->leftjoin('affiliated_bodies', 'index_tables.affiliated_body_id', '=', 'affiliated_bodies.id')
//            ->leftjoin('student_contact_numbers', 'index_tables.id', '=', 'student_contact_numbers.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();
        // ->offset($request['start'])->limit($request['length'])

        $mainTableCount = IndexTable::
            select('index_tables.id', 'index_tables.district', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.file_module_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'index_tables.receiving_date', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'factory_details.factory_name', 'student_personal_details.name',
            'student_personal_details.cnic_no', 'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name', 'index_tables.wing_id',
            'index_tables.course_id', 'index_tables.affiliated_body_id', 'index_tables.annual_semester_id', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.hostel_facility', 'provisional_claims.claim_status',
//            'student_contact_numbers.student_contact_relationship', 'student_contact_numbers.contact_no',

            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result',
            'wings.short_name As wings_short_name',
            'affiliated_bodies.code AS affiliated_bodies_code'
            // 'wings.id AS wings_id', 'wings.name AS wings_name', 'wings.short_name As wings_short_name',
            // 'affiliated_bodies.id AS affiliated_bodies_id', 'affiliated_bodies.name AS affiliated_bodies_name', 'affiliated_bodies.code AS affiliated_bodies_code',
        )
        // ->orwhere('roll_no', 'like', '%' . $search_ . '%')
            ->orwhere('hostel_name', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('factory_name', 'like', '%' . $search_ . '%')
            ->orwhere('student_personal_details.name', 'like', '%' . $search_ . '%')
            ->orwhere('cnic_no', 'like', '%' . $search_ . '%')
            ->orwhere('bus_stop', 'like', '%' . $search_ . '%')
//            ->whereBetween('receiving_date', [$dataEntryDateStart, $dataEntryDateEnd])
            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            ->leftjoin('wings', 'index_tables.wing_id', '=', 'wings.id')
            ->leftjoin('affiliated_bodies', 'index_tables.affiliated_body_id', '=', 'affiliated_bodies.id')
//            ->leftjoin('student_contact_numbers', 'index_tables.id', '=', 'student_contact_numbers.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();

        // dd(IndexTable::find(99)->self_contact);

        // // // From Laravel 5.4 you can pass the same condition value as a parameter
        // // ->when(request('serachDataResult', true), function ($q, $role) {
        // //     return $q->where('file_received_number', 'like', '%' . request('serachDataResult') . '%');
        // // })

        // ->when($search_ != 'a', function ($q) {
        //     return $q->where('file_received_number', 'like', '%' . $search_ . '%');

        // })->get();

        // dd($mainTableCount);

        // if(!empty($districtSearchFilter)){

        //     $mynewarray_3__count = $mainTableCount;
        //     $mainTableCount = array();

        //     foreach ($mynewarray_3__count as $val) {
        //         foreach ($districtSearchFilter as $dFilter) {

        //             if($val->district == $dFilter ){
        //                 $mainTableCount[] = $val;

        //             }
        //         }
        //     }
        // }

        if (count($mainTableCount) > 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                $mainTableCount[] = $val;
            }
        }

        // Self Contact ...
        foreach ($mainTableCount as $key => &$val) {

            $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->first();
            if ($selfContact != null || $selfContact != '') {
                $val['self_coontact'] = $selfContact->contact_no;
            } else {
                $val['self_coontact'] = '---';
            }
        }

        // Self Contact 2
        foreach ($mainTableCount as $key => &$val) {

            $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->where('contact_no', '<>', $val['self_coontact'])->first();
            if ($selfContact != null || $selfContact != '') {
                $val['self_coontact_2'] = $selfContact->contact_no;
            } else {
                $val['self_coontact_2'] = '---';
            }
        }

        // Self Contact 3
        foreach ($mainTableCount as $key => &$val) {

            $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->where('contact_no', '<>', $val['self_coontact'])->where('contact_no', '<>', $val['self_coontact_2'])->first();
            if ($selfContact != null || $selfContact != '') {
                $val['self_coontact_3'] = $selfContact->contact_no;
            } else {
                $val['self_coontact_3'] = '---';
            }
        }
        // father Contact.
        foreach ($mainTableCount as $key => &$val) {

            $fatherContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'father')->first();
            if ($fatherContact != null || $fatherContact != '') {
                $val['father_coontact'] = $fatherContact->contact_no;
            } else {
                $val['father_coontact'] = '---';
            }
        }

        //Course Applied
        foreach ($mainTableCount as $key => &$val) {
            if ($val['wing_id'] == '1') {
                $afDetail = AfDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'af_details.af_course_applied_in', '=', 'courses.id')->first();
                if ($afDetail != null || $afDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $afDetail->af_course_applied_in)->first();
                    $courseEnrolledName = Course::where('id', '=', $afDetail->af_course_enrolled_in)->first();
                    $courseRegisteredName = Course::where('id', '=', $afDetail->af_course_registered_in)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }
                    // $val['course_applied'] = $courseAppliedName->name;
                    // $val['course_enrolled'] = $courseEnrolledName->name;
                    // $val['course_registered'] = $courseRegisteredName->name;
                } else {
                    $val['course_applied'] = '---';
                    $val['course_enrolled'] = '---';
                    $val['course_registered'] = '---';
                }
            } elseif ($val['wing_id'] == '2') {
                $biseDetail = BiseDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'bise_details.bise_course_applied_in', '=', 'courses.id')->first();
                if ($biseDetail != null || $biseDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $biseDetail->bise_course_applied_in)->first();
                    $courseEnrolledName = Course::where('id', '=', $biseDetail->bise_course_enrolled_cfe)->first();
                    $courseRegisteredName = Course::where('id', '=', $biseDetail->bise_course_registered_in)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }
                    // $val['course_applied'] = $courseAppliedName->name;
                    // $val['course_enrolled'] = $courseEnrolledName->name;
                    // $val['course_registered'] = $courseRegisteredName->name;

                } else {
                    $val['course_applied'] = '---';
                    $val['course_enrolled'] = '---';
                    $val['course_registered'] = '---';
                }
            } elseif ($val['wing_id'] == '3') {
                $ImsDetail = ImsDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'ims_details.ims_course_applied_in_cfe', '=', 'courses.id')->first();
                if ($ImsDetail != null || $ImsDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $ImsDetail->ims_course_applied_in_cfe)->first();
                    $courseEnrolledName = Course::where('id', '=', $ImsDetail->ims_course_enrolled_in_cfe)->first();
                    $courseRegisteredName = Course::where('id', '=', $ImsDetail->ims_course_registered)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }
                    // $val['course_applied'] = $courseAppliedName->name;
                    // $val['course_enrolled'] = $courseEnrolledName->name;
                    // $val['course_registered'] = $courseRegisteredName->name;
                } else {
                    $val['course_applied'] = '---';
                    $val['course_enrolled'] = '---';
                    $val['course_registered'] = '---';
                }
            } elseif ($val['wing_id'] == '4') {
                $VtiDetail = VtiDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'vti_details.vti_diploma_applied_in', '=', 'courses.id')->first();
                if ($VtiDetail != null || $VtiDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $VtiDetail->vti_diploma_applied_in)->first();
                    $courseEnrolledName = Course::where('id', '=', $VtiDetail->vti_diploma_enrolled_in)->first();
                    $courseRegisteredName = Course::where('id', '=', $VtiDetail->vti_diploma_registered_in)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }
                    // $val['course_applied'] = $courseAppliedName->name;
                    // $val['course_enrolled'] = $courseAppliedName->name;
                    // $val['course_registered'] = $courseAppliedName->name;
                } else {
                    $val['course_applied'] = '---';
                    $val['course_enrolled'] = '---';
                    $val['course_registered'] = '---';
                }
            } else {
                $val['course_applied'] = '---';
                $val['course_enrolled'] = '---';
                $val['course_registered'] = '---';
            }
        }
        // Roll number...
        foreach ($mainTableCount as $key => &$val) {

            $rollNumber = Admission::where('pwwb_file_id', $val['id'])->first();
            if ($rollNumber != null || $rollNumber != '') {
                $val['roll_no'] = Student::where('admission_id', $rollNumber->id)->first()->roll_no;
            } else {
                $val['roll_no'] = '---';
            }
        }

        // dd($mainTableCount);
        if (count($districtSearchFilter) > 0 && !$districtSearchFilter[0] == "") {

            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($districtSearchFilter) > 0 && !$districtSearchFilter[0] == "") {

                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($districtSearchFilter)) {
            $mynewarray_3__ = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($districtSearchFilter)) {
                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($priorityofsubmission) > 0 && !$priorityofsubmission[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($priorityofsubmission) > 0 && !$priorityofsubmission[0] == "") {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($priorityofsubmission)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($priorityofsubmission)) {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($wingSearchFilter) > 0 && !$wingSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($wingSearchFilter) > 0 && !$wingSearchFilter[0] == "") {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($wingSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($wingSearchFilter)) {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {
                            $mainTable[] = $val;

                        }
                    }
                }
            }
        }

        if (count($courseSearchFilter) > 0 && !$courseSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseSearchFilter) > 0 && !$courseSearchFilter[0] == "") {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseSearchFilter)) {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($courseEnrollerdInSearchFilter) > 0 && !$courseEnrollerdInSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseEnrollerdInSearchFilter) > 0 && !$courseEnrollerdInSearchFilter[0] == "") {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseEnrollerdInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseEnrollerdInSearchFilter)) {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($courseRegisteredInSearchFilter) > 0 && !$courseRegisteredInSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseRegisteredInSearchFilter) > 0 && !$courseRegisteredInSearchFilter[0] == "") {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseRegisteredInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseRegisteredInSearchFilter)) {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($courseaffiliatedbody) > 0 && !$courseaffiliatedbody[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseaffiliatedbody) > 0 && !$courseaffiliatedbody[0] == "") {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseaffiliatedbody)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseaffiliatedbody)) {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        //   if(count($pwwbacademicterm) > 0 && !$pwwbacademicterm[0] == ""){
        //     $mynewarray_3__count = $mainTableCount;
        //     $mainTableCount = array();
        //     foreach ($mynewarray_3__count as $val){
        //         if(count($pwwbacademicterm) > 0 && ! $pwwbacademicterm[0] == ""){
        //             foreach ($pwwbacademicterm as $checkList){
        //                 if($val->annual_semester_id == $checkList){
        //                      if($val->annual_semester_id == $pwwbacademicterm){
        //                         $mainTableCount[] = $val;
        //                     }
        //                     elseif ($pwwbacademicterm == '2')
        //                     {
        //                         if($val->annual_semester_id == 0){
        //                             $mainTableCount[] = $val;
        //                         }
        //                     }
        //                 }
        //            }
        //         }
        //     }
        // }
        // dd($pwwbacademicterm[0]);
        if ($pwwbacademicterm[0] == "0") {
            $pwwbacademicterm[0] = "12";
        }
        if (count($pwwbacademicterm) > 0 && $pwwbacademicterm[0] != 'null') {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            $i = 0;
            foreach ($mynewarray_3__count as $val) {

                if ($val->annual_semester_id == "0" && $pwwbacademicterm[0] == "12") {
                    $mainTableCount[] = $val;

                } elseif ($pwwbacademicterm[0] == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTableCount[] = $val;
                    }
                }
            }
        }

        // dd($mainTableCount);
        // if (!isset($pwwbacademicterm)) {

        //     // if(count($pwwbacademicterm) > 0 && !$pwwbacademicterm[0] == ""){
        //     $mynewarray_3__count = $mainTableCount;
        //     $mainTableCount = array();

        //     foreach ($mynewarray_3__count as $val) {
        //         if ($val->annual_semester_id == $pwwbacademicterm) {
        //             $mainTableCount[] = $val;
        //         } elseif ($pwwbacademicterm == '2') {
        //             if ($val->annual_semester_id == 0) {
        //                 $mainTableCount[] = $val;
        //             }
        //         }
        //     }
        // }

        if (!isset($pwwbacademicterm)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if ($val->annual_semester_id == $pwwbacademicterm) {
                    $mainTable[] = $val;
                } elseif ($pwwbacademicterm == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTable[] = $val;
                    }
                }
            }
        }

        if (count($pwwbhostelfacility) > 0 && !$pwwbhostelfacility[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($pwwbhostelfacility) > 0 && !$pwwbhostelfacility[0] == "") {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($pwwbhostelfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbhostelfacility)) {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($provisionalclaimstatus) > 0 && !$provisionalclaimstatus[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($provisionalclaimstatus) > 0 && !$provisionalclaimstatus[0] == "") {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!isset($provisionalclaimstatus)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($provisionalclaimstatus)) {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($pwwbtransportfacility) > 0 && !$pwwbtransportfacility[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($pwwbtransportfacility) > 0 && !$pwwbtransportfacility[0] == "") {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($pwwbtransportfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbtransportfacility)) {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

//         if (count($pwwbtransportfacility) > 0 && !$pwwbtransportfacility[0] == "") {
        //             // if(!isset($dataEntryDateStart) && !empty($dataEntryDateEnd)){
        //             $mynewarray_3__count = $mainTableCount;
        //             $mainTableCount = array();
        //             foreach ($mynewarray_3__count as $val) {
        //                 //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
        //                 if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
        //                     $mainTableCount[] = $val;
        // //                    dd($mainTable);
        //                 }
        //             }
        //         }

        if (count($dataEntryDateEnd) > 0 && !$dataEntryDateEnd[0] == "") {
            // if(!isset($dataEntryDateStart) && !empty($dataEntryDateEnd)){
            $mynewarray_1 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!isset($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!isset($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_2 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme1)) {
                    $mainTable[] = $val;
                }
            }
        }
        // result for semesters ...
        if (!isset($resultSearchFilter) && $resultSearchFilter == 1 && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'fail') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'fail') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'fail') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'fail') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'fail') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'fail') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'fail') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'fail') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!isset($resultSearchFilter) && $resultSearchFilter == '2' && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'pass') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'pass') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'pass') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'pass') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'pass') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'pass') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'pass') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'pass') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }

        // Resilt for Annials....
        if (!isset($resultSearchFilter) && $resultSearchFilter == 1 && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();

            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'fail') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'fail') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!isset($resultSearchFilter) && $resultSearchFilter == '2' && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'pass') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'pass') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme2)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 2) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme3)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 2) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme3)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 3) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme4)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 3) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme4)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 4) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme5)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 4) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme5)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 5) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme6)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 5) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme6)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 6) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme7)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 6) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme7)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 7) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme8)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 7) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme8)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual1)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual2)) {
                    $mainTable[] = $val;
                }
            }
        }

        $filteredArray = array_map(function ($mainTableCount) {

            unset($mainTableCount['id']);
            // unset($mainTableCount['district']);
            unset($mainTableCount['priority_of_submission']);
            unset($mainTableCount['factory_name']);

            unset($mainTableCount['course_id']);
            unset($mainTableCount['course_enrolled_id']);
            unset($mainTableCount['course_registered_id']);
            unset($mainTableCount['affiliated_body_id']);
            unset($mainTableCount['annual_semester_id']);
            unset($mainTableCount['hostel_name']);
            unset($mainTableCount['bus_stop']);
            unset($mainTableCount['wing_id']);

            // unset($mainTableCount['transport_facility']);
            // unset($mainTableCount['hostel_facility']);
            unset($mainTableCount['claim_status']);
            unset($mainTableCount['seme1']);
            unset($mainTableCount['seme2']);
            unset($mainTableCount['seme3']);
            unset($mainTableCount['seme4']);
            unset($mainTableCount['seme5']);
            unset($mainTableCount['seme6']);
            unset($mainTableCount['seme7']);
            unset($mainTableCount['seme8']);
            unset($mainTableCount['annual1']);
            unset($mainTableCount['annual2']);
            unset($mainTableCount['seme1_result']);
            unset($mainTableCount['seme2_result']);
            unset($mainTableCount['seme3_result']);
            unset($mainTableCount['seme4_result']);
            unset($mainTableCount['seme5_result']);
            unset($mainTableCount['seme6_result']);
            unset($mainTableCount['seme7_result']);
            unset($mainTableCount['seme8_result']);
            unset($mainTableCount['annual1_result']);
            unset($mainTableCount['annual2_result']);

            return $mainTableCount;
        }, $mainTableCount);

        for ($i = 0; $i < count($filteredArray); $i++) {
            // if($filteredArray[$i]['course_enrolled_name'] == '' || $filteredArray[$i]['course_enrolled_name'] == null || $filteredArray[$i]['course_enrolled_name'] == 'null'){
            // $filteredArray[$i]['course_enrolled_name'] = '---';
            // }
            // else{
            //     $filteredArray[$i]['course_enrolled_name'] = ucfirst($filteredArray[$i]['course_enrolled_name']);
            // }

            // if($filteredArray[$i]['course_registered_name'] == '' || $filteredArray[$i]['course_registered_name'] == null || $filteredArray[$i]['course_registered_name'] == 'null'){
            // $filteredArray[$i]['course_registered_name'] = '---';
            // }
            // else{
            //     $filteredArray[$i]['course_registered_name'] = ucfirst($filteredArray[$i]['course_registered_name']);
            // }

            // if($filteredArray[$i]['course_name'] == '' || $filteredArray[$i]['course_name'] == null || $filteredArray[$i]['course_name'] == 'null'){
            // $filteredArray[$i]['course_name'] = '---';
            // }
            // else{
            //     $filteredArray[$i]['course_name'] = ucfirst($filteredArray[$i]['course_name']);
            // }

            if ($filteredArray[$i]['roll_no'] == '' || $filteredArray[$i]['roll_no'] == null || $filteredArray[$i]['roll_no'] == 'null') {
                $filteredArray[$i]['roll_no'] = '---';
            } else {
                $filteredArray[$i]['roll_no'] = ucfirst($filteredArray[$i]['roll_no']);
            }

            if ($filteredArray[$i]['transport_facility'] == '' || $filteredArray[$i]['transport_facility'] == null || $filteredArray[$i]['transport_facility'] == 'null') {
                $filteredArray[$i]['transport_facility'] = '---';
            } else {
                $filteredArray[$i]['transport_facility'] = ucfirst($filteredArray[$i]['transport_facility']);
            }

            if ($filteredArray[$i]['hostel_facility'] == '' || $filteredArray[$i]['hostel_facility'] == null || $filteredArray[$i]['hostel_facility'] == 'null') {
                $filteredArray[$i]['hostel_facility'] = '---';
            } else {
                $filteredArray[$i]['hostel_facility'] = ucfirst($filteredArray[$i]['hostel_facility']);
            }

            if ($filteredArray[$i]['file_received_number'] == '' || $filteredArray[$i]['file_received_number'] == null || $filteredArray[$i]['file_received_number'] == 'null') {
                $filteredArray[$i]['file_received_number'] = '---';
            } else {
                $filteredArray[$i]['file_received_number'] = ucfirst($filteredArray[$i]['file_received_number']);
            }

            if ($filteredArray[$i]['worker_name'] == '' || $filteredArray[$i]['worker_name'] == null || $filteredArray[$i]['worker_name'] == 'null') {
                $filteredArray[$i]['worker_name'] = '---';
            } else {
                $filteredArray[$i]['worker_name'] = ucfirst($filteredArray[$i]['worker_name']);
            }

            if ($filteredArray[$i]['name'] == '' || $filteredArray[$i]['name'] == null || $filteredArray[$i]['name'] == 'null') {
                $filteredArray[$i]['name'] = '---';
            } else {
                $filteredArray[$i]['name'] = ucfirst($filteredArray[$i]['name']);
            }

            if ($filteredArray[$i]['district'] == '' || $filteredArray[$i]['district'] == null || $filteredArray[$i]['district'] == 'null') {
                $filteredArray[$i]['district'] = '---';
            } else {
                $filteredArray[$i]['district'] = ucfirst($filteredArray[$i]['district']);
            }

            if ($filteredArray[$i]['wings_short_name'] == '' || $filteredArray[$i]['wings_short_name'] == null || $filteredArray[$i]['wings_short_name'] == 'null') {
                $filteredArray[$i]['wings_short_name'] = '---';
            } else {
                $filteredArray[$i]['wings_short_name'] = ucfirst($filteredArray[$i]['wings_short_name']);
            }

            if ($filteredArray[$i]['affiliated_bodies_code'] == '' || $filteredArray[$i]['affiliated_bodies_code'] == null || $filteredArray[$i]['affiliated_bodies_code'] == 'null') {
                $filteredArray[$i]['affiliated_bodies_code'] = '---';
            } else {
                $filteredArray[$i]['affiliated_bodies_code'] = ucfirst($filteredArray[$i]['affiliated_bodies_code']);
            }

            if ($filteredArray[$i]['file_module_number'] == '' || $filteredArray[$i]['file_module_number'] == null || $filteredArray[$i]['file_module_number'] == 'null') {
                $filteredArray[$i]['file_module_number'] = '---';
            } else {
                $filteredArray[$i]['file_module_number'] = ucfirst($filteredArray[$i]['file_module_number']);
            }

            // if($filteredArray[$i]['father_name'] == '' || $filteredArray[$i]['father_name'] == null || $filteredArray[$i]['father_name'] == 'null'){
            // $filteredArray[$i]['father_name'] = '---';
            // }
            // else{
            //     $filteredArray[$i]['father_name'] = ucfirst($filteredArray[$i]['father_name']);
            // }

        }
        // dD($filteredArray);

        $filteredArray = array_map(function ($filteredArray) {

            unset($filteredArray['id']);
            // unset($filteredArray['district']);
            unset($filteredArray['priority_of_submission']);
            unset($filteredArray['factory_name']);

            unset($filteredArray['course_id']);
            unset($filteredArray['course_enrolled_id']);
            unset($filteredArray['course_registered_id']);
            unset($filteredArray['affiliated_body_id']);
            unset($filteredArray['annual_semester_id']);
            unset($filteredArray['hostel_name']);
            unset($filteredArray['bus_stop']);
            unset($filteredArray['wing_id']);

            // unset($filteredArray['transport_facility']);
            // unset($filteredArray['hostel_facility']);
            unset($filteredArray['claim_status']);
            unset($filteredArray['seme1']);
            unset($filteredArray['seme2']);
            unset($filteredArray['seme3']);
            unset($filteredArray['seme4']);
            unset($filteredArray['seme5']);
            unset($filteredArray['seme6']);
            unset($filteredArray['seme7']);
            unset($filteredArray['seme8']);
            unset($filteredArray['annual1']);
            unset($filteredArray['annual2']);
            unset($filteredArray['seme1_result']);
            unset($filteredArray['seme2_result']);
            unset($filteredArray['seme3_result']);
            unset($filteredArray['seme4_result']);
            unset($filteredArray['seme5_result']);
            unset($filteredArray['seme6_result']);
            unset($filteredArray['seme7_result']);
            unset($filteredArray['seme8_result']);
            unset($filteredArray['annual1_result']);
            unset($filteredArray['annual2_result']);

            return $filteredArray;
        }, $filteredArray);

        //        dd(IndexTable::find(99)->self_contact);

// dd($mainTableCount);
        $count = IndexTable::get();
        $recordsTotal = count($count);
        $recordsFiltered = count($mainTableCount);
        $mainTableCount = collect($mainTableCount);

        // if(count($mainTable) > 10){
        //     // $mainTable = array_slice($mainTable, $request['start'], $request['length'], false);
        // }
        //        $this->exportExcelSheet($mainTable);
        // $this->exportExcelSheet($mainTableCount);
        // Excel::download( new PwwbListExport($recordsFiltered), 'PwwbRecordsList.xlsx');

        // return Excel::download(new PwwbListExport($recordsFiltered), 'Pwwb_List.xlsx');
        // dd($districtSearchFilter, $mainTableCount, $newData);

        return $this->exportFilter($mainTableCount);

        // return response()->json([
        //     // 'data' => $mainTable,
        //     // 'recordsTotal' => $recordsTotal,
        //     // 'recordsFiltered' => $recordsFiltered,
        //     // "draw" => intval($draw),
        //     "iTotalRecords" => $recordsTotal,
        //     "iTotalDisplayRecords" => $recordsFiltered,
        //     'data' => $mainTable,

        // ], 200
        // );

    }

    public function exportFilter($recordsFiltered)
    {
        return Excel::download(new PwwbFilteredListExport($recordsFiltered), 'PwwbRecordsData.xlsx');
    }

    public function recordsExportCSV(request $request)
    {
        // bise_shift
        // ims_shift
        // af_shift
        // vti_shift

        // $search_ = '';
        $districtSearchFilter = '';
        $priorityofsubmission = '';
        $wingSearchFilter = '';
        $courseSearchFilter = '';
        $courseEnrollerdInSearchFilter = '';
        $courseRegisteredInSearchFilter = '';
        $courseaffiliatedbody = '';
        $pwwbtransportfacility = '';
        $pwwbhostelfacility = '';
        $provisionalclaimstatus = '';
        $pwwbacademicterm = '';
        $semesterOne = '';
        $annualCheck = '';
        // Dates...
        $dataEntryDateEnd = '';
        $dataEntryDateStart = '';
        // Date 2..
        $submissionDateStart = '';
        $submissionDateEnd = '';
        $resultSearchFilter = '';

        $districtSearchFilter = $request['districtSearchFilter'];
        $priorityofsubmission = $request->priorityofsubmission;
        $wingSearchFilter = $request->wingSearchFilter;
        $courseSearchFilter = $request->courseSearchFilter;
        $courseEnrollerdInSearchFilter = $request->courseEnrollerdInSearchFilter;
        $courseRegisteredInSearchFilter = $request->courseRegisteredInSearchFilter;
        $courseaffiliatedbody = $request->courseaffiliatedbody;
        $pwwbtransportfacility = $request->pwwbtransportfacility;
        $pwwbhostelfacility = $request->pwwbhostelfacility;
        $provisionalclaimstatus = $request->provisionalclaimstatus;
        $pwwbacademicterm = $request->pwwbacademicterm;
        $semesterOne = $request->semesterOne;
        $annualCheck = $request->annualCheck;
        // Dates...
        $dataEntryDateEnd = $request->dataEntryDateEnd;
        $dataEntryDateStart = $request->dataEntryDateStart;
        // Date 2..
        $submissionDateStart = $request->submissionDateStart;
        $submissionDateEnd = $request->submissionDateEnd;
        $resultSearchFilter = $request->resultSearchFilter;
        // $search_ = $request->serachDataResult;

        if ($districtSearchFilter == 'nulled_sent') {
            $districtSearchFilter = '';
        }
        if ($priorityofsubmission == 'nulled_sent') {
            $priorityofsubmission = '';
        }
        if ($wingSearchFilter == 'nulled_sent') {
            $wingSearchFilter = '';
        }
        if ($courseSearchFilter == 'nulled_sent') {
            $courseSearchFilter = '';
        }
        if ($courseEnrollerdInSearchFilter == 'nulled_sent') {
            $courseEnrollerdInSearchFilter = '';
        }
        if ($courseRegisteredInSearchFilter == 'nulled_sent') {
            $courseRegisteredInSearchFilter = '';
        }
        if ($courseaffiliatedbody == 'nulled_sent') {
            $courseaffiliatedbody = '';
        }
        if ($pwwbtransportfacility == 'nulled_sent') {
            $pwwbtransportfacility = '';
        }
        if ($pwwbhostelfacility == 'nulled_sent') {
            $pwwbhostelfacility = '';
        }
        if ($provisionalclaimstatus == 'nulled_sent') {
            $provisionalclaimstatus = '';
        }
        if ($pwwbacademicterm == 'nulled_sent') {
            $pwwbacademicterm = '';
        }
        if ($semesterOne == 'nulled_sent') {
            $semesterOne = '';
        }
        if ($annualCheck == 'nulled_sent') {
            $annualCheck = '';
        }
        if ($dataEntryDateEnd == 'nulled_sent') {
            $dataEntryDateEnd = '';
        }
        if ($dataEntryDateStart == 'nulled_sent') {
            $dataEntryDateStart = '';
        }
        if ($submissionDateStart == 'nulled_sent') {
            $submissionDateStart = '';
        }
        if ($submissionDateEnd == 'nulled_sent') {
            $submissionDateEnd = '';
        }
        if ($resultSearchFilter == 'nulled_sent') {
            $resultSearchFilter = '';
        }

        $search_ = '';
        if ($request['serachDataResult'] != 'nulled_sent') {

            $search_ = $request['serachDataResult'];
        }

        if (!empty($dataEntryDateStart)) {
            $startTime = new Carbon($dataEntryDateStart);
            $dataEntryDateStart = $startTime->format('Y-m-d');
        }

        if (!empty($dataEntryDateEnd)) {
            $startTime = new Carbon($dataEntryDateEnd);
            $dataEntryDateEnd = $startTime->format('Y-m-d');
        }

        if (!empty($submissionDateStart)) {
            $startTime = new Carbon($submissionDateStart);
            $submissionDateStart = $startTime->format('Y-m-d');
        }

        if (!empty($submissionDateEnd)) {
            $startTime = new Carbon($submissionDateEnd);
            $submissionDateEnd = $startTime->format('Y-m-d');
        }
        // array Conversio

        $districtSearchFilter = preg_split("/[,]/", $districtSearchFilter);
        $priorityofsubmission = preg_split("/[,]/", $priorityofsubmission);
        $wingSearchFilter = preg_split("/[,]/", $wingSearchFilter);
        $courseSearchFilter = preg_split("/[,]/", $courseSearchFilter);
        $courseEnrollerdInSearchFilter = preg_split("/[,]/", $courseEnrollerdInSearchFilter);
        $courseRegisteredInSearchFilter = preg_split("/[,]/", $courseRegisteredInSearchFilter);
        $courseaffiliatedbody = preg_split("/[,]/", $courseaffiliatedbody);
        $pwwbtransportfacility = preg_split("/[,]/", $pwwbtransportfacility);

        $pwwbhostelfacility = preg_split("/[,]/", $pwwbhostelfacility);
        $provisionalclaimstatus = preg_split("/[,]/", $provisionalclaimstatus);
        $pwwbacademicterm = preg_split("/[,]/", $pwwbacademicterm);
        $semesterOne = preg_split("/[,]/", $semesterOne);
        $annualCheck = preg_split("/[,]/", $annualCheck);

        $dataEntryDateEnd = preg_split("/[,]/", $dataEntryDateEnd);
        $dataEntryDateStart = preg_split("/[,]/", $dataEntryDateStart);
        $submissionDateStart = preg_split("/[,]/", $submissionDateStart);

        $submissionDateEnd = preg_split("/[,]/", $submissionDateEnd);
        $resultSearchFilter = preg_split("/[,]/", $resultSearchFilter);

        $mainTable = IndexTable::
            // $excelQuery[] = IndexTable::
            select(
            'index_tables.id', 'index_tables.district', 'index_tables.district_other', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.file_module_number',
            'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.receiving_date', 'index_tables.submission_date',
            'index_tables.file_receipt_voucher_number', 'index_tables.file_receipt_voucher_date', 'index_tables.pwwb_diary_number', 'index_tables.pwwb_diary_date',
            'index_tables.pending_files_with_remarks', 'index_tables.admitted',
            'index_tables.wing_id', 'index_tables.course_id',
            'index_tables.affiliated_body_id', 'index_tables.annual_semester_id',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',

            'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic',
            'worker_personal_details.photograph_uploaded', 'worker_personal_details.photograph_attested',
            'worker_personal_details.photograph_quantity', 'worker_personal_details.applicant_name',
            'worker_personal_details.worker_cnic_attested', 'worker_personal_details.worker_current_status',
            'worker_personal_details.worker_job_nature', 'worker_personal_details.factory_status',
            'worker_personal_details.worker_relationship', 'worker_personal_details.specify_relationship',
            'worker_personal_details.date_of_birth', 'worker_personal_details.pwwb_scholarship_form',
            'worker_personal_details.factory_card', 'worker_personal_details.service_letter',

            'factory_details.factory_name', 'factory_details.factory_address',
            'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_details.factory_registration_certificate_attested_by_manager', 'factory_details.factory_registration_certificate_attested_by_officer',
            'factory_details.factory_registration_certificate_attested_by_director', 'factory_details.signature_of_worker',
            'factory_details.date_of_submission',

            'student_personal_details.name', 'student_personal_details.cnic_no',
            'student_personal_details.father_name', 'student_personal_details.quantity',
            'student_personal_details.student_cnic_attested', 'student_personal_details.date_of_birth',
            'student_personal_details.present_address', 'student_personal_details.marital_status',
            'student_personal_details.postal_address', 'student_personal_details.email',
            'student_personal_details.signature',

            'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name',
            'transport_hostel_details.hostel_facility', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.address', 'transport_hostel_details.manager_name',
            'transport_hostel_details.manager_contact',

            'provisional_claims.claim_status', 'provisional_claims.serial_no',
            'provisional_claims.claim_due', 'provisional_claims.type_of_claim',
            'provisional_claims.type_of_claim_other', 'provisional_claims.claim_received',
            'provisional_claims.claim_date', 'provisional_claims.reason',
            'provisional_claims.cfe_fee', 'provisional_claims.recovery_from_student',

            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'first_semester_result_status_details.fail AS seme1_fail', 'first_semester_result_status_details.next_appearance AS seme1_next_appearance',
            'first_semester_result_status_details.next_appearance_date AS sem1_next_appearance_date', 'first_semester_result_status_details.last_chance_date AS seme1_last_chance_date',
            'first_semester_result_status_details.passing_date AS seme1_passing_date',

            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'second_semester_result_status_details.fail AS seme2_fail', 'second_semester_result_status_details.next_appearance AS seme2_next_appearance',
            'second_semester_result_status_details.next_appearance_date AS seme2_next_appearance_date', 'second_semester_result_status_details.last_chance_date AS seme2_last_chance_date',
            'second_semester_result_status_details.passing_date AS seme2_passing_date',

            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'third_semester_result_status_details.fail AS seme3_fail', 'third_semester_result_status_details.next_appearance AS seme3_next_appearance',
            'third_semester_result_status_details.next_appearance_date AS seme3_next_appearance_date', 'third_semester_result_status_details.last_chance_date AS seme3_last_chance_date',
            'third_semester_result_status_details.passing_date AS seme3_passing_date',

            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fourth_semester_result_status_details.fail AS seme4_fail', 'fourth_semester_result_status_details.next_appearance AS seme4_next_appearance',
            'fourth_semester_result_status_details.next_appearance_date AS seme4_next_appearance_date', 'fourth_semester_result_status_details.last_chance_date AS seme4_last_chance_date',
            'fourth_semester_result_status_details.passing_date AS seme4_passing_date',

            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'fifth_semester_result_status_details.fail AS seme5_fail', 'fifth_semester_result_status_details.next_appearance AS seme5_next_appearance',
            'fifth_semester_result_status_details.next_appearance_date AS seme5_next_appearance_date', 'fifth_semester_result_status_details.last_chance_date AS seme5_last_chance_date',
            'fifth_semester_result_status_details.passing_date AS seme5_passing_date',

            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'sixth_semester_result_status_details.fail AS seme6_fail', 'sixth_semester_result_status_details.next_appearance AS seme6_next_appearance',
            'sixth_semester_result_status_details.next_appearance_date AS seme6_next_appearance_date', 'sixth_semester_result_status_details.last_chance_date AS seme6_last_chance_date',
            'sixth_semester_result_status_details.passing_date AS seme6_passing_date',

            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'seventh_semester_result_status_details.fail AS seme7_fail', 'seventh_semester_result_status_details.next_appearance AS seme7_next_appearance',
            'seventh_semester_result_status_details.next_appearance_date AS seme7_next_appearance_date', 'seventh_semester_result_status_details.last_chance_date AS seme7_last_chance_date',
            'seventh_semester_result_status_details.passing_date AS seme7_passing_date',

            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'eighth_semester_result_status_details.fail AS seme8_fail', 'eighth_semester_result_status_details.next_appearance AS seme8_next_appearance',
            'eighth_semester_result_status_details.next_appearance_date AS seme8_next_appearance_date', 'eighth_semester_result_status_details.last_chance_date AS seme8_last_chance_date',
            'eighth_semester_result_status_details.passing_date AS seme8_passing_date'
        )
        // ->orwhere('index_tables.district', '=', $districtSearchFilter)
            ->orwhere('roll_no', 'like', '%' . $search_ . '%')
            ->orwhere('hostel_name', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('factory_name', 'like', '%' . $search_ . '%')
            ->orwhere('name', 'like', '%' . $search_ . '%')
            ->orwhere('cnic_no', 'like', '%' . $search_ . '%')
            ->orwhere('bus_stop', 'like', '%' . $search_ . '%')

            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();

        $mainTableCount = IndexTable::
            // $excelQuery[] = IndexTable::
            select(
            'index_tables.id', 'index_tables.district', 'index_tables.district_other', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.file_module_number',
            'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.receiving_date', 'index_tables.submission_date',
            'index_tables.file_receipt_voucher_number', 'index_tables.file_receipt_voucher_date', 'index_tables.pwwb_diary_number', 'index_tables.pwwb_diary_date',
            'index_tables.pending_files_with_remarks', 'index_tables.admitted',
            'worker_bank_security_details.eobi_number', 'worker_bank_security_details.social_security', 'index_tables.affiliated_body_id',
            'index_tables.wing_id', 'index_tables.course_id',
            'index_tables.annual_semester_id',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',

            'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic',
            'worker_personal_details.photograph_uploaded', 'worker_personal_details.photograph_attested',
            'worker_personal_details.photograph_quantity', 'worker_personal_details.applicant_name',
            'worker_personal_details.worker_cnic_attested', 'worker_personal_details.worker_current_status',
            'worker_personal_details.worker_job_nature', 'worker_personal_details.factory_status',
            'worker_personal_details.worker_relationship', 'worker_personal_details.specify_relationship',
            'worker_personal_details.date_of_birth', 'worker_personal_details.pwwb_scholarship_form',
            'worker_personal_details.factory_card', 'worker_personal_details.service_letter',

            'factory_details.factory_name', 'factory_details.factory_address',
            'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_details.factory_registration_certificate_attested_by_manager', 'factory_details.factory_registration_certificate_attested_by_officer',
            'factory_details.factory_registration_certificate_attested_by_director', 'factory_details.signature_of_worker',
            'factory_details.date_of_submission',

            'student_personal_details.name', 'student_personal_details.cnic_no',
            'student_personal_details.father_name', 'student_personal_details.quantity',
            'student_personal_details.student_cnic_attested', 'student_personal_details.date_of_birth',
            'student_personal_details.present_address', 'student_personal_details.marital_status',
            'student_personal_details.postal_address', 'student_personal_details.email',
            'student_personal_details.signature',

            'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name',
            'transport_hostel_details.hostel_facility', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.address', 'transport_hostel_details.manager_name',
            'transport_hostel_details.manager_contact',

            // 'provisional_claims.claim_status', 'provisional_claims.serial_no',
            // 'provisional_claims.claim_due', 'provisional_claims.type_of_claim',
            // 'provisional_claims.type_of_claim_other', 'provisional_claims.claim_received',
            // 'provisional_claims.claim_date', 'provisional_claims.reason',
            // 'provisional_claims.cfe_fee', 'provisional_claims.recovery_from_student',

            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'first_semester_result_status_details.fail AS seme1_fail', 'first_semester_result_status_details.next_appearance AS seme1_next_appearance',
            'first_semester_result_status_details.next_appearance_date AS sem1_next_appearance_date', 'first_semester_result_status_details.last_chance_date AS seme1_last_chance_date',
            'first_semester_result_status_details.passing_date AS seme1_passing_date',

            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'second_semester_result_status_details.fail AS seme2_fail', 'second_semester_result_status_details.next_appearance AS seme2_next_appearance',
            'second_semester_result_status_details.next_appearance_date AS seme2_next_appearance_date', 'second_semester_result_status_details.last_chance_date AS seme2_last_chance_date',
            'second_semester_result_status_details.passing_date AS seme2_passing_date',

            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'third_semester_result_status_details.fail AS seme3_fail', 'third_semester_result_status_details.next_appearance AS seme3_next_appearance',
            'third_semester_result_status_details.next_appearance_date AS seme3_next_appearance_date', 'third_semester_result_status_details.last_chance_date AS seme3_last_chance_date',
            'third_semester_result_status_details.passing_date AS seme3_passing_date',

            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fourth_semester_result_status_details.fail AS seme4_fail', 'fourth_semester_result_status_details.next_appearance AS seme4_next_appearance',
            'fourth_semester_result_status_details.next_appearance_date AS seme4_next_appearance_date', 'fourth_semester_result_status_details.last_chance_date AS seme4_last_chance_date',
            'fourth_semester_result_status_details.passing_date AS seme4_passing_date',

            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'fifth_semester_result_status_details.fail AS seme5_fail', 'fifth_semester_result_status_details.next_appearance AS seme5_next_appearance',
            'fifth_semester_result_status_details.next_appearance_date AS seme5_next_appearance_date', 'fifth_semester_result_status_details.last_chance_date AS seme5_last_chance_date',
            'fifth_semester_result_status_details.passing_date AS seme5_passing_date',

            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'sixth_semester_result_status_details.fail AS seme6_fail', 'sixth_semester_result_status_details.next_appearance AS seme6_next_appearance',
            'sixth_semester_result_status_details.next_appearance_date AS seme6_next_appearance_date', 'sixth_semester_result_status_details.last_chance_date AS seme6_last_chance_date',
            'sixth_semester_result_status_details.passing_date AS seme6_passing_date',

            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'seventh_semester_result_status_details.fail AS seme7_fail', 'seventh_semester_result_status_details.next_appearance AS seme7_next_appearance',
            'seventh_semester_result_status_details.next_appearance_date AS seme7_next_appearance_date', 'seventh_semester_result_status_details.last_chance_date AS seme7_last_chance_date',
            'seventh_semester_result_status_details.passing_date AS seme7_passing_date',

            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'eighth_semester_result_status_details.fail AS seme8_fail', 'eighth_semester_result_status_details.next_appearance AS seme8_next_appearance',
            'eighth_semester_result_status_details.next_appearance_date AS seme8_next_appearance_date', 'eighth_semester_result_status_details.last_chance_date AS seme8_last_chance_date',
            'eighth_semester_result_status_details.passing_date AS seme8_passing_date',

            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'first_annual_result_status_details.fail AS annual1_fail', 'first_annual_result_status_details.next_appearance AS annual1_next_appearance',
            'first_annual_result_status_details.next_appearance_date AS annual1_next_appearance_date', 'first_annual_result_status_details.last_chance_date AS annual1_last_chance_date',
            'first_annual_result_status_details.passing_date AS annual1_passing_date',

            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result',
            'second_annual_part_result_status_details.fail AS annual2_fail', 'second_annual_part_result_status_details.next_appearance AS annual2_next_appearance',
            'second_annual_part_result_status_details.next_appearance_date AS annual2_next_appearance_date', 'second_annual_part_result_status_details.last_chance_date AS annual2_last_chance_date',
            'second_annual_part_result_status_details.passing_date AS annual2_passing_date'

        )
            ->orwhere('roll_no', 'like', '%' . $search_ . '%')
            ->orwhere('hostel_name', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('factory_name', 'like', '%' . $search_ . '%')
            ->orwhere('name', 'like', '%' . $search_ . '%')
            ->orwhere('cnic_no', 'like', '%' . $search_ . '%')
            ->orwhere('bus_stop', 'like', '%' . $search_ . '%')

        // ->orwhere('index_tables.district', '=', $districtSearchFilter)

            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('worker_bank_security_details', 'index_tables.id', '=', 'worker_bank_security_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();

        // if(!empty($districtSearchFilter)){

        //     $mynewarray_3__count = $mainTableCount;
        //     $mainTableCount = array();

        //     foreach ($mynewarray_3__count as $val) {
        //         foreach ($districtSearchFilter as $dFilter) {

        //             if($val->district == $dFilter ){
        //                 $mainTableCount[] = $val;

        //             }
        //         }
        //     }
        // }

        // $city = array ( "Peter" => "1", "Kat" => "bradford", "Laura" => "wakeFIeld");
        // print_r ( $city);
        // echo "<br />";

        // foreach ( $city as $key => $value)
        // {
        //   $city[$key] = ucfirst ( strtolower ( $value));
        // }
        // print_r ( $city);
        // dd();

        if (count($mainTableCount) > 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                $mainTableCount[] = $val;
            }
        }
        // dd($mainTableCount);

        // Self Contact ...

        // $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->get();
        //     foreach ($selfContact as $val){
        //         if($val->contact_no != null || $val->contact_no != '')
        //         {
        //             $selfAllContact = $selfAllContact . ',' . $val->contact_no;
        //         }
        //     }

        //     if($val->contact_no != null || $val->contact_no != '')
        //     {
        //         $val['self_coontact'] = $selfAllContact;
        //     }
        //     else
        //     {
        //         $val['self_coontact'] = '---';
        //     }

        foreach ($mainTableCount as $key => &$val) {

            $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->first();
            if ($selfContact != null || $selfContact != '') {
                $val['self_coontact'] = $selfContact->contact_no;
            } else {
                $val['self_coontact'] = '---';
            }
        }

        // Self Contact 2
        foreach ($mainTableCount as $key => &$val) {

            $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->where('contact_no', '<>', $val['self_coontact'])->first();
            if ($selfContact != null || $selfContact != '') {
                $val['self_coontact_2'] = $selfContact->contact_no;
            } else {
                $val['self_coontact_2'] = '---';
            }
        }

        // Self Contact 3
        foreach ($mainTableCount as $key => &$val) {

            $selfContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'self')->where('contact_no', '<>', $val['self_coontact'])->where('contact_no', '<>', $val['self_coontact_2'])->first();
            if ($selfContact != null || $selfContact != '') {
                $val['self_coontact_3'] = $selfContact->contact_no;
            } else {
                $val['self_coontact_3'] = '---';
            }
        }

        // father Contact.
        foreach ($mainTableCount as $key => &$val) {

            $fatherContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'father')->first();
            if ($fatherContact != null || $fatherContact != '') {
                $val['father_coontact'] = $fatherContact->contact_no;
            } else {
                $val['father_coontact'] = '---';
            }
        }
        // Mother Contact.
        foreach ($mainTableCount as $key => &$val) {

            $motherContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'mother')->first();
            if ($motherContact != null || $motherContact != '') {
                $val['mother_coontact'] = $motherContact->contact_no;
            } else {
                $val['mother_coontact'] = '---';
            }
        }

        // Guardian Contact.
        foreach ($mainTableCount as $key => &$val) {

            $guardianContact = StudentContactNumber::where('index_table_id', '=', $val['id'])->where('student_contact_relationship', '=', 'guardian')->first();
            if ($guardianContact != null || $guardianContact != '') {
                $val['guardian_coontact'] = $guardianContact->contact_no;
            } else {
                $val['guardian_coontact'] = '---';
            }
        }

        //Course Applied
        foreach ($mainTableCount as $key => &$val) {
            if ($val['wing_id'] == '1') {
                $afDetail = AfDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'af_details.af_course_applied_in', '=', 'courses.id')->first();
                if ($afDetail != null || $afDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $afDetail->af_course_applied_in)->first();
                    $courseEnrolledName = Course::where('id', '=', $afDetail->af_course_enrolled_in)->first();
                    $courseRegisteredName = Course::where('id', '=', $afDetail->af_course_registered_in)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }

                    // if(isset($courseAppliedName->af_shift))
                    // {
                    //     $val['shift'] = $courseAppliedName->af_shift;
                    // }
                    // else{
                    //     $val['shift'] = '---';
                    // }
                    // $val['course_name'] = $courseAppliedName->name;
                    // $val['course_enrolled_name'] = $courseEnrolledName->name;
                    // $val['course_registered_name'] = $courseRegisteredName->name;
                } else {
                    // $val['shift'] = '---';
                    $val['course_name'] = '---';
                    $val['course_enrolled_name'] = '---';
                    $val['course_registered_name'] = '---';
                }
            } elseif ($val['wing_id'] == '2') {
                $biseDetail = BiseDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'bise_details.bise_course_applied_in', '=', 'courses.id')->first();
                if ($biseDetail != null || $biseDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $biseDetail->bise_course_applied_in)->first();
                    $courseEnrolledName = Course::where('id', '=', $biseDetail->bise_course_enrolled_cfe)->first();
                    $courseRegisteredName = Course::where('id', '=', $biseDetail->bise_course_registered_in)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }

                    // if(isset($courseAppliedName->bise_shift))
                    // {
                    //     $val['shift'] = $courseAppliedName->bise_shift;
                    // }
                    // else{
                    //     $val['shift'] = '---';
                    // }
                    // $val['course_name'] = $courseAppliedName->name;
                    // $val['course_enrolled_name'] = $courseEnrolledName->name;
                    // $val['course_registered_name'] = $courseRegisteredName->name;

                } else {
                    // $val['shift'] = '---';
                    $val['course_name'] = '---';
                    $val['course_enrolled_name'] = '---';
                    $val['course_registered_name'] = '---';
                }
            } elseif ($val['wing_id'] == '3') {
                $ImsDetail = ImsDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'ims_details.ims_course_applied_in_cfe', '=', 'courses.id')->first();
                if ($ImsDetail != null || $ImsDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $ImsDetail->ims_course_applied_in_cfe)->first();
                    $courseEnrolledName = Course::where('id', '=', $ImsDetail->ims_course_enrolled_in_cfe)->first();
                    $courseRegisteredName = Course::where('id', '=', $ImsDetail->ims_course_registered)->first();
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }

                    // if(isset($courseAppliedName->ims_shift))
                    // {
                    //     $val['shift'] = $courseAppliedName->ims_shift;
                    // }
                    // else{
                    //     $val['shift'] = '---';
                    // }
                    // $val['course_name'] = $courseAppliedName->name;
                    // $val['course_enrolled_name'] = $courseEnrolledName->name;
                    // $val['course_registered_name'] = $courseRegisteredName->name;
                } else {
                    // $val['shift'] = '---';
                    $val['course_name'] = '---';
                    $val['course_enrolled_name'] = '---';
                    $val['course_registered_name'] = '---';
                }
            } elseif ($val['wing_id'] == '4') {
                $VtiDetail = VtiDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'vti_details.vti_diploma_applied_in', '=', 'courses.id')->first();
                if ($VtiDetail != null || $VtiDetail != '') {
                    $courseAppliedName = Course::where('id', '=', $VtiDetail->vti_diploma_applied_in)->first();
                    $courseEnrolledName = Course::where('id', '=', $VtiDetail->vti_diploma_enrolled_in)->first();
                    $courseRegisteredName = Course::where('id', '=', $VtiDetail->vti_diploma_registered_in)->first();
                    // $val['course_name'] = $courseAppliedName->name;
                    // $val['course_enrolled_name'] = $courseAppliedName->name;
                    // $val['course_registered_name'] = $courseAppliedName->name;
                    if (isset($courseAppliedName->name)) {
                        $val['course_name'] = $courseAppliedName->name;
                    } else {
                        $val['course_name'] = '---';
                    }

                    if (isset($courseEnrolledName->name)) {
                        $val['course_enrolled_name'] = $courseEnrolledName->name;
                    } else {
                        $val['course_enrolled_name'] = '---';
                    }

                    if (isset($courseRegisteredName->name)) {
                        $val['course_registered_name'] = $courseRegisteredName->name;
                    } else {
                        $val['course_registered_name'] = '---';
                    }

                    // if(isset($courseAppliedName->vti_shift))
                    // {
                    //     $val['shift'] = $courseAppliedName->vti_shift;
                    // }
                    // else{
                    //     $val['shift'] = '---';
                    // }
                } else {
                    // $val['shift'] = '---';
                    $val['course_name'] = '---';
                    $val['course_enrolled_name'] = '---';
                    $val['course_registered_name'] = '---';
                }
            } else {
                // $val['shift'] = '---';
                $val['course_name'] = '---';
                $val['course_enrolled_name'] = '---';
                $val['course_registered_name'] = '---';
            }
        }
        // Shift info
        foreach ($mainTableCount as $key => &$val) {
            $afDetail = AfDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'af_details.af_course_applied_in', '=', 'courses.id')->first();
            $biseDetail = BiseDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'bise_details.bise_course_applied_in', '=', 'courses.id')->first();
            $ImsDetail = ImsDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'ims_details.ims_course_applied_in_cfe', '=', 'courses.id')->first();
            $vtiDetail = VtiDetail::where('index_table_id', '=', $val['id'])->leftjoin('courses', 'vti_details.vti_diploma_applied_in', '=', 'courses.id')->first();
            if (isset($afDetail->af_shift) != null || isset($afDetail->af_shift) != '') {
                $val['shift'] = $afDetail->af_shift;
            } elseif (isset($biseDetail->bise_shift) != null || isset($biseDetail->bise_shift) != '') {
                $val['shift'] = $biseDetail->bise_shift;
            } elseif (isset($ImsDetail->ims_shift) != null || isset($ImsDetail->ims_shift) != '') {
                $val['shift'] = $ImsDetail->ims_shift;
            } elseif (isset($vtiDetail->vti_shift) != null || isset($vtiDetail->vti_shift) != '') {
                $val['shift'] = $vtiDetail->vti_shift;
            } else {
                $val['shift'] = '---';
            }
            // if($biseDetail == null && $vtiDetailt == null && $ImsDetail == null && $afDetail == null){
            //     $val['shift'] = '---';
            // }
        }

        // Worker Joiging Date.
        foreach ($mainTableCount as $key => &$val) {

            $workerJoiningDate = ServiceDetail::where('index_table_id', '=', $val['id'])->where('serial_no', '=', '1')->first();
            if ($workerJoiningDate != null || $workerJoiningDate != '') {
                $val['worker_joining'] = $workerJoiningDate->appointment_date;
            } else {
                $val['worker_joining'] = '---';
            }
        }

        // Dual Course Information...
        foreach ($mainTableCount as $key => &$val) {
            $dualCourseDetail = DualCourseDetail::where('index_table_id', '=', $val['id'])
                ->leftjoin('courses', 'dual_course_details.course', '=', 'courses.id')
                ->first();
            if ($dualCourseDetail != null || $dualCourseDetail != '') {
                $val['dual_course'] = $dualCourseDetail->name;
                $val['dual_shift'] = $dualCourseDetail->shift;
                if ($dualCourseDetail->scheme_of_study == '0') {
                    // $val['scheme_of_study'] = 'Annual';
                } elseif ($dualCourseDetail->scheme_of_study == '1') {
                    // $val['scheme_of_study'] = 'Semester';
                } else {
                    // $val['scheme_of_study'] = '---';
                }
            } else {
                $val['dual_course'] = '---';
                $val['dual_shift'] = '---';
                // $val['scheme_of_study'] = '---';
            }
        }
        // Roll number...
        foreach ($mainTableCount as $key => &$val) {

            $rollNumber = Admission::where('pwwb_file_id', $val['id'])->first();
            if ($rollNumber != null || $rollNumber != '') {
                $val['roll_no'] = Student::where('admission_id', $rollNumber->id)->first()->roll_no;
            } else {
                $val['roll_no'] = '---';
            }
        }

        if (count($districtSearchFilter) > 0 && !$districtSearchFilter[0] == "") {

            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($districtSearchFilter) > 0 && !$districtSearchFilter[0] == "") {

                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($districtSearchFilter)) {
            $mynewarray_3__ = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($districtSearchFilter)) {
                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($priorityofsubmission) > 0 && !$priorityofsubmission[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($priorityofsubmission) > 0 && !$priorityofsubmission[0] == "") {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($priorityofsubmission)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($priorityofsubmission)) {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($wingSearchFilter) > 0 && !$wingSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($wingSearchFilter) > 0 && !$wingSearchFilter[0] == "") {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($wingSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($wingSearchFilter)) {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {
                            $mainTable[] = $val;

                        }
                    }
                }
            }
        }

        if (count($courseSearchFilter) > 0 && !$courseSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseSearchFilter) > 0 && !$courseSearchFilter[0] == "") {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseSearchFilter)) {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($courseEnrollerdInSearchFilter) > 0 && !$courseEnrollerdInSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseEnrollerdInSearchFilter) > 0 && !$courseEnrollerdInSearchFilter[0] == "") {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseEnrollerdInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseEnrollerdInSearchFilter)) {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($courseRegisteredInSearchFilter) > 0 && !$courseRegisteredInSearchFilter[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseRegisteredInSearchFilter) > 0 && !$courseRegisteredInSearchFilter[0] == "") {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseRegisteredInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseRegisteredInSearchFilter)) {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($courseaffiliatedbody) > 0 && !$courseaffiliatedbody[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($courseaffiliatedbody) > 0 && !$courseaffiliatedbody[0] == "") {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($courseaffiliatedbody)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseaffiliatedbody)) {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        //   if(count($pwwbacademicterm) > 0 && !$pwwbacademicterm[0] == ""){
        //     $mynewarray_3__count = $mainTableCount;
        //     $mainTableCount = array();
        //     foreach ($mynewarray_3__count as $val){
        //         if(count($pwwbacademicterm) > 0 && ! $pwwbacademicterm[0] == ""){
        //             foreach ($pwwbacademicterm as $checkList){
        //                 if($val->annual_semester_id == $checkList){
        //                      if($val->annual_semester_id == $pwwbacademicterm){
        //                         $mainTableCount[] = $val;
        //                     }
        //                     elseif ($pwwbacademicterm == '2')
        //                     {
        //                         if($val->annual_semester_id == 0){
        //                             $mainTableCount[] = $val;
        //                         }
        //                     }
        //                 }
        //            }
        //         }
        //     }
        // }

        if ($pwwbacademicterm[0] == "0") {
            $pwwbacademicterm[0] = "12";
        }
        if (count($pwwbacademicterm) > 0 && $pwwbacademicterm[0] != 'null') {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            $i = 0;
            foreach ($mynewarray_3__count as $val) {

                if ($val->annual_semester_id == "0" && $pwwbacademicterm[0] == "12") {
                    $mainTableCount[] = $val;

                } elseif ($pwwbacademicterm[0] == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTableCount[] = $val;
                    }
                }
            }
        }

        // if (!isset($pwwbacademicterm)) {

        //     // if(count($pwwbacademicterm) > 0 && !$pwwbacademicterm[0] == ""){
        //     $mynewarray_3__count = $mainTableCount;
        //     $mainTableCount = array();

        //     foreach ($mynewarray_3__count as $val) {
        //         if ($val->annual_semester_id == $pwwbacademicterm) {
        //             $mainTableCount[] = $val;
        //         } elseif ($pwwbacademicterm == '2') {
        //             if ($val->annual_semester_id == 0) {
        //                 $mainTableCount[] = $val;
        //             }
        //         }
        //     }
        // }

        // dd($mainTableCount);

        if (!isset($pwwbacademicterm)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if ($val->annual_semester_id == $pwwbacademicterm) {
                    $mainTable[] = $val;
                } elseif ($pwwbacademicterm == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTable[] = $val;
                    }
                }
            }
        }

        if (count($pwwbhostelfacility) > 0 && !$pwwbhostelfacility[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($pwwbhostelfacility) > 0 && !$pwwbhostelfacility[0] == "") {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($pwwbhostelfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbhostelfacility)) {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($provisionalclaimstatus) > 0 && !$provisionalclaimstatus[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($provisionalclaimstatus) > 0 && !$provisionalclaimstatus[0] == "") {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!isset($provisionalclaimstatus)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($provisionalclaimstatus)) {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($pwwbtransportfacility) > 0 && !$pwwbtransportfacility[0] == "") {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (count($pwwbtransportfacility) > 0 && !$pwwbtransportfacility[0] == "") {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!isset($pwwbtransportfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbtransportfacility)) {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (count($pwwbtransportfacility) > 0 && !$pwwbtransportfacility[0] == "") {
            // if(!isset($dataEntryDateStart) && !empty($dataEntryDateEnd)){
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (count($dataEntryDateEnd) > 0 && !$dataEntryDateEnd[0] == "") {
            // if(!isset($dataEntryDateStart) && !empty($dataEntryDateEnd)){
            $mynewarray_1 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!isset($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!isset($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_2 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme1)) {
                    $mainTable[] = $val;
                }
            }
        }
        // result for semesters ...
        if (!isset($resultSearchFilter) && $resultSearchFilter == 1 && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'fail') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'fail') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'fail') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'fail') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'fail') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'fail') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'fail') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'fail') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!isset($resultSearchFilter) && $resultSearchFilter == '2' && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'pass') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'pass') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'pass') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'pass') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'pass') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'pass') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'pass') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'pass') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }

        // Resilt for Annials....
        if (!isset($resultSearchFilter) && $resultSearchFilter == 1 && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();

            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'fail') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'fail') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!isset($resultSearchFilter) && $resultSearchFilter == '2' && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'pass') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'pass') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme2)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 2) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme3)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 2) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme3)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 3) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme4)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 3) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme4)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 4) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme5)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 4) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme5)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 5) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme6)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 5) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme6)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 6) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme7)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 6) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme7)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 7) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme8)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($semesterOne) && $semesterOne == 7) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme8)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual1)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!isset($annualCheck) && $annualCheck == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual2)) {
                    $mainTable[] = $val;
                }
            }
        }

        $filteredArray = array_map(function ($mainTableCount) {
            unset($mainTableCount['id']);
            unset($mainTableCount['wing_id']);
            unset($mainTableCount['course_id']);
            unset($mainTableCount['course_enrolled_id']);
            unset($mainTableCount['course_registered_id']);
            // unset($mainTableCount['affiliated_body_id']);
            unset($mainTableCount['annual_semester_id']);
            return $mainTableCount;
        }, $mainTableCount);

        for ($i = 0; $i < count($filteredArray); $i++) {

            if ($filteredArray[$i]['admitted'] == '0' || $filteredArray[$i]['admitted'] == null || $filteredArray[$i]['admitted'] == 'null') {
                $filteredArray[$i]['admitted'] = 'No';
            } else {
                $filteredArray[$i]['admitted'] = 'Yes';
            }

            if ($filteredArray[$i]['affiliated_body_id'] == '' || $filteredArray[$i]['affiliated_body_id'] == null || $filteredArray[$i]['affiliated_body_id'] == 'null') {
                $filteredArray[$i]['affiliated_body_id'] = '---';
            } else {
                $affiliatedbodies = AffiliatedBody::where('id', '=', $filteredArray[$i]['affiliated_body_id'])->first();
                $filteredArray[$i]['affiliated_body_id'] = ucfirst($affiliatedbodies->code);
            }

            if ($filteredArray[$i]['eobi_number'] == '' || $filteredArray[$i]['eobi_number'] == null || $filteredArray[$i]['eobi_number'] == 'null') {
                $filteredArray[$i]['eobi_number'] = '---';
            } else {
                $filteredArray[$i]['eobi_number'] = ucfirst($filteredArray[$i]['eobi_number']);
            }

            if ($filteredArray[$i]['social_security'] == '' || $filteredArray[$i]['social_security'] == null || $filteredArray[$i]['social_security'] == 'null') {
                $filteredArray[$i]['social_security'] = '---';
            } else {
                $filteredArray[$i]['social_security'] = ucfirst($filteredArray[$i]['social_security']);
            }

            if ($filteredArray[$i]['priority_of_submission'] == '' || $filteredArray[$i]['priority_of_submission'] == null || $filteredArray[$i]['priority_of_submission'] == 'null') {
                $filteredArray[$i]['priority_of_submission'] = '---';
            } else {
                $filteredArray[$i]['priority_of_submission'] = ucfirst($filteredArray[$i]['priority_of_submission']);
            }

            if ($filteredArray[$i]['course_enrolled_name'] == '' || $filteredArray[$i]['course_enrolled_name'] == null || $filteredArray[$i]['course_enrolled_name'] == 'null') {
                $filteredArray[$i]['course_enrolled_name'] = '---';
            } else {
                $filteredArray[$i]['course_enrolled_name'] = ucfirst($filteredArray[$i]['course_enrolled_name']);
            }

            if ($filteredArray[$i]['course_registered_name'] == '' || $filteredArray[$i]['course_registered_name'] == null || $filteredArray[$i]['course_registered_name'] == 'null') {
                $filteredArray[$i]['course_registered_name'] = '---';
            } else {
                $filteredArray[$i]['course_registered_name'] = ucfirst($filteredArray[$i]['course_registered_name']);
            }

            if ($filteredArray[$i]['course_name'] == '' || $filteredArray[$i]['course_name'] == null || $filteredArray[$i]['course_name'] == 'null') {
                $filteredArray[$i]['course_name'] = '---';
            } else {
                $filteredArray[$i]['course_name'] = ucfirst($filteredArray[$i]['course_name']);
            }

            if ($filteredArray[$i]['district'] == '' || $filteredArray[$i]['district'] == null || $filteredArray[$i]['district'] == 'null') {
                $filteredArray[$i]['district'] = '---';
            } else {
                $filteredArray[$i]['district'] = ucfirst($filteredArray[$i]['district']);
            }

            if ($filteredArray[$i]['district_other'] == '' || $filteredArray[$i]['district_other'] == null || $filteredArray[$i]['district_other'] == 'null') {
                $filteredArray[$i]['district_other'] = '---';
            } else {
                $filteredArray[$i]['district_other'] = ucfirst($filteredArray[$i]['district_other']);
            }

            if ($filteredArray[$i]['file_received_number'] == '' || $filteredArray[$i]['file_received_number'] == null || $filteredArray[$i]['file_received_number'] == 'null') {
                $filteredArray[$i]['file_received_number'] = '---';
            } else {
                $filteredArray[$i]['file_received_number'] = ucfirst($filteredArray[$i]['file_received_number']);
            }

            if ($filteredArray[$i]['pending_files_with_remarks'] == '' || $filteredArray[$i]['pending_files_with_remarks'] == null || $filteredArray[$i]['pending_files_with_remarks'] == 'null') {
                $filteredArray[$i]['pending_files_with_remarks'] = '---';
            } else {
                $filteredArray[$i]['pending_files_with_remarks'] = ucfirst($filteredArray[$i]['pending_files_with_remarks']);
            }

            if ($filteredArray[$i]['worker_name'] == '' || $filteredArray[$i]['worker_name'] == null || $filteredArray[$i]['worker_name'] == 'null') {
                $filteredArray[$i]['worker_name'] = '---';
            } else {
                $filteredArray[$i]['worker_name'] = ucfirst($filteredArray[$i]['worker_name']);
            }

            if ($filteredArray[$i]['photograph_uploaded'] == '' || $filteredArray[$i]['photograph_uploaded'] == null || $filteredArray[$i]['photograph_uploaded'] == 'null') {
                $filteredArray[$i]['photograph_uploaded'] = '---';
            } else {
                $filteredArray[$i]['photograph_uploaded'] = ucfirst($filteredArray[$i]['photograph_uploaded']);
            }

            if ($filteredArray[$i]['photograph_attested'] == '' || $filteredArray[$i]['photograph_attested'] == null || $filteredArray[$i]['photograph_attested'] == 'null') {
                $filteredArray[$i]['photograph_attested'] = '---';
            } else {
                $filteredArray[$i]['photograph_attested'] = ucfirst($filteredArray[$i]['photograph_attested']);
            }

            if ($filteredArray[$i]['applicant_name'] == '' || $filteredArray[$i]['applicant_name'] == null || $filteredArray[$i]['applicant_name'] == 'null') {
                $filteredArray[$i]['applicant_name'] = '---';
            } else {
                $filteredArray[$i]['applicant_name'] = ucfirst($filteredArray[$i]['applicant_name']);
            }

            if ($filteredArray[$i]['worker_cnic_attested'] == '' || $filteredArray[$i]['worker_cnic_attested'] == null || $filteredArray[$i]['worker_cnic_attested'] == 'null') {
                $filteredArray[$i]['worker_cnic_attested'] = '---';
            } else {
                $filteredArray[$i]['worker_cnic_attested'] = ucfirst($filteredArray[$i]['worker_cnic_attested']);
            }

            if ($filteredArray[$i]['worker_current_status'] == '' || $filteredArray[$i]['worker_current_status'] == null || $filteredArray[$i]['worker_current_status'] == 'null') {
                $filteredArray[$i]['worker_current_status'] = '---';
            } else {
                $filteredArray[$i]['worker_current_status'] = ucfirst($filteredArray[$i]['worker_current_status']);
            }

            if ($filteredArray[$i]['worker_job_nature'] == '' || $filteredArray[$i]['worker_job_nature'] == null || $filteredArray[$i]['worker_job_nature'] == 'null') {
                $filteredArray[$i]['worker_job_nature'] = '---';
            } else {
                $filteredArray[$i]['worker_job_nature'] = ucfirst($filteredArray[$i]['worker_job_nature']);
            }

            if ($filteredArray[$i]['factory_status'] == '' || $filteredArray[$i]['factory_status'] == null || $filteredArray[$i]['factory_status'] == 'null') {
                $filteredArray[$i]['factory_status'] = '---';
            } else {
                $filteredArray[$i]['factory_status'] = ucfirst($filteredArray[$i]['factory_status']);
            }

            if ($filteredArray[$i]['worker_relationship'] == '' || $filteredArray[$i]['worker_relationship'] == null || $filteredArray[$i]['worker_relationship'] == 'null') {
                $filteredArray[$i]['worker_relationship'] = '---';
            } else {
                $filteredArray[$i]['worker_relationship'] = ucfirst($filteredArray[$i]['worker_relationship']);
            }

            if ($filteredArray[$i]['specify_relationship'] == '' || $filteredArray[$i]['specify_relationship'] == null || $filteredArray[$i]['specify_relationship'] == 'null') {
                $filteredArray[$i]['specify_relationship'] = '---';
            } else {
                $filteredArray[$i]['specify_relationship'] = ucfirst($filteredArray[$i]['specify_relationship']);
            }

            if ($filteredArray[$i]['roll_no'] == '' || $filteredArray[$i]['roll_no'] == null || $filteredArray[$i]['roll_no'] == 'null') {
                $filteredArray[$i]['roll_no'] = '---';
            } else {
                $filteredArray[$i]['roll_no'] = ucfirst($filteredArray[$i]['roll_no']);
            }

            if ($filteredArray[$i]['pwwb_scholarship_form'] == '' || $filteredArray[$i]['pwwb_scholarship_form'] == null || $filteredArray[$i]['pwwb_scholarship_form'] == 'null') {
                $filteredArray[$i]['pwwb_scholarship_form'] = '---';
            } else {
                $filteredArray[$i]['pwwb_scholarship_form'] = ucfirst($filteredArray[$i]['pwwb_scholarship_form']);
            }

            if ($filteredArray[$i]['factory_card'] == '' || $filteredArray[$i]['factory_card'] == null || $filteredArray[$i]['factory_card'] == 'null') {
                $filteredArray[$i]['factory_card'] = '---';
            } else {
                $filteredArray[$i]['factory_card'] = ucfirst($filteredArray[$i]['factory_card']);
            }

            if ($filteredArray[$i]['service_letter'] == '' || $filteredArray[$i]['service_letter'] == null || $filteredArray[$i]['service_letter'] == 'null') {
                $filteredArray[$i]['service_letter'] = '---';
            } else {
                $filteredArray[$i]['service_letter'] = ucfirst($filteredArray[$i]['service_letter']);
            }

            if ($filteredArray[$i]['factory_name'] == '' || $filteredArray[$i]['factory_name'] == null || $filteredArray[$i]['factory_name'] == 'null') {
                $filteredArray[$i]['factory_name'] = '---';
            } else {
                $filteredArray[$i]['factory_name'] = ucfirst($filteredArray[$i]['factory_name']);
            }

            if ($filteredArray[$i]['factory_address'] == '' || $filteredArray[$i]['factory_address'] == null || $filteredArray[$i]['factory_address'] == 'null') {
                $filteredArray[$i]['factory_address'] = '---';
            } else {
                $filteredArray[$i]['factory_address'] = ucfirst($filteredArray[$i]['factory_address']);
            }

            if ($filteredArray[$i]['factory_registration_certificate_attested_by_manager'] == '' || $filteredArray[$i]['factory_registration_certificate_attested_by_manager'] == null || $filteredArray[$i]['factory_registration_certificate_attested_by_manager'] == 'null') {
                $filteredArray[$i]['factory_registration_certificate_attested_by_manager'] = '---';
            } else {
                $filteredArray[$i]['factory_registration_certificate_attested_by_manager'] = ucfirst($filteredArray[$i]['factory_registration_certificate_attested_by_manager']);
            }

            if ($filteredArray[$i]['factory_registration_certificate_attested_by_officer'] == '' || $filteredArray[$i]['factory_registration_certificate_attested_by_officer'] == null || $filteredArray[$i]['factory_registration_certificate_attested_by_officer'] == 'null') {
                $filteredArray[$i]['factory_registration_certificate_attested_by_officer'] = '---';
            } else {
                $filteredArray[$i]['factory_registration_certificate_attested_by_officer'] = ucfirst($filteredArray[$i]['factory_registration_certificate_attested_by_officer']);
            }

            if ($filteredArray[$i]['factory_registration_certificate_attested_by_director'] == '' || $filteredArray[$i]['factory_registration_certificate_attested_by_director'] == null || $filteredArray[$i]['factory_registration_certificate_attested_by_director'] == 'null') {
                $filteredArray[$i]['factory_registration_certificate_attested_by_director'] = '---';
            } else {
                $filteredArray[$i]['factory_registration_certificate_attested_by_director'] = ucfirst($filteredArray[$i]['factory_registration_certificate_attested_by_director']);
            }

            if ($filteredArray[$i]['signature_of_worker'] == '' || $filteredArray[$i]['signature_of_worker'] == null || $filteredArray[$i]['signature_of_worker'] == 'null') {
                $filteredArray[$i]['signature_of_worker'] = '---';
            } else {
                $filteredArray[$i]['signature_of_worker'] = ucfirst($filteredArray[$i]['signature_of_worker']);
            }

            if ($filteredArray[$i]['name'] == '' || $filteredArray[$i]['name'] == null || $filteredArray[$i]['name'] == 'null') {
                $filteredArray[$i]['name'] = '---';
            } else {
                $filteredArray[$i]['name'] = ucfirst($filteredArray[$i]['name']);
            }

            if ($filteredArray[$i]['father_name'] == '' || $filteredArray[$i]['father_name'] == null || $filteredArray[$i]['father_name'] == 'null') {
                $filteredArray[$i]['father_name'] = '---';
            } else {
                $filteredArray[$i]['father_name'] = ucfirst($filteredArray[$i]['father_name']);
            }

            if ($filteredArray[$i]['student_cnic_attested'] == '' || $filteredArray[$i]['student_cnic_attested'] == null || $filteredArray[$i]['student_cnic_attested'] == 'null') {
                $filteredArray[$i]['student_cnic_attested'] = '---';
            } else {
                $filteredArray[$i]['student_cnic_attested'] = ucfirst($filteredArray[$i]['student_cnic_attested']);
            }

            if ($filteredArray[$i]['present_address'] == '' || $filteredArray[$i]['present_address'] == null || $filteredArray[$i]['present_address'] == 'null') {
                $filteredArray[$i]['present_address'] = '---';
            } else {
                $filteredArray[$i]['present_address'] = ucfirst($filteredArray[$i]['present_address']);
            }

            if ($filteredArray[$i]['marital_status'] == '' || $filteredArray[$i]['marital_status'] == null || $filteredArray[$i]['marital_status'] == 'null') {
                $filteredArray[$i]['marital_status'] = '---';
            } else {
                $filteredArray[$i]['marital_status'] = ucfirst($filteredArray[$i]['marital_status']);
            }

            if ($filteredArray[$i]['postal_address'] == '' || $filteredArray[$i]['postal_address'] == null || $filteredArray[$i]['postal_address'] == 'null') {
                $filteredArray[$i]['postal_address'] = '---';
            } else {
                $filteredArray[$i]['postal_address'] = ucfirst($filteredArray[$i]['postal_address']);
            }

            if ($filteredArray[$i]['signature'] == '' || $filteredArray[$i]['signature'] == null || $filteredArray[$i]['signature'] == 'null') {
                $filteredArray[$i]['signature'] = '---';
            } else {
                $filteredArray[$i]['signature'] = ucfirst($filteredArray[$i]['signature']);
            }

            if ($filteredArray[$i]['bus_stop'] == '' || $filteredArray[$i]['bus_stop'] == null || $filteredArray[$i]['bus_stop'] == 'null') {
                $filteredArray[$i]['bus_stop'] = '---';
            } else {
                $filteredArray[$i]['bus_stop'] = ucfirst($filteredArray[$i]['bus_stop']);
            }

            if ($filteredArray[$i]['hostel_name'] == '' || $filteredArray[$i]['hostel_name'] == null || $filteredArray[$i]['hostel_name'] == 'null') {
                $filteredArray[$i]['hostel_name'] = '---';
            } else {
                $filteredArray[$i]['hostel_name'] = ucfirst($filteredArray[$i]['hostel_name']);
            }

            if ($filteredArray[$i]['hostel_facility'] == '' || $filteredArray[$i]['hostel_facility'] == null || $filteredArray[$i]['hostel_facility'] == 'null') {
                $filteredArray[$i]['hostel_facility'] = '---';
            } else {
                $filteredArray[$i]['hostel_facility'] = ucfirst($filteredArray[$i]['hostel_facility']);
            }

            if ($filteredArray[$i]['transport_facility'] == '' || $filteredArray[$i]['transport_facility'] == null || $filteredArray[$i]['transport_facility'] == 'null') {
                $filteredArray[$i]['transport_facility'] = '---';
            } else {
                $filteredArray[$i]['transport_facility'] = ucfirst($filteredArray[$i]['transport_facility']);
            }

            if ($filteredArray[$i]['address'] == '' || $filteredArray[$i]['address'] == null || $filteredArray[$i]['address'] == 'null') {
                $filteredArray[$i]['address'] = '---';
            } else {
                $filteredArray[$i]['address'] = ucfirst($filteredArray[$i]['address']);
            }

            if ($filteredArray[$i]['manager_name'] == '' || $filteredArray[$i]['manager_name'] == null || $filteredArray[$i]['manager_name'] == 'null') {
                $filteredArray[$i]['manager_name'] = '---';
            } else {
                $filteredArray[$i]['manager_name'] = ucfirst($filteredArray[$i]['manager_name']);
            }

            if ($filteredArray[$i]['claim_status'] == '' || $filteredArray[$i]['claim_status'] == null || $filteredArray[$i]['claim_status'] == 'null') {
                $filteredArray[$i]['claim_status'] = '---';
            } else {
                $filteredArray[$i]['claim_status'] = ucfirst($filteredArray[$i]['claim_status']);
            }

            if ($filteredArray[$i]['type_of_claim'] == '' || $filteredArray[$i]['type_of_claim'] == null || $filteredArray[$i]['type_of_claim'] == 'null') {
                $filteredArray[$i]['type_of_claim'] = '---';
            } else {
                $filteredArray[$i]['type_of_claim'] = ucfirst($filteredArray[$i]['type_of_claim']);
            }

            if ($filteredArray[$i]['type_of_claim_other'] == '' || $filteredArray[$i]['type_of_claim_other'] == null || $filteredArray[$i]['type_of_claim_other'] == 'null') {
                $filteredArray[$i]['type_of_claim_other'] = '---';
            } else {
                $filteredArray[$i]['type_of_claim_other'] = ucfirst($filteredArray[$i]['type_of_claim_other']);
            }

            if ($filteredArray[$i]['reason'] == '' || $filteredArray[$i]['reason'] == null || $filteredArray[$i]['reason'] == 'null') {
                $filteredArray[$i]['reason'] = '---';
            } else {
                $filteredArray[$i]['reason'] = ucfirst($filteredArray[$i]['reason']);
            }

            if ($filteredArray[$i]['recovery_from_student'] == '' || $filteredArray[$i]['recovery_from_student'] == null || $filteredArray[$i]['recovery_from_student'] == 'null') {
                $filteredArray[$i]['recovery_from_student'] = '---';
            } else {
                $filteredArray[$i]['recovery_from_student'] = ucfirst($filteredArray[$i]['recovery_from_student']);
            }

            if ($filteredArray[$i]['seme1_result'] == '' || $filteredArray[$i]['seme1_result'] == null || $filteredArray[$i]['seme1_result'] == 'null') {
                $filteredArray[$i]['seme1_result'] = '---';
            } else {
                $filteredArray[$i]['seme1_result'] = ucfirst($filteredArray[$i]['seme1_result']);
            }

            if ($filteredArray[$i]['seme1_fail'] == '' || $filteredArray[$i]['seme1_fail'] == null || $filteredArray[$i]['seme1_fail'] == 'null') {
                $filteredArray[$i]['seme1_fail'] = '---';
            } else {
                $filteredArray[$i]['seme1_fail'] = ucfirst($filteredArray[$i]['seme1_fail']);
            }

            if ($filteredArray[$i]['seme1_next_appearance'] == '' || $filteredArray[$i]['seme1_next_appearance'] == null || $filteredArray[$i]['seme1_next_appearance'] == 'null') {
                $filteredArray[$i]['seme1_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme1_next_appearance'] = ucfirst($filteredArray[$i]['seme1_next_appearance']);
            }

            if ($filteredArray[$i]['seme2_fail'] == '' || $filteredArray[$i]['seme2_fail'] == null || $filteredArray[$i]['seme2_fail'] == 'null') {
                $filteredArray[$i]['seme2_fail'] = '---';
            } else {
                $filteredArray[$i]['seme2_fail'] = ucfirst($filteredArray[$i]['seme2_fail']);
            }

            if ($filteredArray[$i]['seme2_next_appearance'] == '' || $filteredArray[$i]['seme2_next_appearance'] == null || $filteredArray[$i]['seme2_next_appearance'] == 'null') {
                $filteredArray[$i]['seme2_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme2_next_appearance'] = ucfirst($filteredArray[$i]['seme2_next_appearance']);
            }

            if ($filteredArray[$i]['seme3_result'] == '' || $filteredArray[$i]['seme3_result'] == null || $filteredArray[$i]['seme3_result'] == 'null') {
                $filteredArray[$i]['seme3_result'] = '---';
            } else {
                $filteredArray[$i]['seme3_result'] = ucfirst($filteredArray[$i]['seme3_result']);
            }

            if ($filteredArray[$i]['seme3_fail'] == '' || $filteredArray[$i]['seme3_fail'] == null || $filteredArray[$i]['seme3_fail'] == 'null') {
                $filteredArray[$i]['seme3_fail'] = '---';
            } else {
                $filteredArray[$i]['seme3_fail'] = ucfirst($filteredArray[$i]['seme3_fail']);
            }

            if ($filteredArray[$i]['seme3_next_appearance'] == '' || $filteredArray[$i]['seme3_next_appearance'] == null || $filteredArray[$i]['seme3_next_appearance'] == 'null') {
                $filteredArray[$i]['seme3_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme3_next_appearance'] = ucfirst($filteredArray[$i]['seme3_next_appearance']);
            }

            if ($filteredArray[$i]['seme4_result'] == '' || $filteredArray[$i]['seme4_result'] == null || $filteredArray[$i]['seme4_result'] == 'null') {
                $filteredArray[$i]['seme4_result'] = '---';
            } else {
                $filteredArray[$i]['seme4_result'] = ucfirst($filteredArray[$i]['seme4_result']);
            }

            if ($filteredArray[$i]['seme4_fail'] == '' || $filteredArray[$i]['seme4_fail'] == null || $filteredArray[$i]['seme4_fail'] == 'null') {
                $filteredArray[$i]['seme4_fail'] = '---';
            } else {
                $filteredArray[$i]['seme4_fail'] = ucfirst($filteredArray[$i]['seme4_fail']);
            }

            if ($filteredArray[$i]['seme4_next_appearance'] == '' || $filteredArray[$i]['seme4_next_appearance'] == null || $filteredArray[$i]['seme4_next_appearance'] == 'null') {
                $filteredArray[$i]['seme4_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme4_next_appearance'] = ucfirst($filteredArray[$i]['seme4_next_appearance']);
            }

            if ($filteredArray[$i]['seme5_result'] == '' || $filteredArray[$i]['seme5_result'] == null || $filteredArray[$i]['seme5_result'] == 'null') {
                $filteredArray[$i]['seme5_result'] = '---';
            } else {
                $filteredArray[$i]['seme5_result'] = ucfirst($filteredArray[$i]['seme5_result']);
            }

            if ($filteredArray[$i]['seme5_fail'] == '' || $filteredArray[$i]['seme5_fail'] == null || $filteredArray[$i]['seme5_fail'] == 'null') {
                $filteredArray[$i]['seme5_fail'] = '---';
            } else {
                $filteredArray[$i]['seme5_fail'] = ucfirst($filteredArray[$i]['seme5_fail']);
            }

            if ($filteredArray[$i]['seme5_next_appearance'] == '' || $filteredArray[$i]['seme5_next_appearance'] == null || $filteredArray[$i]['seme5_next_appearance'] == 'null') {
                $filteredArray[$i]['seme5_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme5_next_appearance'] = ucfirst($filteredArray[$i]['seme5_next_appearance']);
            }

            if ($filteredArray[$i]['seme6_result'] == '' || $filteredArray[$i]['seme6_result'] == null || $filteredArray[$i]['seme6_result'] == 'null') {
                $filteredArray[$i]['seme6_result'] = '---';
            } else {
                $filteredArray[$i]['seme6_result'] = ucfirst($filteredArray[$i]['seme6_result']);
            }

            if ($filteredArray[$i]['seme6_fail'] == '' || $filteredArray[$i]['seme6_fail'] == null || $filteredArray[$i]['seme6_fail'] == 'null') {
                $filteredArray[$i]['seme6_fail'] = '---';
            } else {
                $filteredArray[$i]['seme6_fail'] = ucfirst($filteredArray[$i]['seme6_fail']);
            }

            if ($filteredArray[$i]['seme6_next_appearance'] == '' || $filteredArray[$i]['seme6_next_appearance'] == null || $filteredArray[$i]['seme6_next_appearance'] == 'null') {
                $filteredArray[$i]['seme6_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme6_next_appearance'] = ucfirst($filteredArray[$i]['seme6_next_appearance']);
            }

            if ($filteredArray[$i]['seme7_result'] == '' || $filteredArray[$i]['seme7_result'] == null || $filteredArray[$i]['seme7_result'] == 'null') {
                $filteredArray[$i]['seme7_result'] = '---';
            } else {
                $filteredArray[$i]['seme7_result'] = ucfirst($filteredArray[$i]['seme7_result']);
            }

            if ($filteredArray[$i]['seme7_fail'] == '' || $filteredArray[$i]['seme7_fail'] == null || $filteredArray[$i]['seme7_fail'] == 'null') {
                $filteredArray[$i]['seme7_fail'] = '---';
            } else {
                $filteredArray[$i]['seme7_fail'] = ucfirst($filteredArray[$i]['seme7_fail']);
            }

            if ($filteredArray[$i]['seme7_next_appearance'] == '' || $filteredArray[$i]['seme7_next_appearance'] == null || $filteredArray[$i]['seme7_next_appearance'] == 'null') {
                $filteredArray[$i]['seme7_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme7_next_appearance'] = ucfirst($filteredArray[$i]['seme7_next_appearance']);
            }

            if ($filteredArray[$i]['seme8_result'] == '' || $filteredArray[$i]['seme8_result'] == null || $filteredArray[$i]['seme8_result'] == 'null') {
                $filteredArray[$i]['seme8_result'] = '---';
            } else {
                $filteredArray[$i]['seme8_result'] = ucfirst($filteredArray[$i]['seme8_result']);
            }

            if ($filteredArray[$i]['seme8_next_appearance'] == '' || $filteredArray[$i]['seme8_next_appearance'] == null || $filteredArray[$i]['seme8_next_appearance'] == 'null') {
                $filteredArray[$i]['seme8_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['seme8_next_appearance'] = ucfirst($filteredArray[$i]['seme8_next_appearance']);
            }

            if ($filteredArray[$i]['annual1_result'] == '' || $filteredArray[$i]['annual1_result'] == null || $filteredArray[$i]['annual1_result'] == 'null') {
                $filteredArray[$i]['annual1_result'] = '---';
            } else {
                $filteredArray[$i]['annual1_result'] = ucfirst($filteredArray[$i]['annual1_result']);
            }

            if ($filteredArray[$i]['annual1_fail'] == '' || $filteredArray[$i]['annual1_fail'] == null || $filteredArray[$i]['annual1_fail'] == 'null') {
                $filteredArray[$i]['annual1_fail'] = '---';
            } else {
                $filteredArray[$i]['annual1_fail'] = ucfirst($filteredArray[$i]['annual1_fail']);
            }

            if ($filteredArray[$i]['annual1_next_appearance'] == '' || $filteredArray[$i]['annual1_next_appearance'] == null || $filteredArray[$i]['annual1_next_appearance'] == 'null') {
                $filteredArray[$i]['annual1_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['annual1_next_appearance'] = ucfirst($filteredArray[$i]['annual1_next_appearance']);
            }

            if ($filteredArray[$i]['annual2_result'] == '' || $filteredArray[$i]['annual2_result'] == null || $filteredArray[$i]['annual2_result'] == 'null') {
                $filteredArray[$i]['annual2_result'] = '---';
            } else {
                $filteredArray[$i]['annual2_result'] = ucfirst($filteredArray[$i]['annual2_result']);
            }

            if ($filteredArray[$i]['annual2_fail'] == '' || $filteredArray[$i]['annual2_fail'] == null || $filteredArray[$i]['annual2_fail'] == 'null') {
                $filteredArray[$i]['annual2_fail'] = '---';
            } else {
                $filteredArray[$i]['annual2_fail'] = ucfirst($filteredArray[$i]['annual2_fail']);
            }

            if ($filteredArray[$i]['annual2_next_appearance'] == '' || $filteredArray[$i]['annual2_next_appearance'] == null || $filteredArray[$i]['annual2_next_appearance'] == 'null') {
                $filteredArray[$i]['annual2_next_appearance'] = '---';
            } else {
                $filteredArray[$i]['annual2_next_appearance'] = ucfirst($filteredArray[$i]['annual2_next_appearance']);
            }

            if ($filteredArray[$i]['shift'] == '' || $filteredArray[$i]['shift'] == null || $filteredArray[$i]['shift'] == 'null') {
                $filteredArray[$i]['shift'] = '---';
            } else {
                $filteredArray[$i]['shift'] = ucfirst($filteredArray[$i]['shift']);
            }

            if ($filteredArray[$i]['dual_course'] == '' || $filteredArray[$i]['dual_course'] == null || $filteredArray[$i]['dual_course'] == 'null') {
                $filteredArray[$i]['dual_course'] = '---';
            } else {
                $filteredArray[$i]['dual_course'] = ucfirst($filteredArray[$i]['dual_course']);
            }

            if ($filteredArray[$i]['dual_shift'] == '' || $filteredArray[$i]['dual_shift'] == null || $filteredArray[$i]['dual_shift'] == 'null') {
                $filteredArray[$i]['dual_shift'] = '---';
            } else {
                $filteredArray[$i]['dual_shift'] = ucfirst($filteredArray[$i]['dual_shift']);
            }

            if ($filteredArray[$i]['file_module_number'] == '' || $filteredArray[$i]['file_module_number'] == null || $filteredArray[$i]['file_module_number'] == 'null') {
                $filteredArray[$i]['file_module_number'] = '---';
            } else {
                $filteredArray[$i]['file_module_number'] = ucfirst($filteredArray[$i]['file_module_number']);
            }

            if ($filteredArray[$i]['scheme_of_study'] == '' || $filteredArray[$i]['scheme_of_study'] == null || $filteredArray[$i]['scheme_of_study'] == 'null') {
                // $filteredArray[$i]['scheme_of_study'] = '---';
            } else {
                // $filteredArray[$i]['scheme_of_study'] = ucfirst($filteredArray[$i]['scheme_of_study']);
            }
        }

        // foreach ($filteredArray as $key => $value) {
        //     // $filteredArray[$key] = ucfirst( strtolower($value));
        //     // dd($filteredArray[$key]);
        //     $filteredArray[$key] = ucfirst(strtolower( $value->priority_of_submission));

        // }
        // dd($filteredArray);

        // dd($mainTableCount);

        $count = IndexTable::get();
        $recordsTotal = count($count);
        $recordsFiltered = count($mainTableCount);
        $mainTableCount = collect($filteredArray);
        // dd($mainTableCount[1]);
        // if(count($mainTable) > 10){
        //     // $mainTable = array_slice($mainTable, $request['start'], $request['length'], false);
        // }
        //        $this->exportExcelSheet($mainTable);
        // $this->exportExcelSheet($mainTableCount);
        // Excel::download( new PwwbListExport($recordsFiltered), 'PwwbRecordsList.xlsx');

        // return Excel::download(new PwwbListExport($recordsFiltered), 'Pwwb_List.xlsx');
        // dd($districtSearchFilter, $mainTableCount, $newData);

        return $this->export($mainTableCount);
        // return response()->json([
        //     // 'data' => $mainTable,
        //     // 'recordsTotal' => $recordsTotal,
        //     // 'recordsFiltered' => $recordsFiltered,
        //     // "draw" => intval($draw),
        //     "iTotalRecords" => $recordsTotal,
        //     "iTotalDisplayRecords" => $recordsFiltered,
        //     'data' => $mainTable,

        // ], 200
        // );

    }

    public function export($recordsFiltered)
    {
        return Excel::download(new PwwbListExport($recordsFiltered), 'PwwbRecordsData.xlsx');
    }

    // Function To Get The Data For Export ...
    public function recordsExport(request $request)
    {
        $districtSearchFilter = $request->districtSearchFilter;

        $districtSearchFilter = '';
        $priorityofsubmission = '';
        $wingSearchFilter = '';
        $courseSearchFilter = '';
        $courseEnrollerdInSearchFilter = '';
        $courseRegisteredInSearchFilter = '';
        $courseaffiliatedbody = '';
        $pwwbtransportfacility = '';
        $pwwbhostelfacility = '';
        $provisionalclaimstatus = '';
        $pwwbacademicterm = '';
        $semesterOne = '';
        $annualCheck = '';
        // Dates...
        $dataEntryDateEnd = '';
        $dataEntryDateStart = '';
        // Date 2..
        $submissionDateStart = '';
        $submissionDateEnd = '';
        $resultSearchFilter = '';

        if (!empty($request['districtSearchFilter']) || !empty($request['priorityofsubmission']) || !empty($request['wingSearchFilter']) || !empty($request['courseSearchFilter']) || !empty($request['courseEnrollerdInSearchFilter']) || !empty($request['courseRegisteredInSearchFilter']) || !empty($request['courseaffiliatedbody']) || !empty($request['pwwbtransportfacility']) || !empty($request['pwwbhostelfacility']) || !empty($request['provisionalclaimstatus']) || !empty($request['pwwbacademicterm']) || !empty($request['pwwbacademictermsemester']) || !empty($request['pwwbacademictermannual']) || !empty($request['dataEntryDateEnd']) || !empty($request['dataEntryDateStart']) || !empty($request['submissionDateStart']) || !empty($request['submissionDateEnd']) || !empty($request['pwwbacademicterm']) || !empty($request['pwwbacademictermannual']) || !empty($request['resultSearchFilter'])) {

            $districtSearchFilter = $request['districtSearchFilter'];
            $priorityofsubmission = $request['priorityofsubmission'];
            $wingSearchFilter = $request['wingSearchFilter'];
            $courseSearchFilter = $request['courseSearchFilter'];
            $courseEnrollerdInSearchFilter = $request['courseEnrollerdInSearchFilter'];
            $courseRegisteredInSearchFilter = $request['courseRegisteredInSearchFilter'];
            $courseaffiliatedbody = $request['courseaffiliatedbody'];
            $pwwbtransportfacility = $request['pwwbtransportfacility'];
            $pwwbhostelfacility = $request['pwwbhostelfacility'];
            $provisionalclaimstatus = $request['provisionalclaimstatus'];
            $resultSearchFilter = $request['resultSearchFilter'];
            $pwwbacademicterm = $request['pwwbacademicterm'];
            $semesterOne = $request['pwwbacademictermsemester'];
            $annualCheck = $request['pwwbacademictermannual'];
            $dataEntryDateEnd = $request['dataEntryDateEnd'];
            $dataEntryDateStart = $request['dataEntryDateStart'];
            $submissionDateStart = $request['submissionDateStart'];
            $submissionDateEnd = $request['submissionDateEnd'];

            if (!empty($dataEntryDateStart)) {
                $startTime = new Carbon($dataEntryDateStart);
                $dataEntryDateStart = $startTime->format('Y-m-d');
            }

            if (!empty($dataEntryDateEnd)) {
                $startTime = new Carbon($dataEntryDateEnd);
                $dataEntryDateEnd = $startTime->format('Y-m-d');
            }

            if (!empty($submissionDateStart)) {
                $startTime = new Carbon($submissionDateStart);
                $submissionDateStart = $startTime->format('Y-m-d');
            }

            if (!empty($submissionDateEnd)) {
                $startTime = new Carbon($submissionDateEnd);
                $submissionDateEnd = $startTime->format('Y-m-d');
            }

        }
        $search_ = '';
        if (!empty($request['search']['value'])) {
            $search_ = $request['search']['value'];
        }

        $mainTable = IndexTable::
            select('index_tables.id', 'index_tables.district', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'index_tables.receiving_date', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'factory_details.factory_name', 'student_personal_details.name',
            'student_personal_details.cnic_no', 'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name', 'index_tables.wing_id',
            'index_tables.course_id', 'index_tables.course_id', 'index_tables.course_id', 'index_tables.affiliated_body_id', 'index_tables.annual_semester_id', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.hostel_facility', 'provisional_claims.claim_status', 'index_tables.annual_semesteR_id',
//            'student_contact_numbers.student_contact_relationship', 'student_contact_numbers.contact_no',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',
            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result'
        )
//            ->whereBetween('receiving_date', [$dataEntryDateStart, $dataEntryDateEnd])
            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
//            ->leftjoin('student_contact_numbers', 'index_tables.id', '=', 'student_contact_numbers.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();

        $mainTableCount = IndexTable::
            select('index_tables.id', 'index_tables.district', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'index_tables.receiving_date', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'factory_details.factory_name', 'student_personal_details.name',
            'student_personal_details.cnic_no', 'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name', 'index_tables.wing_id',
            'index_tables.course_id', 'index_tables.course_id', 'index_tables.course_id', 'index_tables.affiliated_body_id', 'index_tables.annual_semester_id', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.hostel_facility', 'provisional_claims.claim_status', 'index_tables.annual_semesteR_id',
//            'student_contact_numbers.student_contact_relationship', 'student_contact_numbers.contact_no',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',
            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result'
        )
//            ->whereBetween('receiving_date', [$dataEntryDateStart, $dataEntryDateEnd])
            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
            ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
//            ->leftjoin('student_contact_numbers', 'index_tables.id', '=', 'student_contact_numbers.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();
        $districtSearchFilter = array('Lahore');
        if (!empty($districtSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($districtSearchFilter)) {
                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($districtSearchFilter)) {
            $mynewarray_3__ = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($districtSearchFilter)) {
                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($priorityofsubmission)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($priorityofsubmission)) {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($priorityofsubmission)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($priorityofsubmission)) {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($wingSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($wingSearchFilter)) {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($wingSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($wingSearchFilter)) {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {
                            $mainTable[] = $val;

                        }
                    }
                }
            }
        }

        if (!empty($courseSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseSearchFilter)) {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseSearchFilter)) {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseEnrollerdInSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseEnrollerdInSearchFilter)) {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseEnrollerdInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseEnrollerdInSearchFilter)) {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseRegisteredInSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseRegisteredInSearchFilter)) {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseRegisteredInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseRegisteredInSearchFilter)) {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseaffiliatedbody)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseaffiliatedbody)) {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseaffiliatedbody)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseaffiliatedbody)) {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($pwwbacademicterm)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if ($val->annual_semester_id == $pwwbacademicterm) {
                    $mainTableCount[] = $val;
                } elseif ($pwwbacademicterm == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTableCount[] = $val;
                    }
                }
            }
        }

        if (!empty($pwwbacademicterm)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if ($val->annual_semester_id == $pwwbacademicterm) {
                    $mainTable[] = $val;
                } elseif ($pwwbacademicterm == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTable[] = $val;
                    }
                }
            }
        }

        if (!empty($pwwbhostelfacility)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($pwwbhostelfacility)) {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($pwwbhostelfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbhostelfacility)) {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($provisionalclaimstatus)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($provisionalclaimstatus)) {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($provisionalclaimstatus)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($provisionalclaimstatus)) {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($pwwbtransportfacility)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($pwwbtransportfacility)) {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($pwwbtransportfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbtransportfacility)) {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($dataEntryDateStart) && !empty($dataEntryDateEnd)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($dataEntryDateStart) && !empty($dataEntryDateEnd)) {
            $mynewarray_1 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_2 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme1)) {
                    $mainTable[] = $val;
                }
            }
        }
        // result for semesters ...
        if (!empty($resultSearchFilter) && $resultSearchFilter == 1 && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'fail') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'fail') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'fail') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'fail') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'fail') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'fail') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'fail') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'fail') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!empty($resultSearchFilter) && $resultSearchFilter == '2' && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'pass') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'pass') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'pass') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'pass') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'pass') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'pass') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'pass') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'pass') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }

        // Resilt for Annials....
        if (!empty($resultSearchFilter) && $resultSearchFilter == 1 && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();

            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'fail') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'fail') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!empty($resultSearchFilter) && $resultSearchFilter == '2' && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'pass') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'pass') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme2)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 2) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme3)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 2) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme3)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 3) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme4)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 3) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme4)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 4) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme5)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 4) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme5)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 5) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme6)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 5) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme6)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 6) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme7)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 6) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme7)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 7) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme8)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 7) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme8)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual1)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual2)) {
                    $mainTable[] = $val;
                }
            }
        }

        $count = IndexTable::get();
        $recordsTotal = count($count);
        $recordsFiltered = count($mainTableCount);

        if (count($mainTable) > 10) {
            // $mainTable = array_slice($mainTable, $request['start'], $request['length'], false);
        }
//        $this->exportExcelSheet($mainTable);
        // $this->exportExcelSheet($mainTableCount);
        // Excel::download( new PwwbListExport($recordsFiltered), 'PwwbRecordsList.xlsx');

        // return Excel::download(new PwwbListExport($recordsFiltered), 'Pwwb_List.xlsx');
        return $this->export($mainTableCount);
        // return response()->json([
        //     // 'data' => $mainTable,
        //     // 'recordsTotal' => $recordsTotal,
        //     // 'recordsFiltered' => $recordsFiltered,
        //     // "draw" => intval($draw),
        //     "iTotalRecords" => $recordsTotal,
        //     "iTotalDisplayRecords" => $recordsFiltered,
        //     'data' => $mainTable,

        // ], 200
        // );
    }

    public function fillHomePage(Request $request)
    {
        $districtSearchFilter = '';
        $priorityofsubmission = '';
        $wingSearchFilter = '';
        $courseSearchFilter = '';
        $courseEnrollerdInSearchFilter = '';
        $courseRegisteredInSearchFilter = '';
        $courseaffiliatedbody = '';
        $pwwbtransportfacility = '';
        $pwwbhostelfacility = '';
        $provisionalclaimstatus = '';
        $pwwbacademicterm = '';
        $semesterOne = '';
        $annualCheck = '';
        // Dates...
        $dataEntryDateEnd = '';
        $dataEntryDateStart = '';
        // Date 2..
        $submissionDateStart = '';
        $submissionDateEnd = '';
        $resultSearchFilter = '';
        $returnFilePwwb = '';

        if (!empty($request['returnFiles']) || !empty($request['districtSearchFilter']) || !empty($request['priorityofsubmission']) || !empty($request['wingSearchFilter']) || !empty($request['courseSearchFilter']) || !empty($request['courseEnrollerdInSearchFilter']) || !empty($request['courseRegisteredInSearchFilter']) || !empty($request['courseaffiliatedbody']) || !empty($request['pwwbtransportfacility']) || !empty($request['pwwbhostelfacility']) || !empty($request['provisionalclaimstatus']) || !empty($request['pwwbacademicterm']) || !empty($request['pwwbacademictermsemester']) || !empty($request['pwwbacademictermannual']) || !empty($request['dataEntryDateEnd']) || !empty($request['dataEntryDateStart']) || !empty($request['submissionDateStart']) || !empty($request['submissionDateEnd']) || !empty($request['pwwbacademicterm']) || !empty($request['pwwbacademictermannual']) || !empty($request['resultSearchFilter'])) {

            $districtSearchFilter = $request['districtSearchFilter'];
            $priorityofsubmission = $request['priorityofsubmission'];
            $wingSearchFilter = $request['wingSearchFilter'];
            $courseSearchFilter = $request['courseSearchFilter'];
            $courseEnrollerdInSearchFilter = $request['courseEnrollerdInSearchFilter'];
            $courseRegisteredInSearchFilter = $request['courseRegisteredInSearchFilter'];
            $courseaffiliatedbody = $request['courseaffiliatedbody'];
            $pwwbtransportfacility = $request['pwwbtransportfacility'];
            $pwwbhostelfacility = $request['pwwbhostelfacility'];
            $provisionalclaimstatus = $request['provisionalclaimstatus'];
            $resultSearchFilter = $request['resultSearchFilter'];
            $pwwbacademicterm = $request['pwwbacademicterm'];
            $semesterOne = $request['pwwbacademictermsemester'];
            $annualCheck = $request['pwwbacademictermannual'];
            $dataEntryDateEnd = $request['dataEntryDateEnd'];
            $dataEntryDateStart = $request['dataEntryDateStart'];
            $submissionDateStart = $request['submissionDateStart'];
            $submissionDateEnd = $request['submissionDateEnd'];
            $returnFilePwwb = $request['returnFiles'];


            if (!empty($dataEntryDateStart)) {
                $startTime = new Carbon($dataEntryDateStart);
                $dataEntryDateStart = $startTime->format('Y-m-d');
            }

            if (!empty($dataEntryDateEnd)) {
                $startTime = new Carbon($dataEntryDateEnd);
                $dataEntryDateEnd = $startTime->format('Y-m-d');
            }

            if (!empty($submissionDateStart)) {
                $startTime = new Carbon($submissionDateStart);
                $submissionDateStart = $startTime->format('Y-m-d');
            }

            if (!empty($submissionDateEnd)) {
                $startTime = new Carbon($submissionDateEnd);
                $submissionDateEnd = $startTime->format('Y-m-d');
            }

        }
        $search_ = '';
        if (!empty($request['search']['value'])) {
            $search_ = $request['search']['value'];
        }

        $mainTable = IndexTable::
            select('index_tables.id', 'index_tables.return_file_pwwb', 'index_tables.district', 'index_tables.admitted', 'index_tables.is_dsm', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'index_tables.file_module_number',
            'index_tables.receiving_date', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'factory_details.factory_name', 'student_personal_details.name',
            'student_personal_details.cnic_no', 'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name', 'index_tables.wing_id',
            'index_tables.course_id', 'index_tables.course_id', 'index_tables.course_id', 'index_tables.affiliated_body_id', 'index_tables.annual_semester_id', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.hostel_facility', 'index_tables.annual_semesteR_id',
//            'student_contact_numbers.student_contact_relationship', 'student_contact_numbers.contact_no',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',
            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result',
            'wings.id AS wings_id', 'wings.name AS wings_name', 'wings.short_name As wings_short_name',
            'affiliated_bodies.id AS affiliated_bodies_id', 'affiliated_bodies.name AS affiliated_bodies_name', 'affiliated_bodies.code AS affiliated_bodies_code'
        )
        // ->orwhere('roll_no', 'like', '%' . $search_ . '%')
            ->orwhere('hostel_name', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('file_module_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('factory_name', 'like', '%' . $search_ . '%')
            ->orwhere('student_personal_details.name', 'like', '%' . $search_ . '%')
            ->orwhere('cnic_no', 'like', '%' . $search_ . '%')
            ->orwhere('bus_stop', 'like', '%' . $search_ . '%')
//            ->whereBetween('receiving_date', [$dataEntryDateStart, $dataEntryDateEnd])
            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
        // ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            ->leftjoin('wings', 'index_tables.wing_id', '=', 'wings.id')
            ->leftjoin('affiliated_bodies', 'index_tables.affiliated_body_id', '=', 'affiliated_bodies.id')
//            ->leftjoin('student_contact_numbers', 'index_tables.id', '=', 'student_contact_numbers.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();
        // ->offset($request['start'])->limit($request['length'])

        $mainTableCount = IndexTable::
            select('index_tables.id', 'index_tables.return_file_pwwb', 'index_tables.district', 'index_tables.admitted', 'index_tables.is_dsm', 'index_tables.priority_of_submission', 'index_tables.file_received_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'index_tables.file_module_number',
            'index_tables.receiving_date', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'factory_details.factory_name', 'student_personal_details.name',
            'student_personal_details.cnic_no', 'transport_hostel_details.bus_stop', 'transport_hostel_details.hostel_name', 'index_tables.wing_id',
            'index_tables.course_id', 'index_tables.course_id', 'index_tables.course_id', 'index_tables.affiliated_body_id', 'index_tables.annual_semester_id', 'transport_hostel_details.transport_facility',
            'transport_hostel_details.hostel_facility', 'index_tables.annual_semesteR_id',
//            'student_contact_numbers.student_contact_relationship', 'student_contact_numbers.contact_no',
            'index_tables.course_registered_id', 'index_tables.course_enrolled_id', 'index_tables.course_name', 'index_tables.course_enrolled_name', 'index_tables.course_registered_name',
            'first_semester_result_status_details.index_table_id AS seme1', 'first_semester_result_status_details.result AS seme1_result',
            'second_semester_result_status_details.index_table_id AS seme2', 'second_semester_result_status_details.result AS seme2_result',
            'third_semester_result_status_details.index_table_id AS seme3', 'third_semester_result_status_details.result AS seme3_result',
            'fourth_semester_result_status_details.index_table_id AS seme4', 'fourth_semester_result_status_details.result AS seme4_result',
            'fifth_semester_result_status_details.index_table_id AS seme5', 'fifth_semester_result_status_details.result AS seme5_result',
            'sixth_semester_result_status_details.index_table_id AS seme6', 'sixth_semester_result_status_details.result AS seme6_result',
            'seventh_semester_result_status_details.index_table_id AS seme7', 'seventh_semester_result_status_details.result AS seme7_result',
            'eighth_semester_result_status_details.index_table_id AS seme8', 'eighth_semester_result_status_details.result AS seme8_result',
            'first_annual_result_status_details.index_table_id AS annual1', 'first_annual_result_status_details.result AS annual1_result',
            'second_annual_part_result_status_details.index_table_id AS annual2', 'second_annual_part_result_status_details.result AS annual2_result',
            'wings.id AS wings_id', 'wings.name AS wings_name', 'wings.short_name As wings_short_name',
            'affiliated_bodies.id AS affiliated_bodies_id', 'affiliated_bodies.name AS affiliated_bodies_name', 'affiliated_bodies.code AS affiliated_bodies_code'
        )
        // ->orwhere('roll_no', 'like', '%' . $search_ . '%')
            ->orwhere('hostel_name', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('file_module_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('factory_name', 'like', '%' . $search_ . '%')
            ->orwhere('student_personal_details.name', 'like', '%' . $search_ . '%')
            ->orwhere('cnic_no', 'like', '%' . $search_ . '%')
            ->orwhere('bus_stop', 'like', '%' . $search_ . '%')
//            ->whereBetween('receiving_date', [$dataEntryDateStart, $dataEntryDateEnd])
            ->leftjoin('worker_personal_details', 'index_tables.id', '=', 'worker_personal_details.index_table_id')
            ->leftjoin('factory_details', 'index_tables.id', '=', 'factory_details.index_table_id')
            ->leftjoin('student_personal_details', 'index_tables.id', '=', 'student_personal_details.index_table_id')
            ->leftjoin('transport_hostel_details', 'index_tables.id', '=', 'transport_hostel_details.index_table_id')
        // ->leftjoin('provisional_claims', 'index_tables.id', '=', 'provisional_claims.index_table_id')
            ->leftjoin('first_semester_result_status_details', 'index_tables.id', '=', 'first_semester_result_status_details.index_table_id')
            ->leftjoin('second_semester_result_status_details', 'index_tables.id', '=', 'second_semester_result_status_details.index_table_id')
            ->leftjoin('third_semester_result_status_details', 'index_tables.id', '=', 'third_semester_result_status_details.index_table_id')
            ->leftjoin('fourth_semester_result_status_details', 'index_tables.id', '=', 'fourth_semester_result_status_details.index_table_id')
            ->leftjoin('fifth_semester_result_status_details', 'index_tables.id', '=', 'fifth_semester_result_status_details.index_table_id')
            ->leftjoin('sixth_semester_result_status_details', 'index_tables.id', '=', 'sixth_semester_result_status_details.index_table_id')
            ->leftjoin('seventh_semester_result_status_details', 'index_tables.id', '=', 'seventh_semester_result_status_details.index_table_id')
            ->leftjoin('eighth_semester_result_status_details', 'index_tables.id', '=', 'eighth_semester_result_status_details.index_table_id')
            ->leftjoin('first_annual_result_status_details', 'index_tables.id', '=', 'first_annual_result_status_details.index_table_id')
            ->leftjoin('second_annual_part_result_status_details', 'index_tables.id', '=', 'second_annual_part_result_status_details.index_table_id')
            ->leftjoin('wings', 'index_tables.wing_id', '=', 'wings.id')
            ->leftjoin('affiliated_bodies', 'index_tables.affiliated_body_id', '=', 'affiliated_bodies.id')
//            ->leftjoin('student_contact_numbers', 'index_tables.id', '=', 'student_contact_numbers.index_table_id')
            ->orderByRaw('length(file_module_number)', 'ASC')->orderBy('file_module_number', 'ASC')->get();
             // dd($mainTableCount, $mainTable);
        // Roll number...
        foreach ($mainTable as $key => &$val) {

            $rollNumber = Admission::where('pwwb_file_id', $val['id'])->first();
            if ($rollNumber != null || $rollNumber != '') {
                $val['roll_no'] = Student::withoutGlobalScope('onlyActive')->where('admission_id', $rollNumber->id)->first()->roll_no;
            } else {
                $val['roll_no'] = '---';
            }
        }

        if (count($mainTable) > 0) {
            $mynewarray_3__count = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3__count as $val) {
                $mainTable[] = $val;
            }
        }

        if (!empty($districtSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($districtSearchFilter)) {
                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($districtSearchFilter)) {
            $mynewarray_3__ = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($districtSearchFilter)) {
                    foreach ($districtSearchFilter as $checkList) {
                        if ($val->district == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($priorityofsubmission)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($priorityofsubmission)) {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($priorityofsubmission)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($priorityofsubmission)) {
                    foreach ($priorityofsubmission as $checkList) {
                        if ($val->priority_of_submission == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($wingSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($wingSearchFilter)) {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($wingSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($wingSearchFilter)) {
                    foreach ($wingSearchFilter as $checkList) {
                        if ($val->wing_id == $checkList) {
                            $mainTable[] = $val;

                        }
                    }
                }
            }
        }

        // added return active / inactive start...
        if (!empty($returnFilePwwb)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($returnFilePwwb)) {
                    // foreach ($returnFilePwwb as $checkList) {
                        if ($val->return_file_pwwb == 1) {

                            $mainTableCount[] = $val;
                        }
                    // }
                }
            }
        }

        if (!empty($returnFilePwwb)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($returnFilePwwb)) {
                    // foreach ($returnFilePwwb as $checkList) {
                        if ($val->return_file_pwwb == 1) {
                            $mainTable[] = $val;

                        }
                    // }
                }
            }
        }



        // added return active / inactive end...


        if (!empty($courseSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseSearchFilter)) {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseSearchFilter)) {
                    foreach ($courseSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseEnrollerdInSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseEnrollerdInSearchFilter)) {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseEnrollerdInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseEnrollerdInSearchFilter)) {
                    foreach ($courseEnrollerdInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseRegisteredInSearchFilter)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseRegisteredInSearchFilter)) {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseRegisteredInSearchFilter)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseRegisteredInSearchFilter)) {
                    foreach ($courseRegisteredInSearchFilter as $checkList) {
                        if ($val->course_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseaffiliatedbody)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($courseaffiliatedbody)) {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($courseaffiliatedbody)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($courseaffiliatedbody)) {
                    foreach ($courseaffiliatedbody as $checkList) {
                        if ($val->affiliated_body_id == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($pwwbacademicterm)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if ($val->annual_semester_id == $pwwbacademicterm) {
                    $mainTableCount[] = $val;
                } elseif ($pwwbacademicterm == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTableCount[] = $val;
                    }
                }
            }
        }

        if (!empty($pwwbacademicterm)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if ($val->annual_semester_id == $pwwbacademicterm) {
                    $mainTable[] = $val;
                } elseif ($pwwbacademicterm == '2') {
                    if ($val->annual_semester_id == 0) {
                        $mainTable[] = $val;
                    }
                }
            }
        }

        if (!empty($pwwbhostelfacility)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($pwwbhostelfacility)) {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($pwwbhostelfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbhostelfacility)) {
                    foreach ($pwwbhostelfacility as $checkList) {
                        if ($val->hostel_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($provisionalclaimstatus)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($provisionalclaimstatus)) {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($provisionalclaimstatus)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($provisionalclaimstatus)) {
                    foreach ($provisionalclaimstatus as $checkList) {
                        if ($val->claim_status == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($pwwbtransportfacility)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (!empty($pwwbtransportfacility)) {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {

                            $mainTableCount[] = $val;
                        }
                    }
                }
            }
        }
        if (!empty($pwwbtransportfacility)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (!empty($pwwbtransportfacility)) {
                    foreach ($pwwbtransportfacility as $checkList) {
                        if ($val->transport_facility == $checkList) {
                            $mainTable[] = $val;
                        }
                    }
                }
            }
        }

        if (!empty($dataEntryDateStart) && !empty($dataEntryDateEnd)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($dataEntryDateStart) && !empty($dataEntryDateEnd)) {
            $mynewarray_1 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->receiving_date >= $dataEntryDateStart && $val->receiving_date <= $dataEntryDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTableCount[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($submissionDateStart) && !empty($submissionDateEnd)) {
            $mynewarray_2 = $mainTable;
//            dd($mainTable);
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                //        ($data->receiving_date >= $dataEntryDateStart && $data->receiving_date <=$dataEntryDateEnd)
                if ($val->submission_date >= $submissionDateStart && $val->submission_date <= $submissionDateEnd) {
                    $mainTable[] = $val;
//                    dd($mainTable);
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme1)) {
                    $mainTable[] = $val;
                }
            }
        }
        // result for semesters ...
        if (!empty($resultSearchFilter) && $resultSearchFilter == 1 && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'fail') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'fail') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'fail') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'fail') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'fail') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'fail') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'fail') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'fail') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!empty($resultSearchFilter) && $resultSearchFilter == '2' && isset($semesterOne)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {

                if (!empty($val->seme1_result == 'pass') && isset($val->seme1) && $semesterOne == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme2_result == 'pass') && isset($val->seme2) && $semesterOne == 1) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme3_result == 'pass') && isset($val->seme3) && $semesterOne == 2) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme4_result == 'pass') && isset($val->seme4) && $semesterOne == 3) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme5_result == 'pass') && isset($val->seme5) && $semesterOne == 4) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme6_result == 'pass') && isset($val->seme6) && $semesterOne == 5) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme7_result == 'pass') && isset($val->seme7) && $semesterOne == 6) {
                    $mainTable[] = $val;
                } elseif (!empty($val->seme8_result == 'pass') && isset($val->seme8) && $semesterOne == 7) {
                    $mainTable[] = $val;
                }
            }
        }

        // Resilt for Annials....
        if (!empty($resultSearchFilter) && $resultSearchFilter == 1 && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();

            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'fail') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'fail') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }
        if (!empty($resultSearchFilter) && $resultSearchFilter == '2' && isset($annualCheck)) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mynewarray_3 as $val) {
                if (!empty($val->annual1_result == 'pass') && isset($val->annual1) && $annualCheck == 0) {
                    $mainTable[] = $val;
                } elseif (!empty($val->annual2_result == 'pass') && isset($val->annual2) && $annualCheck == 1) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme2)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 2) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme3)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 2) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme3)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 3) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme4)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 3) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme4)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 4) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme5)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 4) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme5)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 5) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme6)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 5) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme6)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 6) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme7)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 6) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme7)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 7) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->seme8)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($semesterOne) && $semesterOne == 7) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->seme8)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual1)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 0) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual1)) {
                    $mainTable[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 1) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if (isset($val->annual2)) {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (!empty($annualCheck) && $annualCheck == 1) {
            $mynewarray_3 = $mainTable;
            $mainTable = array();
            foreach ($mainTableCount as $val) {
                if (isset($val->annual2)) {
                    $mainTable[] = $val;
                }
            }
        }

        for ($i = 0; $i < count($mainTable); $i++) {
            if ($mainTable[$i]['transport_facility'] == '' || $mainTable[$i]['transport_facility'] == null || $mainTable[$i]['transport_facility'] == 'null') {
                $mainTable[$i]['transport_facility'] = '---';
            } else {
                $mainTable[$i]['transport_facility'] = ucfirst($mainTable[$i]['transport_facility']);
            }

            if ($mainTable[$i]['hostel_facility'] == '' || $mainTable[$i]['hostel_facility'] == null || $mainTable[$i]['hostel_facility'] == 'null') {
                $mainTable[$i]['hostel_facility'] = '---';
            } else {
                $mainTable[$i]['hostel_facility'] = ucfirst($mainTable[$i]['hostel_facility']);
            }

            if ($mainTable[$i]['roll_no'] == '' || $mainTable[$i]['roll_no'] == null || $mainTable[$i]['roll_no'] == 'null') {
                $mainTable[$i]['roll_no'] = '---';
            } else {
                $mainTable[$i]['roll_no'] = ucfirst($mainTable[$i]['roll_no']);
            }
        }

        $count = IndexTable::get();
        $recordsTotal = count($count);
        $recordsFiltered = count($mainTableCount);

        if (count($mainTable) > 10) {
            $mainTable = array_slice($mainTable, $request['start'], $request['length'], false);
        }
//        $this->exportExcelSheet($mainTable);
        $this->exportExcelSheet($mainTableCount);
        return response()->json([
            // 'data' => $mainTable,
            // 'recordsTotal' => $recordsTotal,
            // 'recordsFiltered' => $recordsFiltered,
            // "draw" => intval($draw),
            "iTotalRecords" => $recordsTotal,
            "iTotalDisplayRecords" => $recordsFiltered,
            'data' => $mainTable,

        ], 200
        );

    }
    public function workerFamily(Request $request)
    {
        $date = $request->date;
        $workerFamily = WorkerFamilyMemberDetail::all();
        if ($date != null) {
            if ($date) {
                $workerFamily = WorkerFamilyMemberDetail::whereFollowUp($date)->get();
            }
        }
        $cnic = $request->cnic;
        if ($cnic != null) {
            if ($cnic) {
                $workerFamily = WorkerFamilyMemberDetail::where("worker_cnic", "LIKE", "%" . $cnic . "%")->get();
            }
        }
        return view('pwwb.worker_family', ['workerFamily' => $workerFamily, 'date' => $date, 'cnic' => $cnic]);
    }

    // Ali Naeem .
    public function workerEligible(Request $request, $id)
    {
        $date = $request->date;
        // $workereligible = ServiceDetail::all();
        $workereligible = ServiceDetail::whereindex_table_id($id)->get();
        // dd($workereligible);
        if ($date) {
            $workereligible = ServiceDetail::whereFollowUp($date)->get();
        }
        return view('pwwb.worker_eligible', ['workerEligible' => $workereligible, 'date' => $date]);
    }

    //Edit Followup
    public function editFollowup(Request $request, $id)
    {

        $fileInfo = IndexTable::select('index_tables.id', 'index_tables.file_received_number', 'index_tables.wing_id', 'index_tables.course_id', 'index_tables.receiving_date'
            , 'index_tables.submission_date', 'index_tables.pwwb_diary_number', 'index_tables.affiliated_body_id', 'index_tables.district', 'index_tables.session'
            , 'worker_personal_details.index_table_id As worker_personal_details_index_table_id  ', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'worker_personal_details.date_of_birth', 'factory_details.factory_name', 'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_death_manager_details.factory_manager_name', 'factory_death_manager_details.factory_manager_email'
            , 'worker_bank_security_details.index_table_id AS worker_bank_security_details_index_table_id', 'worker_bank_security_details.social_security', 'worker_bank_security_details.social_security_office_name', 'worker_bank_security_details.eobi_number', 'worker_bank_security_details.name_of_bank', 'worker_bank_security_details.bank_iban', 'worker_personal_details.factory_card', 'worker_family_member_details.potential_degree'
            , 'student_personal_details.index_table_id AS student_personal_details_index_table_id', 'worker_family_member_details.student_name AS student_name', 'worker_family_member_details.worker_name AS father_name', 'student_personal_details.cnic_no', 'student_personal_details.date_of_birth', 'student_personal_details.present_address', 'student_personal_details.marital_status', 'student_personal_details.postal_address', 'student_personal_details.email'
            , 'courses.id', 'courses.course_code', 'courses.name AS course_name', 'worker_family_member_details.follow_up', 'worker_family_member_details.index_table_id AS Family_index_table_id'
            , 'wings.id', 'wings.short_name', 'worker_family_member_details.worker_cnic AS st_cnic', 'worker_family_member_details.id AS family_id'
        )
            ->leftjoin('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_details', 'factory_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_bank_security_details', 'worker_bank_security_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('student_personal_details', 'student_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_death_manager_details', 'factory_death_manager_details.index_table_id', '=', 'index_tables.id')

            ->leftjoin('courses', 'courses.id', '=', 'index_tables.course_id')
            ->leftjoin('wings', 'wings.id', '=', 'index_tables.wing_id')
            ->where('worker_family_member_details.id', '=', $id)->first();

        $familyCalls = WorkerFamilyMemberDetail::where('family_id', '=', $id)->get();

        $familyCallsCheckAdmitted = WorkerFollowupsCalls::where('status', '=', '3')->where('family_id', '=', $id)->first();

        return view('pwwb.followUpEdit', ['fileInfo' => $fileInfo, 'familyCalls' => $familyCalls, 'familyCallsCheckAdmitted' => $familyCallsCheckAdmitted]);
    }

    // Fulloups List

    public function followUpsList()
    {
        //  $fileInfo = IndexTable::
        //  select('index_tables.id', 'index_tables.file_received_number', 'worker_family_member_details.file_received_status', 'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.wing_id', 'index_tables.course_id', 'index_tables.receiving_date'
        // , 'index_tables.submission_date', 'index_tables.pwwb_diary_number', 'index_tables.affiliated_body_id', 'index_tables.district', 'index_tables.session'
        // , 'worker_personal_details.index_table_id As worker_personal_details_index_table_id  ', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'worker_personal_details.date_of_birth', 'factory_details.factory_name', 'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
        // 'factory_death_manager_details.factory_manager_name', 'factory_death_manager_details.factory_manager_email'
        // , 'worker_bank_security_details.index_table_id AS worker_bank_security_details_index_table_id', 'worker_bank_security_details.social_security', 'worker_bank_security_details.social_security_office_name', 'worker_bank_security_details.eobi_number', 'worker_bank_security_details.name_of_bank', 'worker_bank_security_details.bank_iban', 'worker_personal_details.factory_card', 'worker_family_member_details.potential_degree'
        // , 'student_personal_details.index_table_id AS student_personal_details_index_table_id', 'worker_family_member_details.student_name AS student_name', 'worker_family_member_details.worker_name AS father_name', 'student_personal_details.cnic_no', 'student_personal_details.date_of_birth', 'student_personal_details.present_address', 'student_personal_details.marital_status', 'student_personal_details.postal_address', 'student_personal_details.email'
        // , 'courses.id', 'courses.course_code', 'courses.name AS course_name' , 'worker_family_member_details.follow_up', 'worker_family_member_details.index_table_id AS Family_index_table_id'
        // , 'wings.id', 'wings.short_name', 'worker_family_member_details.worker_cnic AS st_cnic', 'worker_family_member_details.id AS family_id', 'worker_family_member_details.id')
        // ->where('worker_family_member_details.file_received_status', '=', 'no')
        // ->leftjoin('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
        // ->leftjoin('factory_details', 'factory_details.index_table_id', '=', 'index_tables.id')
        // ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
        // ->leftjoin('worker_bank_security_details', 'worker_bank_security_details.index_table_id', '=', 'index_tables.id')
        // ->leftjoin('student_personal_details', 'student_personal_details.index_table_id', '=', 'index_tables.id')
        // ->leftjoin('factory_death_manager_details', 'factory_death_manager_details.index_table_id', '=', 'index_tables.id')
        // ->leftjoin('courses', 'courses.id', '=', 'index_tables.course_id')
        // ->leftjoin('wings', 'wings.id', '=', 'index_tables.wing_id')
        // ->get();

        // if (count($fileInfo) > 0) {
        //     $mynewarray_3__count = $fileInfo;
        //     $fileInfo = array();
        //     foreach ($mynewarray_3__count as $val) {
        //         $fileInfo[] = $val;
        //     }
        // }

        // return view('pwwb.followupslist', ['list' => $fileInfo]);
        $mainTable = IndexTable::get();
        $courses = Course::get();
        $affiliatedBodies = AffiliatedBody::get();
        $wings = Wing::get();
        $fileReceivedNumber = IndexTable::
            where('worker_family_member_details.file_received_status', '=', 'no')
            ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')->groupby('worker_family_member_details.file_received_status')->get();
        // return view('pwwb.followupslist', ['list' => $fileInfo]);
        return view('pwwb.followupslist', ['data' => null, 'mainTable' => $mainTable, 'courses' => $courses, 'wings' => $wings, 'affiliatedBodies' => $affiliatedBodies, 'fileReceivedNumber' => $fileReceivedNumber]);
    }

    public function followupslist_json_rst(request $request)
    {
        $followupDateStartFilter = '';
        $followupDateEndFilter = '';
        $followupDateStart = '';
        $followupDateEnd = '';
        $search_ = '';
        if (!empty($request['followupDateEndFilter']) || !empty($request['followupDateStartFilter']) || !empty($request['search']['value'])) {

            $followupDateEnd = $request['followupDateEndFilter'];
            $followupDateStart = $request['followupDateStartFilter'];
            if (!empty($followupDateStart)) {
                $startTime = new Carbon($followupDateStart);
                $followupDateStart = $startTime->format('Y-m-d');
            }
            if (!empty($followupDateEnd)) {
                $startTime = new Carbon($followupDateEnd);
                $followupDateEnd = $startTime->format('Y-m-d');
            }
            if (!empty($search_)) {
                $search_ = $request['search']['value'];
            }

        }
        $maintable = IndexTable::
            select('index_tables.id', 'index_tables.file_received_number', 'worker_family_member_details.file_received_status', 'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.wing_id', 'index_tables.course_id', 'index_tables.receiving_date'
            , 'index_tables.submission_date', 'index_tables.pwwb_diary_number', 'index_tables.affiliated_body_id', 'index_tables.district', 'index_tables.session'
            , 'worker_personal_details.index_table_id As worker_personal_details_index_table_id', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic AS workers_CNIC', 'worker_personal_details.date_of_birth', 'factory_details.factory_name', 'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_death_manager_details.factory_manager_name', 'factory_death_manager_details.factory_manager_email'
            , 'worker_bank_security_details.index_table_id AS worker_bank_security_details_index_table_id', 'worker_bank_security_details.social_security', 'worker_bank_security_details.social_security_office_name', 'worker_bank_security_details.eobi_number', 'worker_bank_security_details.name_of_bank', 'worker_bank_security_details.bank_iban', 'worker_personal_details.factory_card', 'worker_family_member_details.potential_degree'
            , 'student_personal_details.index_table_id AS student_personal_details_index_table_id', 'worker_family_member_details.student_name AS student_name', 'worker_family_member_details.worker_name AS father_name', 'student_personal_details.cnic_no', 'student_personal_details.date_of_birth', 'student_personal_details.present_address', 'student_personal_details.marital_status', 'student_personal_details.postal_address', 'student_personal_details.email'
            , 'courses.id', 'courses.course_code', 'courses.name AS course_name', 'worker_family_member_details.follow_up', 'worker_family_member_details.index_table_id AS Family_index_table_id'
            , 'wings.id', 'wings.short_name', 'worker_family_member_details.worker_cnic AS st_cnic', 'worker_family_member_details.id AS family_id', 'worker_family_member_details.id')
            ->orwhere('index_tables.id', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_status', 'like', '%' . $search_ . '%')
            ->orwhere('pwwb_diary_number', 'like', '%' . $search_ . '%')
            ->orwhere('follow_up', 'like', '%' . $search_ . '%')
            ->leftjoin('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_details', 'factory_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_bank_security_details', 'worker_bank_security_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('student_personal_details', 'student_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_death_manager_details', 'factory_death_manager_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('courses', 'courses.id', '=', 'index_tables.course_id')
            ->leftjoin('wings', 'wings.id', '=', 'index_tables.wing_id')
            ->get();

        $mainTableCount = IndexTable::
            select('index_tables.id', 'index_tables.file_received_number', 'worker_family_member_details.file_received_status', 'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.wing_id', 'index_tables.course_id', 'index_tables.receiving_date'
            , 'index_tables.submission_date', 'index_tables.pwwb_diary_number', 'index_tables.affiliated_body_id', 'index_tables.district', 'index_tables.session'
            , 'worker_personal_details.index_table_id As worker_personal_details_index_table_id', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic AS workers_CNIC', 'worker_personal_details.date_of_birth', 'factory_details.factory_name', 'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_death_manager_details.factory_manager_name', 'factory_death_manager_details.factory_manager_email', 'worker_family_member_details.nextfollowupdate'
            , 'worker_bank_security_details.index_table_id AS worker_bank_security_details_index_table_id', 'worker_bank_security_details.social_security', 'worker_bank_security_details.social_security_office_name', 'worker_bank_security_details.eobi_number', 'worker_bank_security_details.name_of_bank', 'worker_bank_security_details.bank_iban', 'worker_personal_details.factory_card', 'worker_family_member_details.potential_degree'
            , 'student_personal_details.index_table_id AS student_personal_details_index_table_id', 'worker_family_member_details.student_name AS student_name', 'worker_family_member_details.worker_name AS father_name', 'student_personal_details.cnic_no', 'student_personal_details.date_of_birth', 'student_personal_details.present_address', 'student_personal_details.marital_status', 'student_personal_details.postal_address', 'student_personal_details.email'
            , 'courses.id', 'courses.course_code', 'courses.name AS course_name', 'worker_family_member_details.follow_up', 'worker_family_member_details.index_table_id AS Family_index_table_id', 'worker_family_member_details.change'
            , 'wings.id', 'wings.short_name', 'worker_family_member_details.worker_cnic AS father_cnic', 'worker_family_member_details.id AS family_id', 'worker_family_member_details.id')
            ->orwhere('index_tables.id', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_status', 'like', '%' . $search_ . '%')
            ->orwhere('pwwb_diary_number', 'like', '%' . $search_ . '%')
            ->orwhere('follow_up', 'like', '%' . $search_ . '%')
            ->leftjoin('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_details', 'factory_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_bank_security_details', 'worker_bank_security_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('student_personal_details', 'student_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_death_manager_details', 'factory_death_manager_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('courses', 'courses.id', '=', 'index_tables.course_id')
            ->leftjoin('wings', 'wings.id', '=', 'index_tables.wing_id')
            ->get();

        // $callsConfirmation = '';

        // if(count($mainTableCount) > 0){
        //     $newArray = $mainTableCount;
        //     $mainTableCount = array();
        //     foreach ($newArray as $val){
        //         if($val->file_received_status == 'no'){
        //             $callsConfirmation = WorkerFollowupsCalls::where('family_id', '=', $val->family_id)
        //             ->orderByRaw('length(nextfollowupdate)', 'ASC')->orderBy('nextfollowupdate', 'ASC')->get();
        //             dd($callsConfirmation);
        //             if(!in_array($val->family_id, $callsConfirmation)){
        //                 if($callsConfirmation > 0){
        //                     foreach ($callsConfirmation as $val){
        //                         $mainTableCount[] = $val;
        //                     }
        //                 }
        //                 else{
        //                     $mainTableCount[] = $val;
        //                 }
        //             }

        //         }
        //     }
        // }
        // dd(count($mainTableCount));

        if (count($mainTableCount) > 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                $mainTableCount[] = $val;
            }
        }

        if (count($mainTableCount) > 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if ($val->file_received_status == 'no') {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (count($mainTableCount) > 0) {
            $newArray = $mainTableCount;
            $mainTableCount = array();

            foreach ($newArray as $val) {
                if ($val->change == 1) {
                    if ($val->follow_up >= $followupDateStart && $val->follow_up <= $followupDateEnd) {
                        $mainTableCount[] = $val;
                    }
                } elseif ($val->change > 1) {
                    if ($val->nextfollowupdate >= $followupDateStart && $val->nextfollowupdate <= $followupDateEnd) {
                        $mainTableCount[] = $val;

                    }
                }
            }
        }

        // loop to add --- if any empty data
        for ($i = 0; $i < count($mainTableCount); $i++) {
            if ($mainTableCount[$i]['file_received_number'] == '' || $mainTableCount[$i]['file_received_number'] == null || $mainTableCount[$i]['file_received_number'] == 'null') {
                $mainTableCount[$i]['file_received_number'] = '---';
            } else {
                $mainTableCount[$i]['file_received_number'] = ucfirst($mainTableCount[$i]['file_received_number']);
            }

            if ($mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] == '' || $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] == null || $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] == 'null') {
                $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] = '---';
            } else {
                $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] = ucfirst($mainTableCount[$i]['fresh_file_submission_in_pwwb_number']);
            }

            if ($mainTableCount[$i]['father_name'] == '' || $mainTableCount[$i]['father_name'] == null || $mainTableCount[$i]['father_name'] == 'null') {
                $mainTableCount[$i]['father_name'] = '---';
            } else {
                $mainTableCount[$i]['father_name'] = ucfirst($mainTableCount[$i]['father_name']);
            }

            if ($mainTableCount[$i]['father_cnic'] == '' || $mainTableCount[$i]['father_cnic'] == null || $mainTableCount[$i]['father_cnic'] == 'null') {
                $mainTableCount[$i]['father_cnic'] = '---';
            } else {
                $mainTableCount[$i]['father_cnic'] = ucfirst($mainTableCount[$i]['father_cnic']);
            }

            if ($mainTableCount[$i]['file_received_status'] == '' || $mainTableCount[$i]['file_received_status'] == null || $mainTableCount[$i]['file_received_status'] == 'null') {
                $mainTableCount[$i]['file_received_status'] = '---';
            } else {
                $mainTableCount[$i]['file_received_status'] = ucfirst($mainTableCount[$i]['file_received_status']);
            }
            if ($mainTableCount[$i]['pwwb_diary_number'] == '' || $mainTableCount[$i]['pwwb_diary_number'] == null || $mainTableCount[$i]['pwwb_diary_number'] == 'null') {
                $mainTableCount[$i]['pwwb_diary_number'] = '---';
            } else {
                $mainTableCount[$i]['pwwb_diary_number'] = ucfirst($mainTableCount[$i]['pwwb_diary_number']);
            }
            if ($mainTableCount[$i]['follow_up'] == '' || $mainTableCount[$i]['follow_up'] == null || $mainTableCount[$i]['follow_up'] == 'null') {
                $mainTableCount[$i]['follow_up'] = '---';
            } else {
                $mainTableCount[$i]['follow_up'] = ucfirst($mainTableCount[$i]['follow_up']);
            }
            if ($mainTableCount[$i]['nextfollowupdate'] == '' || $mainTableCount[$i]['nextfollowupdate'] == null || $mainTableCount[$i]['nextfollowupdate'] == 'null') {
                $mainTableCount[$i]['nextfollowupdate'] = '---';
            } else {
                $mainTableCount[$i]['nextfollowupdate'] = ucfirst($mainTableCount[$i]['nextfollowupdate']);
            }
        }

        $count = WorkerFamilyMemberDetail::where('file_received_status', '=', 'no')->get();
        $recordsTotal = count($count);
        $recordsFiltered = count($mainTableCount);

        if (count($mainTableCount) > 10) {
            $mainTableCount = array_slice($mainTableCount, $request['start'], $request['length'], false);
        }
        return response()->json([
            "iTotalRecords" => $recordsTotal,
            "iTotalDisplayRecords" => $recordsFiltered,
            'data' => $mainTableCount,

        ], 200
        );
    }

    public function recordExportFollowups($start, $end)
    {
        $followupDateStartFilter = '';
        $followupDateEndFilter = '';
        $followupDateStart = '';
        $followupDateEnd = '';
        $search_ = '';
        // if (!empty($request['followupDateEndFilter']) || !empty($request['followupDateStartFilter']) || !empty($request['search']['value'])) {

        //     $followupDateEnd = $request['followupDateEndFilter'];
        //     $followupDateStart = $request['followupDateStartFilter'];
        //     if (!empty($followupDateStart)) {
        //         $startTime = new Carbon($followupDateStart);
        //         $followupDateStart = $startTime->format('Y-m-d');
        //     }
        //     if (!empty($followupDateEnd)) {
        //         $startTime = new Carbon($followupDateEnd);
        //         $followupDateEnd = $startTime->format('Y-m-d');
        //     }
        //     if(!empty($search_)){
        //         $search_ = $request['search']['value'];
        //     }

        // }
        $followupDateStart = $start;
        $followupDateEnd = $end;
        $maintable = IndexTable::
            select('index_tables.id', 'index_tables.file_received_number', 'worker_family_member_details.file_received_status', 'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.wing_id', 'index_tables.course_id', 'index_tables.receiving_date'
            , 'index_tables.submission_date', 'index_tables.pwwb_diary_number', 'index_tables.affiliated_body_id', 'index_tables.district', 'index_tables.session'
            , 'worker_personal_details.index_table_id As worker_personal_details_index_table_id', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic AS workers_CNIC', 'worker_personal_details.date_of_birth', 'factory_details.factory_name', 'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_death_manager_details.factory_manager_name', 'factory_death_manager_details.factory_manager_email'
            , 'worker_bank_security_details.index_table_id AS worker_bank_security_details_index_table_id', 'worker_bank_security_details.social_security', 'worker_bank_security_details.social_security_office_name', 'worker_bank_security_details.eobi_number', 'worker_bank_security_details.name_of_bank', 'worker_bank_security_details.bank_iban', 'worker_personal_details.factory_card', 'worker_family_member_details.potential_degree'
            , 'student_personal_details.index_table_id AS student_personal_details_index_table_id', 'worker_family_member_details.student_name AS student_name', 'worker_family_member_details.worker_name AS father_name', 'student_personal_details.cnic_no', 'student_personal_details.date_of_birth', 'student_personal_details.present_address', 'student_personal_details.marital_status', 'student_personal_details.postal_address', 'student_personal_details.email'
            , 'courses.id', 'courses.course_code', 'courses.name AS course_name', 'worker_family_member_details.follow_up', 'worker_family_member_details.index_table_id AS Family_index_table_id'
            , 'wings.id', 'wings.short_name', 'worker_family_member_details.worker_cnic AS st_cnic', 'worker_family_member_details.id AS family_id', 'worker_family_member_details.id')
            ->orwhere('index_tables.id', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_status', 'like', '%' . $search_ . '%')
            ->orwhere('pwwb_diary_number', 'like', '%' . $search_ . '%')
            ->orwhere('follow_up', 'like', '%' . $search_ . '%')
            ->leftjoin('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_details', 'factory_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_bank_security_details', 'worker_bank_security_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('student_personal_details', 'student_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_death_manager_details', 'factory_death_manager_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('courses', 'courses.id', '=', 'index_tables.course_id')
            ->leftjoin('wings', 'wings.id', '=', 'index_tables.wing_id')
            ->get();

        $mainTableCount = IndexTable::
            select('index_tables.id', 'index_tables.file_received_number', 'index_tables.fresh_file_submission_in_pwwb_number',
            'worker_family_member_details.worker_name AS father_name', 'worker_family_member_details.worker_cnic AS father_cnic',
            'worker_family_member_details.file_received_status', 'index_tables.pwwb_diary_number',
            'worker_family_member_details.follow_up', 'worker_family_member_details.nextfollowupdate',
            'worker_family_member_details.student_name AS student_name',

            'index_tables.wing_id', 'index_tables.course_id', 'index_tables.receiving_date'
            , 'index_tables.submission_date', 'index_tables.affiliated_body_id', 'index_tables.district', 'index_tables.session'
            , 'worker_personal_details.index_table_id As worker_personal_details_index_table_id', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic AS workers_CNIC', 'worker_personal_details.date_of_birth', 'factory_details.factory_name', 'factory_details.factory_registration_number', 'factory_details.factory_registration_date',
            'factory_death_manager_details.factory_manager_name', 'factory_death_manager_details.factory_manager_email', 'worker_bank_security_details.index_table_id AS worker_bank_security_details_index_table_id', 'worker_bank_security_details.social_security', 'worker_bank_security_details.social_security_office_name', 'worker_bank_security_details.eobi_number', 'worker_bank_security_details.name_of_bank', 'worker_bank_security_details.bank_iban', 'worker_personal_details.factory_card', 'worker_family_member_details.potential_degree'
            , 'student_personal_details.index_table_id AS student_personal_details_index_table_id', 'student_personal_details.cnic_no', 'student_personal_details.date_of_birth', 'student_personal_details.present_address', 'student_personal_details.marital_status', 'student_personal_details.postal_address', 'student_personal_details.email'
            , 'courses.id', 'courses.course_code', 'courses.name AS course_name', 'worker_family_member_details.index_table_id AS Family_index_table_id', 'worker_family_member_details.change'
            , 'wings.id', 'wings.short_name', 'worker_family_member_details.id AS family_id', 'worker_family_member_details.id')
            ->orwhere('index_tables.id', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_number', 'like', '%' . $search_ . '%')
            ->orwhere('fresh_file_submission_in_pwwb_number', 'like', '%' . $search_ . '%')
            ->orwhere('receiving_date', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_name', 'like', '%' . $search_ . '%')
            ->orwhere('worker_personal_details.worker_cnic', 'like', '%' . $search_ . '%')
            ->orwhere('file_received_status', 'like', '%' . $search_ . '%')
            ->orwhere('pwwb_diary_number', 'like', '%' . $search_ . '%')
            ->orwhere('follow_up', 'like', '%' . $search_ . '%')
            ->leftjoin('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_details', 'factory_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('worker_bank_security_details', 'worker_bank_security_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('student_personal_details', 'student_personal_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('factory_death_manager_details', 'factory_death_manager_details.index_table_id', '=', 'index_tables.id')
            ->leftjoin('courses', 'courses.id', '=', 'index_tables.course_id')
            ->leftjoin('wings', 'wings.id', '=', 'index_tables.wing_id')
            ->get();

        if (count($mainTableCount) > 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                $mainTableCount[] = $val;
            }
        }

        if (count($mainTableCount) > 0) {
            $mynewarray_3__count = $mainTableCount;
            $mainTableCount = array();
            foreach ($mynewarray_3__count as $val) {
                if ($val->file_received_status == 'no') {
                    $mainTableCount[] = $val;
                }
            }
        }

        if (count($mainTableCount) > 0) {
            $newArray = $mainTableCount;
            $mainTableCount = array();

            foreach ($newArray as $val) {
                if ($val->change == 1) {
                    if ($val->follow_up >= $followupDateStart && $val->follow_up <= $followupDateEnd) {
                        $mainTableCount[] = $val;
                    }
                } elseif ($val->change > 1) {
                    if ($val->nextfollowupdate >= $followupDateStart && $val->nextfollowupdate <= $followupDateEnd) {
                        $mainTableCount[] = $val;

                    }
                }
            }
        }

        // dd($mainTableCount);

        $filteredArray = array_map(function ($mainTableCount) {
            unset($mainTableCount['id']);
            unset($mainTableCount['district']);
            unset($mainTableCount['priority_of_submission']);
            unset($mainTableCount['factory_name']);
            unset($mainTableCount['course_id']);
            unset($mainTableCount['course_enrolled_id']);
            unset($mainTableCount['course_registered_id']);
            unset($mainTableCount['affiliated_body_id']);
            unset($mainTableCount['annual_semester_id']);
            unset($mainTableCount['hostel_name']);
            unset($mainTableCount['bus_stop']);
            unset($mainTableCount['wing_id']);
            unset($mainTableCount['transport_facility']);
            unset($mainTableCount['hostel_facility']);
            unset($mainTableCount['claim_status']);
            unset($mainTableCount['seme1']);
            unset($mainTableCount['seme2']);
            unset($mainTableCount['seme3']);
            unset($mainTableCount['seme4']);
            unset($mainTableCount['seme5']);
            unset($mainTableCount['seme6']);
            unset($mainTableCount['seme7']);
            unset($mainTableCount['seme8']);
            unset($mainTableCount['annual1']);
            unset($mainTableCount['annual2']);
            unset($mainTableCount['seme1_result']);
            unset($mainTableCount['seme2_result']);
            unset($mainTableCount['seme3_result']);
            unset($mainTableCount['seme4_result']);
            unset($mainTableCount['seme5_result']);
            unset($mainTableCount['seme6_result']);
            unset($mainTableCount['seme7_result']);
            unset($mainTableCount['seme8_result']);
            unset($mainTableCount['annual1_result']);
            unset($mainTableCount['annual2_result']);
            unset($mainTableCount['course_applied_in']);
            unset($mainTableCount['course_enrolled_name']);
            unset($mainTableCount['course_enrolled_id']);
            unset($mainTableCount['course_registered_id']);
            unset($mainTableCount['course_registered_name']);
            unset($mainTableCount['course_name']);
            unset($mainTableCount['session']);
            unset($mainTableCount['index_table_id']);
            unset($mainTableCount['worker_personal_details_index_table_id']);
            unset($mainTableCount['worker_name']);
            unset($mainTableCount['worker_cnic']);
            unset($mainTableCount['date_of_birth']);
            unset($mainTableCount['factory_name']);
            unset($mainTableCount['factory_registration_number']);
            unset($mainTableCount['worker_name']);
            unset($mainTableCount['worker_cnic']);
            unset($mainTableCount['date_of_birth']);
            unset($mainTableCount['factory_manager_email']);
            unset($mainTableCount['social_security']);
            unset($mainTableCount['worker_bank_security_details_index_table_id']);
            unset($mainTableCount['social_security_office_name']);
            unset($mainTableCount['eobi_number']);
            unset($mainTableCount['name_of_bank']);
            unset($mainTableCount['bank_iban']);
            unset($mainTableCount['factory_card']);
            unset($mainTableCount['student_personal_details_index_table_id']);
            unset($mainTableCount['cnic_no']);
            unset($mainTableCount['date_of_birth']);
            unset($mainTableCount['present_address']);
            unset($mainTableCount['marital_status']);
            unset($mainTableCount['postal_address']);
            unset($mainTableCount['email']);
            unset($mainTableCount['id']);
            unset($mainTableCount['course_code']);
            unset($mainTableCount['change']);
            unset($mainTableCount['family_id']);
            unset($mainTableCount['id']);
            unset($mainTableCount['course_code']);
            unset($mainTableCount['course_name']);
            unset($mainTableCount['short_name']);
            unset($mainTableCount['Family_index_table_id']);
            unset($mainTableCount['receiving_date']);
            unset($mainTableCount['submission_date']);
            unset($mainTableCount['worker_personal_details_index_table_id']);
            unset($mainTableCount['workers_CNIC']);
            unset($mainTableCount['date_of_birth']);
            unset($mainTableCount['potential_degree']);
            unset($mainTableCount['present_address']);
            unset($mainTableCount['course_name']);
            unset($mainTableCount['Family_index_table_id']);
            unset($mainTableCount['worker_personal_details_index_table_id']);
            unset($mainTableCount['factory_registration_date']);
            unset($mainTableCount['factory_manager_name']);
            return $mainTableCount;
        }, $mainTableCount);

        // loop to add --- if any empty data
        for ($i = 0; $i < count($mainTableCount); $i++) {
            if ($mainTableCount[$i]['file_received_number'] == '' || $mainTableCount[$i]['file_received_number'] == null || $mainTableCount[$i]['file_received_number'] == 'null') {
                $mainTableCount[$i]['file_received_number'] = '---';
            } else {
                $mainTableCount[$i]['file_received_number'] = ucfirst($mainTableCount[$i]['file_received_number']);
            }

            if ($mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] == '' || $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] == null || $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] == 'null') {
                $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] = '---';
            } else {
                $mainTableCount[$i]['fresh_file_submission_in_pwwb_number'] = ucfirst($mainTableCount[$i]['fresh_file_submission_in_pwwb_number']);
            }

            if ($mainTableCount[$i]['father_name'] == '' || $mainTableCount[$i]['father_name'] == null || $mainTableCount[$i]['father_name'] == 'null') {
                $mainTableCount[$i]['father_name'] = '---';
            } else {
                $mainTableCount[$i]['father_name'] = ucfirst($mainTableCount[$i]['father_name']);
            }

            if ($mainTableCount[$i]['father_cnic'] == '' || $mainTableCount[$i]['father_cnic'] == null || $mainTableCount[$i]['father_cnic'] == 'null') {
                $mainTableCount[$i]['father_cnic'] = '---';
            } else {
                $mainTableCount[$i]['father_cnic'] = ucfirst($mainTableCount[$i]['father_cnic']);
            }

            if ($mainTableCount[$i]['file_received_status'] == '' || $mainTableCount[$i]['file_received_status'] == null || $mainTableCount[$i]['file_received_status'] == 'null') {
                $mainTableCount[$i]['file_received_status'] = '---';
            } else {
                $mainTableCount[$i]['file_received_status'] = ucfirst($mainTableCount[$i]['file_received_status']);
            }
            if ($mainTableCount[$i]['pwwb_diary_number'] == '' || $mainTableCount[$i]['pwwb_diary_number'] == null || $mainTableCount[$i]['pwwb_diary_number'] == 'null') {
                $mainTableCount[$i]['pwwb_diary_number'] = '---';
            } else {
                $mainTableCount[$i]['pwwb_diary_number'] = ucfirst($mainTableCount[$i]['pwwb_diary_number']);
            }
            if ($mainTableCount[$i]['follow_up'] == '' || $mainTableCount[$i]['follow_up'] == null || $mainTableCount[$i]['follow_up'] == 'null') {
                $mainTableCount[$i]['follow_up'] = '---';
            } else {
                $mainTableCount[$i]['follow_up'] = ucfirst($mainTableCount[$i]['follow_up']);
            }
            if ($mainTableCount[$i]['nextfollowupdate'] == '' || $mainTableCount[$i]['nextfollowupdate'] == null || $mainTableCount[$i]['nextfollowupdate'] == 'null') {
                $mainTableCount[$i]['nextfollowupdate'] = '---';
            } else {
                $mainTableCount[$i]['nextfollowupdate'] = ucfirst($mainTableCount[$i]['nextfollowupdate']);
            }
        }

        $count = WorkerFamilyMemberDetail::where('file_received_status', '=', 'no')->get();
        $recordsTotal = count($count);
        $recordsFiltered = count($mainTableCount);
        $mainTableCount = collect($mainTableCount);
        return $this->exportFollowUpList($mainTableCount);

    }

    public function exportFollowUpList($recordsFiltered)
    {
        return Excel::download(new PwwbFowwowupExportList($recordsFiltered), 'FollowupExportList.xlsx');
    }

    // public function followupslist()
    // {
    //     $rst = IndexTable::select('index_tables.id', 'index_tables.file_received_number', 'index_tables.fresh_file_submission_in_pwwb_number', 'index_tables.pwwb_diary_number', 'worker_personal_details.worker_name', 'worker_personal_details.worker_cnic', 'worker_family_member_details.file_received_status', 'worker_family_member_details.index_table_id AS family_index_table_id')
    //     ->join('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')
    //     ->join('worker_personal_details', 'worker_personal_details.index_table_id', '=', 'index_tables.id')
    //     ->where('worker_family_member_details.file_received_status', '=', 'no')->groupby('family_index_table_id')->get();
    //     return view('pwwb.followupslist', ['list' => $rst]);
    // }

    public function followupslist_json()
    {
        $rst = IndexTable::select()->join('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')->where('file_received_status', '=', 'no')->groupby('index_table_id')->get();
        // return response()->json($rst, 200);
        return response()->json([
            'data' => $rst,
        ], 200);
    }

    public function followupslist_json_search($search)
    {
        $rst = IndexTable::select()->join('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')->where('file_received_status', '=', 'no')->where('file_received_number', 'LIKE', '%' . $search . '%')->groupby('index_table_id')->get();
        // return response()->json($rst, 200);
        return response()->json([
            'data' => $rst,
        ], 200);
    }

    public function nonfollowupslist()
    {
        $rst = IndexTable::select()->join('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')->where('file_received_status', '=', 'yes')->groupby('index_table_id')->get();
        return view('pwwb.nonfollowupslist', ['list' => $rst]);
    }

    public function workerFollowup(Request $request, $id)
    {
        $workerFollowup = WorkerFamilyMemberDetail::whereindex_table_id($id)->wherefile_received_status('no')->get();
        return view('pwwb.worker_followup', ['workerFollowup' => $workerFollowup]);
    }
    public function workerNonFollowup(Request $request, $id)
    {
        $workerFollowup = WorkerFamilyMemberDetail::whereindex_table_id($id)->wherefile_received_status('yes')->get();
        return view('pwwb.worker-nonfollowup', ['workerFollowup' => $workerFollowup]);
    }

    // Eligible List...
    public function eligibleList()
    {
        $rst = IndexTable::selectRaw('*, sum(service_details.total_period) as sum')->join('service_details', 'service_details.index_table_id', '=', 'index_tables.id')->join('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')->groupby('service_details.index_table_id')->get();
        // dd($rst);
        // return view('pwwb.worker-eligible',['workerEligible'=>$rst]);

        // $rst = ServiceDetail::groupby('index_table_id')->selectRaw('*, sum(total_period) as sum')->get();

        return view('pwwb.eligibleList', ['list' => $rst]);
    }
    public function noneligibleList()
    {
        $rst = IndexTable::selectRaw('*, sum(service_details.total_period) as sum')->join('service_details', 'service_details.index_table_id', '=', 'index_tables.id')->join('worker_family_member_details', 'worker_family_member_details.index_table_id', '=', 'index_tables.id')->groupby('service_details.index_table_id')->get();
        // dd($rst);
        // return view('pwwb.worker-eligible',['workerEligible'=>$rst]);

        // $rst = ServiceDetail::groupby('index_table_id')->selectRaw('*, sum(total_period) as sum')->get();

        return view('pwwb.noneligibleList', ['list' => $rst]);
    }

    // Ali Naeem Edit.
    public function checkrifnotexists($data)
    {
        $newridnumber = $data;
        if (IndexTable::where('file_received_number', '=', $newridnumber)->count() > 0) {
            return response()->json($newridnumber . ' Already Exists', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function checkifsidexists($data)
    {
        $newridnumber = $data;
        if (IndexTable::where('fresh_file_submission_in_pwwb_number', '=', $newridnumber)->count() > 0) {
            return response()->json($newridnumber . ' Already Exists', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function edit($index_id)
    {
        $mainObject = IndexTable::find($index_id);
        $object = $mainObject->toArray();
        $object['index_id'] = $mainObject->id;
        $object['worker_family_member_details'] = $mainObject->workerFamilyMemberDetail ? $mainObject->workerFamilyMemberDetail->toArray() : null;
        $object['worker_personal_details'] = $mainObject->workerPersonalDetail ? $mainObject->workerPersonalDetail->toArray() : null;
        $object['worker_contact_numbers'] = $mainObject->workerContactNumber ? $mainObject->workerContactNumber->toArray() : null;
        $object['worker_bank_security_details'] = $mainObject->workerBankSecurityDetail ? $mainObject->workerBankSecurityDetail->toArray() : null;
        $object['factory_details'] = $mainObject->factoryDetail ? $mainObject->factoryDetail->toArray() : null;
        $object['service_details'] = $mainObject->serviceDetail ? $mainObject->serviceDetail->toArray() : null;
        $object['factory_death_manager_details'] = $mainObject->factoryDeathManagerDetail ? $mainObject->factoryDeathManagerDetail->toArray() : null;
        $object['factory_death_manager_detail_contacts'] = $mainObject->FactoryDeathManagerDetailContact ? $mainObject->FactoryDeathManagerDetailContact->toArray() : null;
        $object['student_personal_detail'] = $mainObject->studentPersonalDetail ? $mainObject->studentPersonalDetail->toArray() : null;
        $object['student_contact_numbers'] = $mainObject->StudentContactNumber ? $mainObject->StudentContactNumber->toArray() : null;

        $object['educational_wing_cfe'] = $mainObject->educationalWingCfe ? $mainObject->educationalWingCfe->toArray() : null;
        $object['ims_details'] = $mainObject->imsDetail ? $mainObject->imsDetail->toArray() : null;
        $object['af_details'] = $mainObject->afDetail ? $mainObject->afDetail->toArray() : null;
        $object['bise_details'] = $mainObject->biseDetail ? $mainObject->biseDetail->toArray() : null;
        $object['vti_details'] = $mainObject->vtiDetail ? $mainObject->vtiDetail->toArray() : null;
        $object['dual_course_details'] = $mainObject->dualCourseDetail ? $mainObject->dualCourseDetail->toArray() : null;
        $object['transport_hostel_details'] = $mainObject->transportHotelDetail ? $mainObject->transportHotelDetail->toArray() : null;
        $object['document_attachment_details'] = $mainObject->documentAttachmentDetail ? $mainObject->documentAttachmentDetail->toArray() : null;
        $object['provisional_claim_details'] = $mainObject->provisionalClaimDetail ? $mainObject->provisionalClaimDetail->toArray() : null;
        $object['provisional_claims'] = $mainObject->provisionalClaim ? $mainObject->provisionalClaim->toArray() : null;
        $object['claims'] = $mainObject->claims ? $mainObject->claims->toArray() : null;
        $object['first_annual_details'] = $mainObject->firstAnnualDetail ? $mainObject->firstAnnualDetail->toArray() : null;
        $object['first_annual_result_status_details'] = $mainObject->firstAnnualResultStatusDetail ? $mainObject->firstAnnualResultStatusDetail->toArray() : null;
        $object['second_annual_part_details'] = $mainObject->secondAnnualPartDetail ? $mainObject->secondAnnualPartDetail->toArray() : null;
        $object['second_annual_result_status_details'] = $mainObject->secondAnnualPartResultStatusDetail ? $mainObject->secondAnnualPartResultStatusDetail->toArray() : null;
        $object['first_semester_details'] = $mainObject->firstSemesterDetail ? $mainObject->firstSemesterDetail->toArray() : null;
        $object['first_semester_result_status_details'] = $mainObject->firstSemesterResultStatusDetail ? $mainObject->firstSemesterResultStatusDetail->toArray() : null;
        $object['second_semester_details'] = $mainObject->secondSemesterDetail ? $mainObject->secondSemesterDetail->toArray() : null;
        $object['second_semester_result_status_details'] = $mainObject->secondSemesterResultStatusDetail ? $mainObject->secondSemesterResultStatusDetail->toArray() : null;
        $object['third_semester_details'] = $mainObject->thirdSemesterDetail ? $mainObject->thirdSemesterDetail->toArray() : null;
        $object['third_semester_result_status_details'] = $mainObject->thirdSemesterResultStatusDetail ? $mainObject->thirdSemesterResultStatusDetail->toArray() : null;
        $object['fourth_semester_details'] = $mainObject->fourthSemesterDetail ? $mainObject->fourthSemesterDetail->toArray() : null;
        $object['fourth_semester_result_status_details'] = $mainObject->fourthSemesterResultStatusDetail ? $mainObject->fourthSemesterResultStatusDetail->toArray() : null;
        $object['fifth_semester_details'] = $mainObject->fifthSemesterDetail ? $mainObject->fifthSemesterDetail->toArray() : null;
        $object['fifth_semester_result_status_details'] = $mainObject->fifthSemesterResultStatusDetail ? $mainObject->fifthSemesterResultStatusDetail->toArray() : null;
        $object['sixth_semester_details'] = $mainObject->sixthSemesterDetail ? $mainObject->sixthSemesterDetail->toArray() : null;
        $object['sixth_semester_result_status_details'] = $mainObject->sixthSemesterResultStatusDetail ? $mainObject->sixthSemesterResultStatusDetail->toArray() : null;
        $object['seventh_semester_details'] = $mainObject->seventhSemesterDetail ? $mainObject->seventhSemesterDetail->toArray() : null;
        $object['seventh_semester_result_status_details'] = $mainObject->seventhSemesterResultStatusDetail ? $mainObject->seventhSemesterResultStatusDetail->toArray() : null;
        $object['eighth_semester_details'] = $mainObject->eighthSemesterDetail ? $mainObject->eighthSemesterDetail->toArray() : null;
        $object['eighth_semester_result_status_details'] = $mainObject->eighthSemesterResultStatusDetail ? $mainObject->eighthSemesterResultStatusDetail->toArray() : null;
        $sessions = Session::get();
        $selectedSession = SystemSession::get('selected_session_id');
        $sessionStartEndDate = SessionCourse::where('session_id', '=', $selectedSession)->where('organization_campus_id', '=', SystemSession::get('organization_campus_id'))->first();
        $affiliated_bodies = AffiliatedBody::get();
        $wings = Wing::get();
        $cities = City::get();
        $courseList = Course::get();
//        $object['session'] = $mainObject->Session ? $mainObject->Session->toArray() : null;

//        $sessionDates = ['2019-2021','2021-2023','2023-2025'];
        //        $districtNames = ['RahimYarKhan','Lahore','Attock','Bahawalpur'];

        return view('pwwb.welcome', ['data' => $object, 'sessions' => $sessions, 'selectedSession' => $selectedSession, 'sessions' => $sessions, 'wings' => $wings, 'selectedSession' => $selectedSession, 'affiliated_bodies' => $affiliated_bodies, 'sessionStartEndDate' => $sessionStartEndDate, 'cities' => $cities, 'courseList' => $courseList]);
    }

    public function view($index_id)
    {
        $mainObject = IndexTable::find($index_id);
        $object = $mainObject->toArray();
        $object['index_id'] = $mainObject->id;
        $object['worker_family_member_details'] = $mainObject->workerFamilyMemberDetail ? $mainObject->workerFamilyMemberDetail->toArray() : null;
        $object['worker_personal_details'] = $mainObject->workerPersonalDetail ? $mainObject->workerPersonalDetail->toArray() : null;
        // new
        $object['worker_contact_numbers'] = $mainObject->workerContactNumber ? $mainObject->workerContactNumber->toArray() : null;
        $object['worker_bank_security_details'] = $mainObject->workerBankSecurityDetail ? $mainObject->workerBankSecurityDetail->toArray() : null;
        $object['factory_details'] = $mainObject->factoryDetail ? $mainObject->factoryDetail->toArray() : null;
        $object['service_details'] = $mainObject->serviceDetail ? $mainObject->serviceDetail->toArray() : null;
        $object['factory_death_manager_details'] = $mainObject->factoryDeathManagerDetail ? $mainObject->factoryDeathManagerDetail->toArray() : null;
        $object['factory_death_manager_detail_contacts'] = $mainObject->FactoryDeathManagerDetailContact ? $mainObject->FactoryDeathManagerDetailContact->toArray() : null;
        $object['student_personal_detail'] = $mainObject->studentPersonalDetail ? $mainObject->studentPersonalDetail->toArray() : null;
        $object['student_contact_numbers'] = $mainObject->StudentContactNumber ? $mainObject->StudentContactNumber->toArray() : null;
        // print_r($object['student_contact_numbers']); die();

        $object['educational_wing_cfe'] = $mainObject->educationalWingCfe ? $mainObject->educationalWingCfe->toArray() : null;
        $object['ims_details'] = $mainObject->imsDetail ? $mainObject->imsDetail->toArray() : null;
        $object['af_details'] = $mainObject->afDetail ? $mainObject->afDetail->toArray() : null;
        $object['bise_details'] = $mainObject->biseDetail ? $mainObject->biseDetail->toArray() : null;

        //
        $object['vti_details'] = $mainObject->vtiDetail ? $mainObject->vtiDetail->toArray() : null;
        $object['dual_course_details'] = $mainObject->dualCourseDetail ? $mainObject->dualCourseDetail->toArray() : null;
        $object['transport_hostel_details'] = $mainObject->transportHotelDetail ? $mainObject->transportHotelDetail->toArray() : null;
        $object['document_attachment_details'] = $mainObject->documentAttachmentDetail ? $mainObject->documentAttachmentDetail->toArray() : null;
        $object['provisional_claim_details'] = $mainObject->provisionalClaimDetail ? $mainObject->provisionalClaimDetail->toArray() : null;
        $object['provisional_claims'] = $mainObject->provisionalClaim ? $mainObject->provisionalClaim->toArray() : null;
        $object['claims'] = $mainObject->claims ? $mainObject->claims->toArray() : null;
        $object['first_annual_details'] = $mainObject->firstAnnualDetail ? $mainObject->firstAnnualDetail->toArray() : null;
        $object['first_annual_result_status_details'] = $mainObject->firstAnnualResultStatusDetail ? $mainObject->firstAnnualResultStatusDetail->toArray() : null;
        $object['second_annual_part_details'] = $mainObject->secondAnnualPartDetail ? $mainObject->secondAnnualPartDetail->toArray() : null;
        $object['second_annual_result_status_details'] = $mainObject->secondAnnualPartResultStatusDetail ? $mainObject->secondAnnualPartResultStatusDetail->toArray() : null;
        $object['first_semester_details'] = $mainObject->firstSemesterDetail ? $mainObject->firstSemesterDetail->toArray() : null;
        $object['first_semester_result_status_details'] = $mainObject->firstSemesterResultStatusDetail ? $mainObject->firstSemesterResultStatusDetail->toArray() : null;
        $object['second_semester_details'] = $mainObject->secondSemesterDetail ? $mainObject->secondSemesterDetail->toArray() : null;
        $object['second_semester_result_status_details'] = $mainObject->secondSemesterResultStatusDetail ? $mainObject->secondSemesterResultStatusDetail->toArray() : null;
        // print_r($object['second_semester_result_status_details']); die();
        $object['third_semester_details'] = $mainObject->thirdSemesterDetail ? $mainObject->thirdSemesterDetail->toArray() : null;
        $object['third_semester_result_status_details'] = $mainObject->thirdSemesterResultStatusDetail ? $mainObject->thirdSemesterResultStatusDetail->toArray() : null;
        $object['fourth_semester_details'] = $mainObject->fourthSemesterDetail ? $mainObject->fourthSemesterDetail->toArray() : null;
        $object['fourth_semester_result_status_details'] = $mainObject->fourthSemesterResultStatusDetail ? $mainObject->fourthSemesterResultStatusDetail->toArray() : null;
        $object['fifth_semester_details'] = $mainObject->fifthSemesterDetail ? $mainObject->fifthSemesterDetail->toArray() : null;
        $object['fifth_semester_result_status_details'] = $mainObject->fifthSemesterResultStatusDetail ? $mainObject->fifthSemesterResultStatusDetail->toArray() : null;
        $object['sixth_semester_details'] = $mainObject->sixthSemesterDetail ? $mainObject->sixthSemesterDetail->toArray() : null;
        $object['sixth_semester_result_status_details'] = $mainObject->sixthSemesterResultStatusDetail ? $mainObject->sixthSemesterResultStatusDetail->toArray() : null;
        $object['seventh_semester_details'] = $mainObject->seventhSemesterDetail ? $mainObject->seventhSemesterDetail->toArray() : null;
        $object['seventh_semester_result_status_details'] = $mainObject->seventhSemesterResultStatusDetail ? $mainObject->seventhSemesterResultStatusDetail->toArray() : null;
        $object['eighth_semester_details'] = $mainObject->eighthSemesterDetail ? $mainObject->eighthSemesterDetail->toArray() : null;
        $object['eighth_semester_result_status_details'] = $mainObject->eighthSemesterResultStatusDetail ? $mainObject->eighthSemesterResultStatusDetail->toArray() : null;
        // print_r($object['worker_contact_numbers']);
        //        $sessions = Session::get();

        $session = Session::where('id', '=', $object['session'])->first();
        $city = City::where('id', '=', $object['district'])->first();
        $wing = Wing::where('id', '=', $object['educational_wing_cfe']['educational_wing_cfe'])->first();
        $course = Course::where('id', '=', $object['ims_details']['ims_course_applied_in_cfe'])->first();
        $courseEnrolledIn = Course::where('id', '=', $object['ims_details']['ims_course_enrolled_in_cfe'])->first();
        $courseRegisteredIn = Course::where('id', '=', $object['ims_details']['ims_course_registered'])->first();
        $affiliatedBody = AffiliatedBody::where('id', '=', $object['ims_details']['ims_affiliated_body'])->first();

        //VTI
        $coursev = Course::where('id', '=', $object['vti_details']['vti_diploma_applied_in'])->first();
        $courseEnrolledInv = Course::where('id', '=', $object['vti_details']['vti_diploma_enrolled_in'])->first();
        $courseRegisteredInv = Course::where('id', '=', $object['vti_details']['vti_diploma_registered_in'])->first();
        $affiliatedBodyv = AffiliatedBody::where('id', '=', $object['vti_details']['vti_affiliated_body'])->first();

        // Dual
        $coursevD = Course::where('id', '=', $object['dual_course_details']['course'])->first();
//        $courseEnrolledInvD = Course::where('id', '=', $object['dual_course_details']['vti_diploma_enrolled_in'])->first();
        //        $courseRegisteredInvD = Course::where('id', '=', $object['dual_course_details']['vti_diploma_registered_in'])->first();
        $affiliatedBodyvD = AffiliatedBody::where('id', '=', $object['dual_course_details']['affiliated_body'])->first();

        //CS
        $coursec = Course::where('id', '=', $object['bise_details']['bise_course_applied_in'])->first();
        $courseEnrolledInc = Course::where('id', '=', $object['bise_details']['bise_course_enrolled_cfe'])->first();
        $courseRegisteredInc = Course::where('id', '=', $object['bise_details']['bise_course_registered_in'])->first();
        $affiliatedBodyc = AffiliatedBody::where('id', '=', $object['bise_details']['bise_affiliated_body'])->first();

        //AF
        $coursea = Course::where('id', '=', $object['af_details']['af_course_applied_in'])->first();
        $courseEnrolledIna = Course::where('id', '=', $object['af_details']['af_course_enrolled_in'])->first();
        $courseRegisteredIna = Course::where('id', '=', $object['af_details']['af_course_registered_in'])->first();
        $affiliatedBodya = AffiliatedBody::where('id', '=', $object['af_details']['af_affiliated_body'])->first();

        return view('pwwb.view_pages.view_application', ['data' => $object, 'session_name' => $session, 'city_name' => $city, 'wing' => $wing, 'course' => $course, 'affiliatedBody' => $affiliatedBody, 'courseRegisteredIn' => $courseRegisteredIn, 'courseEnrolledIn' => $courseEnrolledIn, 'coursev' => $coursev, 'affiliatedBodyv' => $affiliatedBodyv, 'courseRegisteredInv' => $courseRegisteredInv, 'courseEnrolledInv' => $courseEnrolledInv, 'coursec' => $coursec, 'affiliatedBodyc' => $affiliatedBodyc, 'courseRegisteredInc' => $courseRegisteredInc, 'courseEnrolledInc' => $courseEnrolledInc, 'coursea' => $coursea, 'affiliatedBodya' => $affiliatedBodya, 'courseRegisteredIna' => $courseRegisteredIna, 'courseEnrolledIna' => $courseEnrolledIna, 'coursevD' => $coursevD, 'affiliatedBodyvD' => $affiliatedBodyvD]);
    }

    // Ali Naeem Edit.
    public function delete($index_id)
    {
        // Delete From All Tables As per The Id.

//         $res = IndexTable::where('id', $index_id)->delete();
//         $res = workerFamilyMemberDetail::where('index_table_id', $index_id)->delete();
//         $res = workerPersonalDetail::where('index_table_id', $index_id)->delete();
//         $res = workerContactNumber::where('index_table_id', $index_id)->delete();
//         $res = workerBankSecurityDetail::where('index_table_id', $index_id)->delete();
//         $res = factoryDetail::where('index_table_id', $index_id)->delete();
//         $res = factoryDeathManagerDetail::where('index_table_id', $index_id)->delete();
//         $res = FactoryDeathManagerDetailContact::where('index_table_id', $index_id)->delete();
//         $res = studentPersonalDetail::where('index_table_id', $index_id)->delete();
//         $res = StudentContactNumber::where('index_table_id', $index_id)->delete();
//         $res = educationalWingCfe::where('index_table_id', $index_id)->delete();
//         $res = imsDetail::where('index_table_id', $index_id)->delete();
//         $res = afDetail::where('index_table_id', $index_id)->delete();
//         $res = biseDetail::where('index_table_id', $index_id)->delete();
//         $res = vtiDetail::where('index_table_id', $index_id)->delete();
//         $res = dualCourseDetail::where('index_table_id', $index_id)->delete();
// //        $res=transportHotelDetail::where('index_table_id',$index_id)->delete();
//         $res = documentAttachmentDetail::where('index_table_id', $index_id)->delete();
//         $res = firstAnnualDetail::where('index_table_id', $index_id)->delete();
//         $res = provisionalClaimDetail::where('index_table_id', $index_id)->delete();
//         $res = provisionalClaim::where('index_table_id', $index_id)->delete();
//         $res = firstAnnualResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = secondAnnualPartDetail::where('index_table_id', $index_id)->delete();
//         $res = secondAnnualPartResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = firstSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = firstSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = secondSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = secondSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = thirdSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = thirdSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = fourthSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = fourthSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = fifthSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = fifthSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = sixthSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = sixthSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = seventhSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = seventhSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $res = eighthSemesterDetail::where('index_table_id', $index_id)->delete();
//         $res = eighthSemesterResultStatusDetail::where('index_table_id', $index_id)->delete();
//         $mainTable = IndexTable::all();
         $returnFilePwwb = IndexTable::where('id', $index_id)->update([
            'return_file_pwwb' => 1,
        ]);
        return redirect()->route('pwwb.records');
    }

    public function pwwbfollowupstore(Request $request)
    {
        $organizationCampusId = SystemSession::get('organization_campus_id');
        $sessionId = SystemSession::get('selected_session_id');
        $familyMaxID = '';
        $input = $request->all();
        $family = WorkerFamilyMemberDetail::find($input['family_id']);
        $changeMax = workerFamilyMemberDetail::where('family_id', '=', $input['family_id'])->orderBy('change', 'desc')->first();
        if ($changeMax > 0) {
            $familyMaxID = $changeMax->change;
        } else {
            $newChange = workerFamilyMemberDetail::where('index_table_id', '=', $input['family_id'])->orderBy('change', 'desc')->first();
            $familyMaxID = $newChange->change;
        }

        if ($familyMaxID == '0' || $familyMaxID == 0 || $familyMaxID == null) {
            $familyMaxID = 0;
        } elseif ($familyMaxID > 0) {
            $familyMaxID = $familyMaxID++;
        }

        $familyFollowup = [
            'worker_name' => $input['worker_name'],
            'serial_no' => $input['serial_no'],
            'worker_cnic' => $input['worker_cnic'],
            'student_name' => $input['student_name'],
            'potential_degree' => $input['potential_degree'],
            'follow_up' => $input['follow_up'],
            'follow_up_status' => $input['follow_up_status'],
            'index_table_id' => $input['index_table_id'],
            'family_id' => $input['family_id'],
            'callby' => $input['called_by'],
            'callstatus' => $input['call_status'],
            'status' => $input['status'],
            'answeredby' => $input['answered_by'],
            'attendantrelationship' => $input['student_relationship_with_attendant'],
            'followupranking' => $input['interest_level_id'],
            'nextfollowupdate' => $input['next_date'],
            'remarks' => $input['remarks'],
            'file_received_status' => 'no',
            'organization_campus_id' => $organizationCampusId,
            'session_id' => $sessionId,
            'change' => $familyMaxID,
        ];
        $saveNewFamilyDetail = new WorkerFamilyMemberDetail();
        $saveNewFamilyDetail->worker_name = $input['worker_name'];
        $saveNewFamilyDetail->serial_no = $input['serial_no'];
        $saveNewFamilyDetail->worker_cnic = $input['worker_cnic'];
        $saveNewFamilyDetail->student_name = $input['student_name'];
        $saveNewFamilyDetail->potential_degree = $input['potential_degree'];
        $saveNewFamilyDetail->file_received_status = $input['file_received_status'];
        $saveNewFamilyDetail->follow_up = $input['follow_up'];
        $saveNewFamilyDetail->follow_up_status = $input['follow_up_status'];
        $saveNewFamilyDetail->index_table_id = $input['index_table_id'];
        $saveNewFamilyDetail->family_id = $input['family_id'];
        $saveNewFamilyDetail->callby = $input['called_by'];
        $saveNewFamilyDetail->callstatus = $input['call_status'];
        $saveNewFamilyDetail->status = $input['status'];
        $saveNewFamilyDetail->answeredby = $input['answered_by'];
        $saveNewFamilyDetail->attendantrelationship = $input['student_relationship_with_attendant'];
        $saveNewFamilyDetail->followupranking = $input['interest_level_id'];
        $saveNewFamilyDetail->nextfollowupdate = $input['next_date'];
        $saveNewFamilyDetail->remarks = $input['remarks'];
        $saveNewFamilyDetail->organization_campus_id = $organizationCampusId;
        $saveNewFamilyDetail->session_id = $sessionId;
        $saveNewFamilyDetail->change = $familyMaxID;
        $saveNewFamilyDetail->save($familyFollowup);
        // $familyFollowup->save();
        return redirect()->back();

    }

    public function selectCampus($id)
    {
        // One Way Of Updating Campus Id...
        // $campus_id = SystemSession::get('organization_campus_id');
        // $updateOrganizationCampusId=IndexTable::find($id)->update(
        //     ['organization_campus_id' => $campus_id]
        // );

        // Second way of updating Camous id...
        $data = IndexTable::where('id', '=', $id)->first();
        // $campus_id = SystemSession::get('organization_campus_id');
        // $organization_campus_data = OrganizationCampus::where('id', '=', $campus_id)->first();
        $organization_campus_data = OrganizationCampus::get();
        return view('pwwb.selectCampus_page', ['data' => $data, 'organization_campus_data' => $organization_campus_data]);
    }

    public function setCampus(request $request)
    {
        $updateOrganizationCampusId = IndexTable::where('id', '=', $request['index_table_id'])->update(
            ['organization_campus_id' => $request['organization_campus_id']]
        );
        return redirect()->route('pwwb.records');
    }

    public function woerkCNICAlert($data)
    {
        $newridnumber = $data;
        if (WorkerPersonalDetail::where('worker_cnic', '=', $newridnumber)->count() > 0) {
            return response()->json('(' . $newridnumber . ') ' . ' Worker CNIC Exists', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function CNICNoAlert($data)
    {
        $newridnumber = $data;
        if (StudentPersonalDetail::where('cnic_no', '=', $newridnumber)->count() > 0) {
            return response()->json('(' . $newridnumber . ') ' . ' Student CNIC Exists', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function workerCNICFamilyAlert($data)
    {
        $newridnumber = $data;
        if (WorkerFamilyMemberDetail::where('worker_cnic', '=', $newridnumber)->count() > 0) {
            return response()->json('(' . $newridnumber . ') ' . ' CNIC has been used in previous files.', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function workersContactNumberAlert($data)
    {
        $newridnumber = $data;
        if (WorkerContactNumber::where('contact_no', '=', $newridnumber)->count() > 0) {
            return response()->json('(' . $newridnumber . ') ' . ' Contact has been used in previous files.', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function factoryManagerContactNoAlert($data)
    {
        $newridnumber = $data;
        if (FactoryDeathManagerDetailContact::where('contact_number', '=', $newridnumber)->count() > 0) {
            return response()->json('(' . $newridnumber . ') ' . ' Contact has been used in previous files.', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function studetnPersonalContactNoAlert($data)
    {
        $newridnumber = $data;
        if (StudentContactNumber::where('contact_no', '=', $newridnumber)->count() > 0) {
            return response()->json('(' . $newridnumber . ') ' . ' Contact has been used in previous files.', 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function getDataAgainstFileReceivedNumber($data)
    {
        $fileReceivedNumber = $data;

        $data = Enquiry::where('file_received_number', '=', $fileReceivedNumber)->first();
        if (Enquiry::where('file_received_number', '=', $fileReceivedNumber)->count() > 0) {
            return response()->json($data, 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function getEnquiryFollowupsList($data)
    {
        $parentId = $data;
        $data = Enquiry::where('parent_id', '=', $parentId)->orderBy('id', 'Asc')->get();
        $response = array('output' => $data);
        if (Enquiry::where('parent_id', '=', $parentId)->count() > 0) {
            return response()->json($response, 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function getStudentContactsInfos($data)
    {
        $enquiryId = $data;
        $data = EnquiryContactInfo::where('enquiry_id', '=', $enquiryId)->orderBy('id', 'Asc')->get();
        $response = array('output' => $data);
        // dd($response);
        // dd(count($data));
        if (EnquiryContactInfo::where('enquiry_id', '=', $enquiryId)->count() > 0) {
            return response()->json($response, 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function getEnquiryFactoryFollowupsList($data)
    {
        $enquiryId = $data;
        $data = EnquiryWorker::where('enquiry_id', '=', $enquiryId)->orderBy('id', 'Asc')->get();
        $response = array('output' => $data);
        if (EnquiryWorker::where('enquiry_id', '=', $enquiryId)->count() > 0) {
            return response()->json($response, 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function getEducationalWingFollowupsList($data)
    {
        $courseId = $data;
        $data = Course::where('id', '=', $courseId)->first();
        if (Course::where('id', '=', $courseId)->count() > 0) {
            return response()->json($data, 200);
        } else {
            return response()->json('', 200);
        }
    }

    public function move($id)
    {
        $update = IndexTable::where('id', $id)->update([
            'is_dsm' => 1,
        ]);
        return redirect()->route('pwwb.records');
    }

    public function bonifiedCertificate($id){
        // $StudentData = StudentPersonalDetail::where('index_table_id', $id)->get();
        $studentData = IndexTable::with('studentPersonalDetail')->with('admissionPWWB')->where('id', $id)->first();
        $pdf = PDF::loadView('pwwb.bonified_certificate_pdf', ['studentData' => $studentData]);  
        // return $pdf->download('bonified_certificate_pdf_'.$id.'.pdf');
        return $pdf->stream();
    }

    public function admissionOfferLetter($id){
        $students = IndexTable::with('studentPersonalDetail')->with('admissionPWWB')->where('id', $id)->first();
        $studentFatherContact = StudentContactNumber::where('student_contact_relationship', 'father')->where('index_table_id', $id)->first();
        $claims = Claim::where('index_table_id', $id)->where('page_number', '=', '14')->get();        
        // dd($studentFatherContact->contact_no);
        $pdf = PDF::loadView('pwwb.admission_offer_letter_pdf', ['students' => $students, 'studentFatherContact'=> $studentFatherContact, 'claims' => $claims]);  
        // return $pdf->download('admission_offer_letter_pdf_'.$id.'.pdf');
        return $pdf->stream();
    }
    public function claimLetter($id){
        $students = IndexTable::with('studentPersonalDetail')->with('admissionPWWB')->where('id', $id)->first();
        $claims = Claim::where('index_table_id', $id)->where('page_number', '=', '14')->get();        
        $factoryName = FactoryDetail::where('index_table_id', $id)->first();
        // return $students;
        $pdf = PDF::loadView('pwwb.claim_letter_pdf', ['students' => $students, 'claims' => $claims, 'factoryName' => $factoryName]);  
        // return $pdf->download('claim_letter_pdf_'.$id.'.pdf');
        return $pdf->stream();
    }


}
