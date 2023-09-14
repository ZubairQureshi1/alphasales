<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class CourseSubject extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'course_subjects';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'course_name',
        'subject_name',
        'semester',
        'course_id',
        'subject_id',
        'semester_id',
        'mid_term_attendance_percentage',
        'final_term_attendance_percentage',
        'prerequisite_subject',
        'credit_hours',
        'organization_id',
        'wing_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'course_name' => 'string',
        'subject_name' => 'string',
        'semester' => 'string',
        'course_id' => 'integer',
        'subject_id' => 'integer',
        'semester_id' => 'integer',
        'mid_term_attendance_percentage' => 'integer',
        'final_term_attendance_percentage' => 'integer',
        'prerequisite_subject' => 'string',
        'credit_hours' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_name' => 'required',
        'subject_name' => 'required',
        'semester' => 'required',
        'course_id' => 'required',
        'subject_id' => 'required',
        'semester_id' => 'required',
        'mid_term_attendance_percentage' => 'reduired',
        'final_term_attendance_percentage' => 'required',
        'prerequisite_subject' => 'required',
        'credit_hours' => 'required',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function subject()
    {
        return $this->belongsTo('App\Models\Subject');
    }
}
