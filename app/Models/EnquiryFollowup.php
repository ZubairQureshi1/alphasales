<?php

namespace App\Models;

use App\Models\Enquiry;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EnquiryFollowup extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    public $table = 'enquiry_followups';

    //protected $appends = ['phone1', 'phone2', 'landline', 'city_name', 'project_name', 'product_name', 'source_info_id', 'enquiry_data', 'prospect_followups', 'next_date_formated'];
    protected $appends = ['phone1', 'phone2', 'landline', 'city_name', 'project_name', 'product_name', 'source_info_id', 'enquiry_data', 'prospect_followups', 'next_date_formated'];
    protected $dates = ['deleted_at'];

    public $fillable = [
        'enq_Form_code',
        'enquiry_id',
        'next_date',
        'status_id',
        'status',
        'remarks',
        'interest_level_id',
        'interest_level',
        'followup_type_id',
        'prospect_name',
        'prospect_relationship',
        'prospect_course',
        'prospect_parent_id',
        'called_by',
        'answered_by',
        'followup_status_group_name',
        'student_relationship_with_attendant',
        'session_id',
        'call_status_name',
        'call_status_id',
        'revised_price',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    // protected $casts = [
    //     'enq_Form_code' => 'string',
    //     'enquiry_id' => 'integer',
    //     'next_date' => 'string',
    //     'status_id' => 'integer',
    //     'status' => 'string',
    //     'remarks' => 'string',
    //     'interest_level' => 'string',
    // ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'enq_Form_code' => 'required',
        'enquiry_id' => 'required',
        'next_date' => 'required',
        'status_id' => 'required',
        'status' => 'required',
        'remarks' => 'required',
        'interest_level' => 'string',
    ];

    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }

    public function getEnquiryDataAttribute()
    {
        $value = Enquiry::withTrashed()->find($this->enquiry_id);
        return $value;
    }
    public function getNextDateFormatedAttribute()
    {
        if (isset($this->next_date)) {
            $date = new \DateTime($this->next_date);
            return $date->format('D, d-M-Y');
        }
        else
        {
            return '';
        }
    }

    public function getProspectFollowupsAttribute()
    {

        $value = EnquiryFollowup::where('enquiry_id', $this->enquiry_id)->where('prospect_parent_id', $this->id)->where('followup_type_id', 1)->orderBy('created_at', 'desc')->get();
        return $value;
    }

    public function getPhone1Attribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->phone1)?$value->phone1:null;
    }
    public function getPhone2Attribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->phone2)?$value->phone2:null;
    }
    public function getLandlineAttribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->landline)?$value->landline:null;
    }
    public function getCityNameAttribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->city_name)?$value->city_name:null;
    }
    public function getProjectNameAttribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->project_name)?$value->project_name:null;
    }
    public function getProductNameAttribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->product_name)?$value->product_name:null;
    }
    public function getSourceInfoIdAttribute()
    {
        $value = Enquiry::where('id', $this->enquiry_id)->first();
        return isset($value->source_info_id)?$value->source_info_id:null;
    }
}

