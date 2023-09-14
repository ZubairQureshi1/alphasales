<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Fine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'fines';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name',
        'amount',
        'course_id',
        'student_id',
        'status',
        'due_date',
        'paid_date',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'amount' => 'integer',
        'course_id' => 'integer',
        'student_id' => 'integer',
        'status' => 'string',
        'due_date' => 'string',
        'paid_date' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function feeVoucher()
    {
        return $this->belongsTo('App\Models\FeeVoucher', 'voucher_id');
    }

}
