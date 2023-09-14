<?php

namespace App\Models\Pwwb;

use App\Fields\FourthSemesterResultStatusDetailFields;
use Illuminate\Database\Eloquent\Model;
use App\Models\Course;
use OwenIt\Auditing\Contracts\Auditable;

class IndexTable extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $appends = ['self_contact', 'father_contact', 'course_applied_in', 'course_enrolled_in', 'course_registered_in', 'previous_degree'];

    protected $guarded = [];

    public function getSelfContactAttribute(){
        $numbers = StudentContactNumber::where('index_table_id', $this->id)->where('student_contact_relationship', 'self')->get();
        if ($numbers->isEmpty()){
            return '---';
        }
        return $numbers->first()->contact_no;
    }

    public function getFatherContactAttribute(){
        $numbers = StudentContactNumber::where('index_table_id', $this->id)->where('student_contact_relationship', 'father')->get();
        if ($numbers->isEmpty()){
            return '---';
        }
        return $numbers->first()->contact_no;
    }
    public function getCourseAppliedInAttribute(){
        $wing = $this->wing_id;
        if ($wing == 1) {
            $af_detail = AfDetail::where('index_table_id', $this->id)->get();
            if (!$af_detail->isEmpty()) {
                $af_detail = $af_detail->first();
                return isset($af_detail->af_course_applied_in)?Course::find($af_detail->af_course_applied_in)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 2) {
            $bise_detail = BiseDetail::where('index_table_id', $this->id)->get();
            if (!$bise_detail->isEmpty()) {
                $bise_detail = $bise_detail->first();
                return isset($bise_detail->bise_course_applied_in)?Course::find($bise_detail->bise_course_applied_in)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 3) {
            $ims_detail = ImsDetail::where('index_table_id', $this->id)->get();
            if (!$ims_detail->isEmpty()) {
                $ims_detail = $ims_detail->first();
                return isset($ims_detail->ims_course_applied_in_cfe)?Course::find($ims_detail->ims_course_applied_in_cfe)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 4) {
            $vti_detail = VtiDetail::where('index_table_id', $this->id)->get();
            if (!$vti_detail->isEmpty()) {
                $vti_detail = $vti_detail->first();
                return isset($vti_detail->vti_diploma_applied_in)?Course::find($vti_detail->vti_diploma_applied_in)->name:'---';
            } else {
                return '---';
            }
        }
    }
    public function getCourseEnrolledInAttribute(){
        $wing = $this->wing_id;
        if ($wing == 1) {
            $af_detail = AfDetail::where('index_table_id', $this->id)->get();
            if (!$af_detail->isEmpty()) {
                $af_detail = $af_detail->first();
                return isset($af_detail->af_course_enrolled_in)?Course::find($af_detail->af_course_enrolled_in)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 2) {
            $bise_detail = BiseDetail::where('index_table_id', $this->id)->get();
            if (!$bise_detail->isEmpty()) {
                $bise_detail = $bise_detail->first();
                return isset($bise_detail->bise_course_enrolled_cfe)?Course::find($bise_detail->bise_course_enrolled_cfe)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 3) {
            $ims_detail = ImsDetail::where('index_table_id', $this->id)->get();
            if (!$ims_detail->isEmpty()) {
                $ims_detail = $ims_detail->first();
                return isset($ims_detail->ims_course_enrolled_in_cfe)?Course::find($ims_detail->ims_course_enrolled_in_cfe)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 4) {
            $vti_detail = VtiDetail::where('index_table_id', $this->id)->get();
            if (!$vti_detail->isEmpty()) {
                $vti_detail = $vti_detail->first();
                return isset($vti_detail->vti_diploma_enrolled_in)?Course::find($vti_detail->vti_diploma_enrolled_in)->name:'---';
            } else {
                return '---';
            }
        }
    }
    public function getCourseRegisteredInAttribute(){
        $wing = $this->wing_id;
        if ($wing == 1) {
            $af_detail = AfDetail::where('index_table_id', $this->id)->get();
            if (!$af_detail->isEmpty()) {
                $af_detail = $af_detail->first();
                return isset($af_detail->af_course_registered_in)?Course::find($af_detail->af_course_registered_in)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 2) {
            $bise_detail = BiseDetail::where('index_table_id', $this->id)->get();
            if (!$bise_detail->isEmpty()) {
                $bise_detail = $bise_detail->first();
                return isset($bise_detail->bise_course_registered_in)?Course::find($bise_detail->bise_course_registered_in)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 3) {
            $ims_detail = ImsDetail::where('index_table_id', $this->id)->get();
            if (!$ims_detail->isEmpty()) {
                $ims_detail = $ims_detail->first();
                return isset($ims_detail->ims_course_registered)?Course::find($ims_detail->ims_course_registered)->name:'---';
            } else {
                return '---';
            }
        }
        if ($wing == 4) {
            $vti_detail = VtiDetail::where('index_table_id', $this->id)->get();
            if (!$vti_detail->isEmpty()) {
                $vti_detail = $vti_detail->first();
                return isset($vti_detail->vti_diploma_registered_in)?Course::find($vti_detail->vti_diploma_registered_in)->name:'---';
            } else {
                return '---';
            }
        }
    }

    public function getPreviousDegreeAttribute(){
        $wing = $this->wing_id;
        $details = [];
        if ($wing == 1) {
            $af_detail = AfDetail::where('index_table_id', $this->id)->get();
            if (!$af_detail->isEmpty()) {
                $data = $af_detail->first();
                $details = [
                    'board_university'  => $data->af_board_university,
                    'previous_course'   => $data->af_previous_course,
                    'previous_roll_no'  => $data->af_previous_roll_no,
                    'previous_passing_date'   => date('Y', strtotime($data->af_previous_passing_date)),
                    'previous_total_marks'    => $data->af_previous_total_marks,
                    'previous_marks_obtained' => $data->af_previous_marks_obtained,
                    'previous_percentage' => $data->af_previous_percentage,
                    'previous_cgpa'       => $data->af_previous_cgpa,
                ];
            } else {
                return '---';
            }
        } elseif ($wing == 2) {
            $bise_detail = BiseDetail::where('index_table_id', $this->id)->get();
            if (!$bise_detail->isEmpty()) {
                $data = $bise_detail->first();
                $details = [
                    'board_university'  => $data->bise_board_university,
                    'previous_course'   => $data->bise_previous_course,
                    'previous_roll_no'  => $data->bise_previous_roll_no,
                    'previous_passing_date'   => date('Y', strtotime($data->bise_previous_passing_date)),
                    'previous_total_marks'    => $data->bise_previous_total_marks,
                    'previous_marks_obtained' => $data->bise_previous_marks_obtained,
                    'previous_percentage' => $data->bise_previous_percentage,
                    'previous_cgpa'       => $data->bise_previous_cgpa,
                ];
            } else {
                return '---';
            }
        } elseif ($wing == 3) {
            $ims_detail = ImsDetail::where('index_table_id', $this->id)->get();
            if (!$ims_detail->isEmpty()) {
                $data = $ims_detail->first();
                $details = [
                    'board_university'  => $data->ims_board_university,
                    'previous_course'   => $data->ims_previous_course,
                    'previous_roll_no'  => $data->ims_previous_roll_no,
                    'previous_passing_date'   => date('Y', strtotime($data->ims_previous_passing_date)),
                    'previous_total_marks'    => $data->ims_previous_total_marks,
                    'previous_marks_obtained' => $data->ims_previous_marks_obtained,
                    'previous_percentage' => $data->ims_previous_percentage,
                    'previous_cgpa'       => $data->ims_previous_cgpa,
                ];
            } else {
                return '---';
            }
        } elseif ($wing == 4) {
            $vti_detail = VtiDetail::where('index_table_id', $this->id)->get();
            if (!$vti_detail->isEmpty()) {
                $data = $vti_detail->first();
                $details = [
                    'board_university'  => $data->vti_board_university,
                    'previous_course'   => $data->vti_previous_course,
                    'previous_roll_no'  => $data->vti_previous_roll_no,
                    'previous_passing_date'   => date('Y', strtotime($data->vti_previous_passing_date)),
                    'previous_total_marks'    => $data->vti_previous_total_marks,
                    'previous_marks_obtained' => $data->vti_previous_marks_obtained,
                    'previous_percentage' => $data->vti_previous_percentage,
                    'previous_cgpa'       => $data->vti_previous_cgpa,
                ];
            } else {
                return '---';
            }
        } else {
            return '----';
        }
        return $details;
    }

    public function workerFamilyMemberDetail(){
        return $this->hasMany(WorkerFamilyMemberDetail::class);
    }

    public function workerPersonalDetail(){
        return $this->hasOne(WorkerPersonalDetail::class);
    }

    public function workerBankSecurityDetail(){
        return $this->hasOne(WorkerBankSecurityDetail::class);
    }

    public function serviceDetail(){
        return $this->hasMany(ServiceDetail::class);
    }

    public function factoryDetail(){
        return $this->hasOne(FactoryDetail::class);
    }

    public function factoryDeathManagerDetail(){
        return $this->hasOne(FactoryDeathManagerDetail::class);
    }

    public function studentPersonalDetail(){
        return $this->hasOne(StudentPersonalDetail::class);
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function educationalWingCfe(){
        return $this->hasOne(EducationalWingCfe::class);
    }

    public function afDetail(){
        return $this->hasOne(AfDetail::class);
    }

    public function biseDetail(){
        return $this->hasOne(BiseDetail::class);
    }

    public function imsDetail(){
        return $this->hasOne(ImsDetail::class);
    }

    public function vtiDetail(){
        return $this->hasOne(VtiDetail::class);
    }

    public function dualCourseDetail(){
        return $this->hasOne(DualCourseDetail::class);
    }

    public function transportHotelDetail(){
        return $this->hasOne(TransportHostelDetail::class);
    }

    public function documentAttachmentDetail(){
        return $this->hasOne(DocumentAttachmentDetail::class);
    }

    public function provisionalClaimDetail(){
        return $this->hasOne(ProvisionalClaimDetail::class);
    }

    public function claims(){
        return $this->hasMany(Claim::class);
    }

    public function firstAnnualDetail(){
        return $this->hasOne(FirstAnnualDetail::class);
    }

    public function firstAnnualResultStatusDetail(){
        return $this->hasMany(FirstAnnualResultStatusDetail::class);
    }

    public function secondAnnualPartDetail(){
        return $this->hasOne(SecondAnnualPartDetail::class);
    }

    public function secondAnnualPartResultStatusDetail(){
        return $this->hasMany(SecondAnnualPartResultStatusDetail::class);
    }

    public function firstSemesterDetail(){
        return $this->hasOne(FirstSemesterDetail::class);
    }

    public function firstSemesterResultStatusDetail(){
        return $this->hasMany(FirstSemesterResultStatusDetail::class);
    }

    public function secondSemesterDetail(){
        return $this->hasOne(SecondSemesterDetail::class);
    }

    public function secondSemesterResultStatusDetail(){
        return $this->hasMany(SecondSemesterResultStatusDetail::class);
    }

    public function thirdSemesterDetail(){
        return $this->hasOne(ThirdSemesterDetail::class);
    }

    public function thirdSemesterResultStatusDetail(){
        return $this->hasMany(ThirdSemesterResultStatusDetail::class);
    }

    public function fourthSemesterDetail(){
        return $this->hasOne(FourthSemesterDetail::class);
    }

    public function fourthSemesterResultStatusDetail(){
        return $this->hasMany(FourthSemesterResultStatusDetail::class);
    }

    public function fifthSemesterDetail(){
        return $this->hasOne(FifthSemesterDetail::class);
    }

    public function fifthSemesterResultStatusDetail(){
        return $this->hasMany(FifthSemesterResultStatusDetail::class);
    }

    public function sixthSemesterDetail(){
        return $this->hasOne(SixthSemesterDetail::class);
    }

    public function sixthSemesterResultStatusDetail(){
        return $this->hasMany(SixthSemesterResultStatusDetail::class);
    }

    public function seventhSemesterDetail(){
        return $this->hasOne(SeventhSemesterDetail::class);
    }

    public function seventhSemesterResultStatusDetail(){
        return $this->hasMany(SeventhSemesterResultStatusDetail::class);
    }

    public function eighthSemesterDetail(){
        return $this->hasOne(EighthSemesterDetail::class);
    }

    public function eighthSemesterResultStatusDetail(){
        return $this->hasMany(EighthSemesterResultStatusDetail::class);
    }

    public function workerContactNumber(){
        return $this->hasMany(WorkerContactNumber::class);
    }
    public function FactoryDeathManagerDetailContact(){
        return $this->hasMany(FactoryDeathManagerDetailContact::class);
    }
    public function StudentContactNumber(){
        return $this->hasMany(StudentContactNumber::class);
    }
     public function ProvisionalClaim(){
        return $this->hasMany(ProvisionalClaim::class);
    }
    public function admissionPWWB(){
        return $this->hasOne('App\Models\Admission', 'pwwb_file_id', 'id');
    }
    public function admissionByPwwbForm()
    {
        return $this->belongsTo('App\Models\AdmissionByPwwbForm'::class, 'index_table_id');
    }
}
