<?php

namespace App\Exports\Pwwbs;

use App\Http\Controllers\Pwwb\PwwbHomeController;
use App\Models\Pwwb\IndexTable;
use App\Models\Pwwb\StudentContactNumber;
use Illuminate\Support\Facades\Config;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Illuminate\Support\Collection;
use App\Models\Admission;

class PwwbListExport implements FromCollection, WithStrictNullComparison, WithHeadings, ShouldAutoSize
{   
    private $recordsFiltered;
    public function __construct($recordsFiltered){
        $this->recordsFiltered = $recordsFiltered;
        // dd($this->recordsFiltered);
    }
 public $column_name = [        
        'district' => 'District',
        'district_other' => 'District Other',
        'priority_of_submission' => 'Priority Of Submission',
        'file_received_number' => 'File Received Number',
        'file_module_number' => 'File Module Number',
        'fresh_file_submission_in_pwwb_number' => 'Fresh File Submission Number',
        'receiving_date' => 'Receiving Date',
        'submission_date' => 'Submission Date',
        'file_receipt_voucher_number' => 'File Receipt Voucher Number',
        'file_receipt_voucher_date' => 'File Receipt Voucher Date',
        'pwwb_diary_number' => 'Diary Number',
        'pwwb_diary_date' => 'Diary Date',
        'pending_files_with_remarks' => 'Pending Files With Remarks',
        'admitted' => 'Admitted',
        // 'wing_id' => 'Wing ID',
        // 'course_id' => 'Course Applied In',
        // 'affiliated_body_id' => 'Affiliated Body ID',
        // 'annual_semester_id' => 'Annual Semester ID',
        // 'course_registered_id' => 'Course Registered In',
        // 'course_enrolled_id' => 'Course Enrolled In',
        'eobi_number' => 'EOBI Number',
        'social_security' => 'social Security',
        'affiliated_body_id' => 'Affiliated Body',
        'course_name' => 'Course Applied Name',
        'course_enrolled_name' => 'Course enrolled In Name',
        'course_registered_name' => 'Course Registered In Name',
        'worker_name' =>'Worker Name',
        'worker_cnic' =>'Worker CNIC',
        'photograph_uploaded' =>'Photograph Uploaded',
        'photograph_attested' =>'Photograph Attested',
        'photograph_quantity' =>'Photograph Quantity',
        'applicant_name' =>'Applicant Name',
        'worker_cnic_attested' =>'Worker CNIC Attested',
        'worker_current_status' =>'Worker Current Status',
        'worker_job_nature' =>'Worker Job Nature',
        'factory_status' =>'Factory Status',
        'worker_relationship' =>'Worker Relationship',
        'specify_relationship' =>'Specify Relationship',
        'date_of_birth' =>'D.O.B',
        'pwwb_scholarship_form' =>'PWWB Scholarship Form',
        'factory_card' =>'Factory Card',
        'service_letter' =>'Service Letter',

        'factory_name' => 'Factory Name',
        'factory_address' => 'Factory Address',
        'factory_registration_number' => 'Factory Registration Number',
        'factory_registration_date' => 'Factory Registration Date',
        'factory_registration_certificate_attested_by_manager' => 'Factory Registration Certificate Attested By Manager',
        'factory_registration_certificate_attested_by_officer' => 'Factory Registration Certificate Attested By Officer',
        'factory_registration_certificate_attested_by_director' => 'Factory Registration Certificate Attested By Director',
        'signature_of_worker' => 'Signature Of Worker',
        'date_of_submission' => 'Date Of Submission',
        'name' => 'Studen Name',
        'cnic_no' => 'Student CNIC',
        'father_name' => 'Father Name',
        'quantity' => 'Quantity',
        'student_cnic_attested' => 'Student CNIC Attested',
        // 'date_of_birth' => 'D.O.B',
        'present_address' => 'Present Address',
        'marital_status' => 'Marital Status',
        'postal_address' => 'Postal Address',
        'email' => 'Email',
        'signature' => 'Signature',
        'bus_stop' => 'Bus Stop',
        'hostel_name' => 'Hostel Name',
        'hostel_facility' => 'Hostel Facility',
        'transport_facility' => 'Transport Facility',
        'address' => 'Address',
        'manager_name' => 'Manager Name',
        'manager_contact' => 'Manager Contact',
        // 'claim_status' => 'Claim Status',
        // 'serial_no' => 'Serial No',
        // 'claim_due' => 'Claim Due',
        // 'type_of_claim' => 'Type Of Claim',
        // 'type_of_claim_other' => 'Type Of Claim Other',
        // 'claim_received' => 'Claim Received',
        // 'claim_date' => 'Claim Date',
        // 'reason' => 'Reason',
        // 'cfe_fee' => 'Cfe Fee',
        // 'recovery_from_student' => 'Recovery From Student',

        'seme1' => 'Semester 1', 
        'seme1_result' => 'Semester 1 Result', 
        'seme1_fail' => 'Semester 1 Fail', 
        'seme1_next_appearance' => 'Semester 1 Next Appearance', 
        'sem1_next_appearance_date' => 'Semester 1 Next Appearance Date', 
        'seme1_last_chance_date' => 'Semester 1 Last Chance Date', 
        'seme1_passing_date' => 'Semester 1 Passing Date', 

        'seme2' => 'Semester 2', 
        'seme2_result' => 'Semester 2 Result', 
        'seme2_fail' => 'Semester 2 Fail', 
        'seme2_next_appearance' => 'Semester 2 Next Appearance', 
        'sem2_next_appearance_date' => 'Semester 2 Next Appearance Date', 
        'seme2_last_chance_date' => 'Semester 2 Last Chance Date', 
        'seme2_passing_date' => 'Semester 2 Passing Date', 

        'seme3' => 'Semester 3', 
        'seme3_result' => 'Semester 3 Result', 
        'seme3_fail' => 'Semester 3 Fail', 
        'seme3_next_appearance' => 'Semester 3 Next Appearance', 
        'seme3_next_appearance_date' => 'Semester 3 Next Appearance Date', 
        'seme3_last_chance_date' => 'Semester 3 Last Chance Date', 
        'seme3_passing_date' => 'Semester 3 Passing Date', 

        'seme4' => 'Semester 4', 
        'seme4_result' => 'Semester 4 Result', 
        'seme4_fail' => 'Semester 4 Fail', 
        'seme4_next_appearance' => 'Semester 4 Next Appearance', 
        'seme4_next_appearance_date' => 'Semester 4 Next Appearance Date', 
        'seme4_last_chance_date' => 'Semester 4 Last Chance Date', 
        'seme4_passing_date' => 'Semester 4 Passing Date', 
        
        'seme5' => 'Semester 5', 
        'seme5_result' => 'Semester 5 Result', 
        'seme5_fail' => 'Semester 5 Fail', 
        'seme5_next_appearance' => 'Semester 5 Next Appearance', 
        'seme5_next_appearance_date' => 'Semester 5 Next Appearance Date', 
        'seme5_last_chance_date' => 'Semester 5 Last Chance Date', 
        'seme5_passing_date' => 'Semester 5 Passing Date', 

        'seme6' => 'Semester 6', 
        'seme6_result' => 'Semester 6 Result', 
        'seme6_fail' => 'Semester 6 Fail', 
        'seme6_next_appearance' => 'Semester 6 Next Appearance', 
        'seme6_next_appearance_date' => 'Semester 6 Next Appearance Date', 
        'seme6_last_chance_date' => 'Semester 6 Last Chance Date', 
        'seme6_passing_date' => 'Semester 6 Passing Date', 

        'seme7' => 'Semester 7', 
        'seme7_result' => 'Semester 7 Result', 
        'seme7_fail' => 'Semester 7 Fail', 
        'seme7_next_appearance' => 'Semester 7 Next Appearance', 
        'seme7_next_appearance_date' => 'Semester 7 Next Appearance Date', 
        'seme7_last_chance_date' => 'Semester 7 Last Chance Date', 
        'seme7_passing_date' => 'Semester 7 Passing Date', 

        'seme8' => 'Semester 8', 
        'seme8_result' => 'Semester 8 Result', 
        'seme8_fail' => 'Semester 8 Fail', 
        'seme8_next_appearance' => 'Semester 8 Next Appearance', 
        'seme8_next_appearance_date' => 'Semester 8 Next Appearance Date', 
        'seme8_last_chance_date' => 'Semester 8 Last Chance Date', 
        'seme8_passing_date' => 'Semester 8 Passing Date', 

        'annual1' => 'Annual 1', 
        'annual1_result' => 'Annual 1 Result', 
        'annual1_fail' => 'Annual 1 Fail', 
        'annual1_next_appearance' => 'Annual 1 Next Appearance', 
        'annual1_next_appearance_date' => 'Annual 1 Next Appearance Date', 
        'annual1_last_chance_date' => 'Annual 1 Last Chance Date', 
        'annual1_passing_date' => 'Annual 1 Passing Date', 
        
        'annual2' => 'Annual 1', 
        'annual2_result' => 'Annual 1 Result', 
        'annual2_fail' => 'Annual 1 Fail', 
        'annual2_next_appearance' => 'Annual 1 Next Appearance', 
        'annual2_next_appearance_date' => 'Annual 1 Next Appearance Date', 
        'annual2_last_chance_date' => 'Annual 1 Last Chance Date', 
        'annual2_passing_date' => 'Annual 1 Passing Date',
        'self_contact' => 'Self Contact 1',
        'self_coontact_2' => 'Self Contact 2',
        'self_coontact_3' => 'Self Contact 3',
        'father_contact' => 'Father Contact',
        'mother_coontact' => 'Mother Contact',
        'guardian_coontact' => 'Guardian Contact',
        'shift' => 'Shift',
        'worker_joining' => 'Worker Joining Date',
        'dual_course' => 'Dual Course',
        'dual_shift' => 'Dual Course Shift',
        'roll_no' => 'Roll Number',
        // 'scheme_of_study' => 'Dual Course Study Sceme',

    ];
     
    public function headings(): array
    {
        return $this->column_name;
    }

    public function collection()
    {

        foreach ($this->recordsFiltered as $val) {
            // dd($val->id);
        }

        // dD($this->recordsFiltered);
        return $this->recordsFiltered;
        
    }
}
