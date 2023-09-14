<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AcademicRecord extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'academic_records';

    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'type_name' => 'string',
        'type_id' => 'string',
        'year' => 'string',
        'marks' => 'string',
        'grade' => 'string',
        'school_college' => 'string',
        'board_uni' => 'string',
        'admission_id' => 'integer',
        'student_id' => 'integer',
        'attacment_url' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'admission_id' => 'required',
        'board_uni' => 'required',
        'school_college' => 'required',
        'grade' => 'required',
        'marks' => 'required',
        'year' => 'required',
        'type_id' => 'required',
        'type_name' => 'required',
        'student_id' => 'required',
    ];
}
