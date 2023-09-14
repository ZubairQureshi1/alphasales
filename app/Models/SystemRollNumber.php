<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SystemRollNumber extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'system_roll_numbers';

    protected $dates = ['deleted_at'];
    // protected $appends = ['section_id', 'section_name'];

    public $fillable = [
        'roll_no', 'student_id', 'session_id', 'section_id', 'course_id', 'admission_id', 'student_name', 'session_name', 'section_name', 'course_name', 'admission_form_code', 'is_assigned', 'generated_at_length', 'organization_campus_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'roll_no' => 'string',
        'student_name' => 'string',
        'session_name' => 'string',
        'course_name' => 'string',
        'section_name' => 'string',
        'admission_form_code' => 'string',
        'student_id' => 'string',
        'session_id' => 'string',
        'admission_id' => 'string',
        'course_id' => 'string',
        'section_id' => 'string',
        'is_assigned' => 'boolean',
        'generated_at_length' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

}
