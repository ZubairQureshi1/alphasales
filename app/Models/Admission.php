<?php

namespace App\Models;

use App\Models\Pwwb\IndexTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Admission extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'admissions';

    protected $appends = ['affiliated_body', 'admission_date_formated', /* 'student_category_name',*/'total_package', 'total_payed', 'out_standing', 'receivable_till_date', 'student_cell_no', 'father_cell_no', 'file_receive_number', 'file_module_number'];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'student_name', 'form_no', 'student_cnic_no', 'profile_pic', 'father_name', 'father_cnic_no', 'd_o_b', 'email', 'session_name', 'course_name', 'father_work_address', 'father_cell_no', 'student_cell_no', 'ptcl_no', 'gaurdian_name', 'gaurdian_cell_no', 'gaurdian_relationship', 'present_address', 'permanent_address', 'cell_no_emergency', 'reference_name', 'reference_id', 'session_id', 'course_id', 'student_id', 'old_roll_no', 'user_id', 'user_name', 'student_category_id', 'admission_type', 'experience', 'designation', 'eobi', 'ssc', 'factory_city', 'factory_reg_no', 'is_transport', 'is_hostel', 'is_provisional_letter', 'cfe_file_no', 'dairy_no', 'self_worker', 'r_eight', 'icap_crn', 'icap_roll_no', 'shift', 'shift_id', 'gender', 'gender_id', 'counselor_by', 'admission_date', 'semester', 'semester_id', 'affiliated_body_id', 'factory_name', 'transport_route_id', 'worker_joining_date', 'academic_term_id', 'degree_level_id', 'transport_stop', 'organization_campus_id', 'student_category_name', 'father_occupation',
        'city_id',
        'other_city_name',
        'source_info_id',
        'marketer_name',
        'social_media_type_id',
        'other_social_media_name',
        'ex_student_wing_type_id',
        'ex_student_name',
        'friend_name',
        'other_source_of_info',
        'guardian_cnic',
        'area',
        'enquiry_id',
        'checklist_incomplete',
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
        'form_no' => 'string',
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
        'session_id' => 'string',
        'course_id' => 'string',
        'student_id' => 'string',
        'old_roll_no' => 'string',
        'user_id' => 'string',
        'user_name' => 'string',
        'icap_crn' => 'string',
        'icap_roll_no' => 'string',
        'admission_type' => 'string',
        'student_category_id' => 'integer',
        'experience' => 'string',
        'designation' => 'string',
        'eobi' => 'string',
        'ssc' => 'string',
        'factory_city' => 'string',
        'factory_reg_no' => 'string',
        'is_transport' => 'integer',
        'is_hostel' => 'integer',
        'is_provisional_letter' => 'integer',
        'cfe_file_no' => 'string',
        'dairy_no' => 'string',
        'self_worker' => 'integer',
        'r_eight' => 'string',
        'gender' => 'string',
        'shift' => 'string',
        'gender_id' => 'integer',
        'shift_id' => 'integer',
        'counselor_by' => 'string',
        'admission_date' => 'date',
        'semester' => 'string',
        'semester_id' => 'integer',
        'affiliated_body_id' => 'integer',
        'factory_name' => 'string',
        'transport_route_id' => 'integer',
        'checklist_incomplete' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'student_name' => 'required',
        'form_no' => 'required',
        'student_cnic_no' => 'required',
        'profile_pic' => 'required',
        'father_name' => 'required',
        'father_cnic_no' => 'required',
        'd_o_b' => 'required',
        'email' => 'required',
        'session_name' => 'required',
        'course_name' => 'required',
        'father_work_address' => 'required',
        'father_cell_no' => 'required',
        'student_cell_no' => 'required',
        'ptcl_no' => 'required',
        'gaurdian_name' => 'required',
        'gaurdian_cell_no' => 'required',
        'gaurdian_relationship' => 'required',
        'present_address' => 'required',
        'permanent_address' => 'required',
        'cell_no_emergency' => 'required',
        'reference_name' => 'required',
        'reference_id' => 'required',
        'session_id' => 'required',
        'course_id' => 'required',
        'student_id' => 'required',
        'old_roll_no' => 'required',
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

    public function getAffiliatedBodyAttribute()
    {
        return AffiliatedBody::find($this->affiliated_body_id) != null ? AffiliatedBody::find($this->affiliated_body_id)->name : '---';
    }
    public function getAdmissionDateFormatedAttribute()
    {
        $date = new \DateTime($this->admission_date);
        return $date->format('D, d-M-Y');
    }

    public function getTotalPackageAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['student_id'])->get()->last();
        if ($this->attributes['student_category_id'] == 0) {
            return 0;
        }
        return $fee_package->total_package;
    }
    public function getTotalPayedAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['student_id'])->get()->last();
        if ($this->attributes['student_category_id'] == 0) {
            return 0;
        }
        $total_payed = FeePackageInstallment::where('package_id', $fee_package->id)->where('status_id', 1)->sum('amount_per_installment');
        return $total_payed;
    }
    public function getOutStandingAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['student_id'])->get()->last();
        if ($this->attributes['student_category_id'] == 0) {
            return 0;
        }
        $out_standing = FeePackageInstallment::where('package_id', $fee_package->id)->where('status_id', 0)->sum('amount_per_installment');
        return $out_standing;
    }
    public function getReceivableTillDateAttribute()
    {
        $fee_package = FeePackage::where('student_id', $this->attributes['student_id'])->get()->last();
        if ($this->attributes['student_category_id'] == 0) {
            return 0;
        }
        $receivable_till_date = FeePackageInstallment::where('package_id', $fee_package->id)->where('status_id', 0)->where('due_date', new \DateTime())->sum('amount_per_installment');
        return $receivable_till_date;
    }
    public function getStudentCellNoAttribute()
    {
        $admission = Admission::where('form_no', $this->form_no)->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 5)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    }
    public function getFatherCellNoAttribute()
    {
        $admission = Admission::where('form_no', $this->form_no)->get()->last();
        $contact_infos = StudentContactInformation::where('admission_id', $admission->id)->where('contact_type_id', 0)->get();
        $contact = '';
        foreach ($contact_infos as $contact_info) {
            $contact = $contact . $contact_info->contact_no . (', ');
        }
        return empty($contact) ? '---' : $contact;
    } /*
    public function getStudentCategoryNameAttribute()
    {
    $student_category_id = $this->attributes['student_category_id'] ?? $this->student_category_id;
    return !is_null($student_category_id) ? (isset(config('constants.student_categories')[$student_category_id]) ? config('constants.student_categories')[$student_category_id] : '---') : '---';
    }
     */
    public function affiliatedBodyChecklists()
    {
        return $this->hasMany('App\Models\AdmissionAffiliatedBodyChecklist', 'admission_id');
    }

    public function admissionByPwwbForm()
    {
        return $this->belongsTo('App\Models\AdmissionByPwwbForm');
    }

    public function pwwbFileDetail()
    {
        if (isset($this->pwwb_id)) {
            return \App\Models\Pwwb\IndexTable::find($this->pwwb_id);
        }
    }

    public function getFileReceiveNumberAttribute()
    {
        return !is_null(IndexTable::where('id', $this->pwwb_file_id)->first()) ? IndexTable::where('id', $this->pwwb_file_id)->first()->file_received_number : '---';
    }

    public function getFileModuleNumberAttribute()
    {
        return !is_null(IndexTable::where('id', $this->pwwb_file_id)->first()) ? IndexTable::where('id', $this->pwwb_file_id)->first()->file_module_number : '---';
    }
}
