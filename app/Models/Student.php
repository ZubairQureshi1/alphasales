<?php

namespace App\Models;

use App\Models\Pwwb\IndexTable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use OwenIt\Auditing\Contracts\Auditable;
use Illuminate\Database\Eloquent\Builder;

class Student extends Authenticatable implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'students';

    protected $dates = ['deleted_at'];
    protected $appends = ['profile_image', 'affiliated_body_name', 'student_category_name', 'total_package', 'total_payed', 'out_standing', 'receivable_till_date', 'student_cell_no', 'father_cell_no', 'mother_cell_no', 'brother_cell_no', 'sister_cell_no', 'guardian_cell_no', 'other_cell_no', 'file_receive_number', 'file_module_number', 'admission_date_formated', 'transport_status'];

    protected $guard = 'student';

    // protected static function boot()
    // {
    //     parent::boot();

    //     static::addGlobalScope('onlyActive', function (Builder $builder) {
    //         $builder->where('is_end_of_reg', false);
    //     });
    // }

    public $fillable = [
        'student_name', 'system_roll_number_id', 'student_cnic_no', 'profile_pic', 'father_name', 'father_cnic_no', 'd_o_b', 'email', 'session_name', 'course_name', 'father_work_address', 'father_cell_no', 'student_cell_no', 'roll_no', 'ptcl_no', 'gaurdian_name', 'gaurdian_cell_no', 'gaurdian_relationship', 'present_address', 'permanent_address', 'cell_no_emergency', 'reference_name', 'reference_id', 'session_id', 'course_id', 'admission_id', 'qr_code_name', 'old_roll_no', 'section_id', 'section_name', 'user_id', 'user_name', 'icap_crn', 'icap_roll_no', 'student_category_id', 'admission_type', 'is_end_of_reg', 'reason_end_of_reg', 'admission_date', 'shift', 'shift_id', 'gender', 'gender_id', 'semester', 'semester_id', 'remark_end_of_reg',
        'name', 'email_verified_at', 'password', 'semester_freeze_id', 'semester_freeze_reason', 'experience', 'designation', 'eobi', 'ssc', 'factory_city', 'factory_reg_no', 'is_transport', 'is_hostel', 'is_provisional_letter',
        'cfe_file_no', 'dairy_no', 'self_worker', 'r_eight', 'factory_name', 'transport_route_id', 'academic_term_id', 'degree_level_id', 'affiliated_body_id', 'transport_stop', 'organization_campus_id', 'is_registered', 'father_occupation',
        'city_id',
        'other_city_name',
        'source_info_id',
        'marketer_name',
        'social_media_type_id',
        'other_social_media_name',
        'ex_student_wing_type_id',
        'ex_student_name',
        'friend_name',
        'area',
        'other_source_of_info',
        'guardian_cnic',
        'enquiry_id',
        'student_occupation',
        'student_work_address',

    ];
    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_name' => 'string',
        'system_roll_number_id' => 'integer',
        'roll_no' => 'string',
        'student_cnic_no' => 'string',
        'profile_pic' => 'string',
        'father_name' => 'string',
        'father_cnic_no' => 'string',
        'd_o_b' => 'string',
        'email' => 'string',
        'session_name' => 'string',
        'course_name' => 'string',
        'father_work_address' => 'string',
        'father_cell_no' => 'string',
        'student_cell_no' => 'string',
        'ptcl_no' => 'string',
        'gaurdian_name' => 'string',
        'gaurdian_cell_no' => 'string',
        'gaurdian_relationship' => 'string',
        'present_address' => 'string',
        'permanent_address' => 'string',
        'cell_no_emergency' => 'string',
        'reference_name' => 'string',
        'reference_id' => 'integer',
        'session_id' => 'integer',
        'course_id' => 'integer',
        'admission_id' => 'integer',
        'qr_code_name' => 'string',
        'old_roll_no' => 'string',
        'section_id' => 'string',
        'section_name' => 'string',
        'user_id' => 'string',
        'user_name' => 'string',
        'icap_crn' => 'string',
        'icap_roll_no' => 'string',
        'student_category_id' => 'integer',
        'admission_type' => 'string',
        'is_end_of_reg' => 'boolean',
        'reason_end_of_reg' => 'string',
        'remark_end_of_reg' => 'string',
        'gender' => 'string',
        'shift' => 'string',
        'semester' => 'string',
        'gender_id' => 'integer',
        'shift_id' => 'integer',
        'semester_id' => 'integer',
        'affiliation_name' => 'string',
        'affiliation_id' => 'integer',
        'name' => 'string',
        'email_verified_at' => 'timestamp',
        'password' => 'string',
        'semester_freeze_id' => 'integer',
        'semester_freeze_reason' => 'string',
        'student_category_id' => 'required',
        'experience' => 'required',
        'designation' => 'required',
        'eobi' => 'required',
        'ssc' => 'required',
        'factory_city' => 'required',
        'factory_reg_no' => 'required',
        'is_transport' => 'required',
        'is_hostel' => 'required',
        'is_provisional_letter' => 'required',
        'cfe_file_no' => 'required',
        'dairy_no' => 'required',
        'self_worker' => 'required',
        'r_eight' => 'required',
        'factory_name' => 'required',
        'transport_route_id' => 'required',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function getProfileImageAttribute()
    {
        return !is_null(Admission::where('student_id', $this->id)->first()) ? Admission::where('student_id', $this->id)->first()->profile_pic : '';
    }

    public function fines()
    {
        return $this->hasMany('App\Models\Fine');
    }
    public function feePackages()
    {
        return $this->hasMany('App\Models\FeePackage');
    }
    public function headFineStudents()
    {
        return $this->hasMany('App\Models\HeadFineStudent');
    }
    public function studentAcademicHistories()
    {
        return $this->hasMany('App\Models\StudentAcademicHistory');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }

    public function dateSheetStudents()
    {
        return $this->hasMany('App\Models\DateSheetStudent');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }

    // public function getSectionNameAttribute()
    // {

    //     $studentSection = SectionStudent::where('student_id', '=', $this->id)->get()->last();
    //     // \Log::info($this->id);

    //     $section = Section::find($studentSection['section_id']);
    //     return $section['name'];
    // }

    // public function getSectionIdAttribute()
    // {
    //     $name = SectionStudent::find($this->student_id);
    //     return $name['section_id'];
    // }
    public function attendanceFines()
    {
        return $this->hasMany(AttendanceFine::class, 'student_id', 'id');
    }

    public function lectureAttendances()
    {
        return $this->hasMany(LectureAttendance::class, 'student_id', 'id');
    }
    public function examFines()
    {
        return $this->hasMany(ExamFine::class, 'student_id', 'id');
    }

    public function getSectionNameAttribute()
    {
        $section = Section::find($this->section_id);
        if (isset($section)) {
            $section_name = $section->name;
        } else {
            $section_name = '---';
        }
        return $section_name;
    }

    public function contactInfos()
    {
        return $this->hasMany('App\Models\StudentContactInformation', 'student_id');
    }

    public function studentRegistration()
    {
        return $this->belongsTo('App\Models\StudentRegistration', 'student_id');
    }

    public function admissionPWWB()
    {
        return $this->hasOne('App\Models\Admission', 'pwwb_file_id', 'id');
    }

    public function delete()
    {
        $this->examFines()->delete();
        $this->lectureAttendances()->delete();
        $this->attendanceFines()->delete();
        $this->dateSheetStudents()->delete();
        $this->headFineStudents()->delete();
        $this->attendances()->delete();
        foreach ($this->feePackages()->get() as $key => $feePackage) {
            foreach ($feePackage->feePackageInstallments()->get() as $key => $instalment) {
                $instalment->feeVoucher()->delete();
            }
            $feePackage->feePackageInstallments()->delete();
            $feePackage->feeVoucher()->delete();
        }
        $this->feePackages()->delete();
        $this->fines()->delete();
        SectionStudent::where('student_id', $this->id)->delete();
        StudentBook::where('student_academic_history_id', $this->studentAcademicHistories()->get()->last()->id)->delete();
        StudentInstallmentPlan::where('student_id', $this->id)->delete();
        StudentWorker::where('student_id', $this->id)->delete();
        StudentAttachment::where('attachment_for', $this->id)->delete();
        $this->studentAcademicHistories()->delete();
        $this->studentRegistration()->delete();

        return parent::delete();
    }

    public function attendanceDetails()
    {
        return $this->belongsTo('App\Models\StudentAttendanceDetail');
    }

    public function getAdmissionDateFormatedAttribute()
    {
        $date = new \DateTime($this->admission_date);
        return $date->format('D, d-M-Y');
    }

    public function getAffiliatedBodyNameAttribute()
    {
        return AffiliatedBody::find($this->attributes['affiliated_body_id'])->name ?? '---';
    }
    public function getStudentCategoryNameAttribute()
    {
        return config('constants.student_categories')[$this->attributes['student_category_id']] ?? '---';
    }

    public function getTransportStatusAttribute()
    {
        return config('constants.is_transport')[$this->attributes['is_transport']] ?? '---';
    }

    public function getTotalPackageAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['id'])->get()->last();
        if ($this->attributes['student_category_id'] == 0) {
            return 0;
        }
        return $fee_package->total_package ?? 0;
    }
    public function getTotalPayedAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['id'])->get()->last();
        if ($fee_package) {

            if ($this->attributes['student_category_id'] == 0) {
                return 0;
            }
            $total_payed = FeePackageInstallment::where('package_id', $fee_package->id)->where('status_id', 1)->sum('amount_per_installment');
            return $total_payed;
        } else {

            return 0;
        }
    }
    public function getOutStandingAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['id'])->get()->last();
        if ($fee_package) {
            if ($this->attributes['student_category_id'] == 0) {
                return 0;
            }
            $out_standing = FeePackageInstallment::where('package_id', $fee_package->id)->where('status_id', 0)->sum('amount_per_installment');
            return $out_standing;
        } else {
            return 0;
        }
    }
    public function getReceivableTillDateAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['id'])->get()->last();
        if ($fee_package) {
            if ($this->attributes['student_category_id'] == 0) {
                return 0;
            }
            $receivable_till_date = FeePackageInstallment::where('package_id', $fee_package->id)->where('status_id', 0)->where('due_date', new \DateTime())->sum('amount_per_installment');
            return $receivable_till_date;
        } else {
            return 0;
        }
    }
    public function getStudentCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 5)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }
    public function getFatherCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 0)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }
    public function getMotherCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 1)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }

    public function getBrotherCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 2)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }

    public function getSisterCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 3)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }

    public function getGuardianCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 4)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }

    public function getOtherCellNoAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 6)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }

    public function getFileReceiveNumberAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        return !is_null(IndexTable::where('id', $admission->pwwb_file_id)->first()) ? IndexTable::where('id', $admission->pwwb_file_id)->first()->file_received_number : '---';
    }

    public function getFileModuleNumberAttribute()
    {
        $admission = Admission::where('id', $this->attributes['admission_id'])->get()->last();
        return !is_null(IndexTable::where('id', $admission->pwwb_file_id)->first()) ? IndexTable::where('id', $admission->pwwb_file_id)->first()->file_module_number : '---';
    }

    public function scopeRegistrationEnded($query, $status)
    {
        return $query->where('is_end_of_reg', $status);
    }


}
