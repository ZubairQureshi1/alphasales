<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheet extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['date_sheet_name', 'session_name', 'exam_type_name'];
    public $fillable = [
        'course_id', 'session_id', 'exam_type_id', 'exam_type_name',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'course_id' => 'integer',
        'session_id' => 'integer',
        'exam_type_id' => 'integer',
        'exam_type_name' => 'string',
    ];

    public function getDateSheetNameAttribute()
    {
        $session = Session::find($this->session_id);
        $exam_type = ExamType::find($this->exam_type_id);
        // $course = Course::find($this->course_id);
        return $exam_type->exam_type . ' ' . '(' . $session->session_name . ')';
        // $course->name . ' - ' .
    }
    // public function getCourseNameAttribute()
    // {
    //     $course = Course::find($this->course_id);
    //     return $course->name;
    // }
    public function getSessionNameAttribute()
    {
        $session = Session::find($this->session_id);
        return $session->session_name;
    }
    public function getExamTypeNameAttribute()
    {
        $exam_type = ExamType::find($this->exam_type_id);
        return $exam_type->exam_type;
    }
    public function dateSheetStudents()
    {
        return $this->hasMany('App\Models\DateSheetStudent');
    }
    public function examFines()
    {
        return $this->hasMany('App\Models\ExamFine');
    }
}
