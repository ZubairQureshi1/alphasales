<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Semester extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'semester', 'course_id', 'session_id', 'min_discount', 'max_discount', 'min_installments', 'max_installments',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'semester' => 'integer',
        'course_id' => 'integer',
        'session_id' => 'integer',
        'min_discount' => 'integer',
        'max_discount' => 'integer',
        'min_installments' => 'integer',
        'max_installments' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'semester' => 'required|integer',
        'course_id' => 'required|integer',
        'session_id' => 'required|integer',
        'min_discount' => 'required|integer|min:0|max:100',
        'max_discount' => 'required|integer|min:0|max:100|before:min_discount',
        'min_installments' => 'required|integer|min:0|max:12',
        'max_installments' => 'required|integer|min:0|max:12|before:min_installments',
    ];

    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function Session()
    {
        return $this->belongsTo(Session::class, 'session_id', 'id');
    }
}
