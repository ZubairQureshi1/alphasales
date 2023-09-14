<?php

namespace App\Models;

use App\Models\City;
use App\Models\Course;
use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Session as SystemSession;
use OwenIt\Auditing\Contracts\Auditable;

/**
 * Class Enquiry
 * @package App\Models
 * @version June 28, 2018, 10:10 am UTC
 *
 * @property string name
 * @property string father_name
 */
class Enquiry extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'enquiries';

    protected $appends = ['follow_up_interested_level', 'previous_degree', 'marks_obtained', 'percentage', 'source_info', 'shift', 'transport_route', 'affiliated_body', 'enquiry_date_formated', 'enquiry_date_month', 'city', 'last_followup_id', 'student_category'];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'father_name',
        'enquiry_type',
        'name_other_enquiry_type',
        'income_range',
        'introduced_by',
        'form_code',
        'father_occupation',
        'remarks',
        'user_id',
        'user_name',
        'status_id',
        'status',
        'student_category_id',
        'is_domicile',
        'experience',
        'designation',
        'shift_id',
        'is_eobi',
        'is_ssc',
        'is_frc',
        'source_info_id',
        'is_transport',
        'course_id',
        'affiliated_body_id',
        'transport_route_id', 'father_cell_no', 'student_cell_no', 'gaurdian_cell_no', 'present_address',
        'permanent_address', 'phone1', 'phone2', 'landline', 'reference_name', 'reference_id', 'other_cell_no', 'session_name', 'session_id', 'marks_obtained', 'total_marks', 'percentage',
        'student_cnic_no', 'father_cnic_no', 'dob', 'email', 'city_id', 'city_name', 'previous_degree_id', 'follow_up_interested_level_id', 'passing_year', 'enquiry_date', 'previous_degree_body', 'academic_term_id', 'organization_campus_id', 'transport_stop', 'degree_name_other', 'area', 'marketer_name', 'social_media_type_id', 'other_social_media_name', 'ex_student_wing_type_id', 'ex_student_name', 'friend_name', 'other_source_of_info', 'gender_id', 'followup_status_group_name', 'parent_id', 'course_name', 'affiliated_body_name', 'student_category_name', 'other_city_name', 'academy_school_name', 'faculty_member_name', 'form_bypassed',
        'entry_by', 'entry_by_name',
        'provisional_letter_application_recieved',
        'stamp_paper_filled',
        'file_received_status',
        'file_received_number',
        'file_module_number',
        'project_id',
        'project_name',
        'product_id',
        'product_name',
        'developer_id',
        'developer_name',
        'price_offer',
    ];

    // protected $casts = [
    //     'name' => 'string',
    //     'enquiry_type' => 'string',
    //     'father_name' => 'string',
    //     'form_code' => 'string',
    //     'father_occupation' => 'string',
    //     'remarks' => 'string',
    //     'user_name' => 'string',
    //     'user_id' => 'integer',
    //     'status' => 'string',
    //     'status_id' => 'integer',
    //     'student_category_id' => 'integer',
    //     'experience' => 'string',
    //     'designation' => 'string',
    //     'shift_id' => 'integer',
    //     'is_eobi' => 'integer',
    //     'is_ssc' => 'integer',
    //     'is_frc' => 'integer',
    //     'source_info_id' => 'string',
    //     'is_transport' => 'integer',
    //     'transport_route_id' => 'integer',
    //     'father_cell_no' => 'string',
    //     'student_cell_no' => 'string',
    //     'gaurdian_cell_no' => 'string',
    //     'present_address' => 'string',
    //     'permanent_address' => 'string',
    //     'reference_name' => 'string',
    //     'other_cell_no' => 'string',
    //     'session_name' => 'string',
    //     'session_id' => 'integer',
    //     'interest_level' => 'string',
    // ];

    public static $rules = [];

    /* ------------------- RelationShips ----------------------*/

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function courseEnquiries()
    {
        return $this->hasMany('App\Models\CourseEnquiry');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
    public function enquiryAddresses()
    {
        return $this->hasMany('App\Models\EnquiryAddress');
    }
    public function enquiryFollowups()
    {
        return $this->hasMany('App\Models\EnquiryFollowup');
    }

    public function enquiryContactInfos()
    {
        return $this->hasMany('App\Models\EnquiryContactInfo');
    }
    public function referenceEnquiries()
    {
        return $this->hasMany('App\Models\ReferenceEnquiry');
    }

    public function enquiryWorkers()
    {
        return $this->hasMany('App\Models\EnquiryWorker');
    }

    /* ------------------- Appends Functions ----------------------*/

    public function getFollowUpInterestedLevelAttribute()
    {
        return $this->follow_up_interested_level_id != null ? (isset(config('constants.follow_up_interested_levels')[$this->follow_up_interested_level_id]) ? config('constants.follow_up_interested_levels')[$this->follow_up_interested_level_id] : '---') : '---';
    }


    public function getPreviousDegreeAttribute()
    {
        return $this->previous_degree_id != null ? config('constants.previous_degrees')[$this->previous_degree_id] : '---';
    }
    public function getSourceInfoAttribute()
    {
        return $this->source_info_id != null ? (isset(config('constants.information_sources')[$this->source_info_id]) ? config('constants.information_sources')[$this->source_info_id] : '---') : '---';
    }
    public function getStudentCategoryAttribute()
    {


        return !is_null($this->student_category_id) ? (isset(config('constants.student_categories')[$this->student_category_id]) ? config('constants.student_categories')[$this->student_category_id] : '---') : '---';
    }
    public function getShiftAttribute()
    {
        return $this->shift_id != null ? config('constants.shifts')[$this->shift_id] : '---';
    }

    public function getTransportRouteAttribute()
    {
        return $this->transport_route_id != null ? config('constants.transport_routes')[$this->transport_route_id] : '---';
    }

    public function getCityAttribute()
    {
        return !empty(City::find($this->city_id)) ? City::find($this->city_id)->name : '---';
    }

    public function getAffiliatedBodyAttribute()
    {
        return AffiliatedBody::find($this->affiliated_body_id) != null ? AffiliatedBody::find($this->affiliated_body_id)->name : '---';
    }
    public function getMarksObtainedAttribute()
    {
        return isset($this->attributes['marks_obtained']) ? $this->attributes['marks_obtained'] : '---';
    }
    public function getPercentageAttribute()
    {
        return isset($this->attributes['percentage']) ? $this->attributes['percentage'] : '---';
    }
    public function getEnquiryDateFormatedAttribute()
    {
        $date = new \DateTime($this->enquiry_date);
        return $date->format('D, d-M-Y');
    }

    public function getEnquiryDateMonthAttribute()
    {
        $date = new \DateTime($this->enquiry_date);
        return $date->format('M-Y');
    }

    public function getLastFollowupIdAttribute()
    {
        $followup = EnquiryFollowup::where('enquiry_id', $this->id)->where(function ($query) {
            $query->where('status_id', '!=', 2)->orWhere('status_id', '!=', 3);
        })->get();
        if (!$followup->isEmpty()) {
            return $followup->last()->id;
        } else {
            return '';
        }
    }

    // ------------------------ Accessors for text fields which capitalize first letter ----------------------

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getFatherNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getRemarksAttribute($value)
    {
        return ucwords($value);
    }

    public function scopeCampus($query)
    {
        return $query->where('organization_campus_id', SystemSession::get('organization_campus_id'));
    }

    // ------------------------ mutators for text fields which capitalize first letter while saving ----------------------

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function setFatherNameAttribute($value)
    {
        $this->attributes['father_name'] = ucwords($value);
    }

    public function setRemarksAttribute($value)
    {
        $this->attributes['remarks'] = ucwords($value);
    }
}
