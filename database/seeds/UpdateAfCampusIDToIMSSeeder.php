<?php

use App\Models\AcademicRecord;
use App\Models\Admission;
use App\Models\AdmissionByEnquiryForm;
use App\Models\AdmissionByPwwbForm;
use App\Models\Enquiry;
use App\Models\EnquiryFollowup;
use App\Models\FeePackage;
use App\Models\FeePackageInstallment;
use App\Models\Pwwb\IndexTable;
use App\Models\Student;
use App\Models\StudentAcademicHistory;
use App\Models\StudentAttachment;
use App\Models\StudentInstallmentPlan;
use App\Models\StudentRegistration;
use App\Models\StudentWorker;
use App\Models\SystemRollNumber;
use Illuminate\Database\Seeder;

class UpdateAfCampusIDToIMSSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Enquiry::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        EnquiryFollowup::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        AdmissionByEnquiryForm::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        Admission::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        AdmissionByPwwbForm::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        IndexTable::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);

        Student::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        StudentAcademicHistory::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        AcademicRecord::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        StudentAttachment::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        StudentInstallmentPlan::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        StudentRegistration::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        StudentWorker::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        SystemRollNumber::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        FeePackage::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
        FeePackageInstallment::where('organization_campus_id', 1)->update(['organization_campus_id' => 3]);
    }
}
