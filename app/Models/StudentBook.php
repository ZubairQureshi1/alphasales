<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentBook extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    public $table = 'student_books';

    protected $dates = ['deleted_at'];

    public $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'subject_id' => 'integer',
        'subject_name' => 'string',
        'student_academic_history_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'subject_name' => 'required',
        'student_academic_history_id' => 'required',
    ];

    public function studentAcademicHistory()
    {
        return $this->belongsTo('App\Models\StudentAcademicHistory');
    }

}
