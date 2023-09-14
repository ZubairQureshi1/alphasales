<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class EnquiryAddress extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'enquiry_addresses';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'street_address',
        'city_id',
        'state_id',
        'country_id',
        'address_type_id',
        'enquiry_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'street_address' => 'string',
        'city_id' => 'integer',
        'state_id' => 'integer',
        'country_id' => 'integer',
        'address_type_id' => 'integer',
        'enquiry_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'street_address' => 'required',
        'city_id' => 'required',
        'state_id' => 'required',
        'country_id' => 'required',
        'address_type_id' => 'required',
        'enquiry_id' => 'required',
    ];

    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }
}
