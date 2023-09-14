<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class ReferenceEnquiry extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'reference_enquiries';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'reference_id',
        'enquiry_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'reference_id' => 'integer',
        'enquiry_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'reference_id' => 'required',
        'enquiry_id' => 'required',
    ];

    public function reference()
    {
        return $this->belongsTo('App\Models\Reference');
    }

    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }

}
