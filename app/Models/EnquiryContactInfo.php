<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EnquiryContactInfo extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'enquiry_contact_infos';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'phone_no',
        'contact_type_id',
        'contact_type_name',
        'enquiry_id',
        'other_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'phone_no' => 'string',
        'contact_type_id' => 'integer',
        'contact_type_name' => 'integer',
        'enquiry_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'phone_no' => 'required',
        'contact_type_id' => 'required',
        'contact_type_name' => 'required',
        'enquiry_id' => 'required',
    ];

    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }
}
