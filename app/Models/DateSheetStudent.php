<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheetStudent extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['student_roll_no', 'student_name', 'date_sheet', 'date_sheet_name', 'subject_name', 'exam_type_name', 'student_section', 'student_old_roll_no'];
    public $fillable = [
        'date_sheet_id', 'total_marks', 'obtain_marks', 'percentage', 'grade', 'status', 'status_id', 'user_id', 'student_id', 'subject_id', 'course_id', 'section_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'date_sheet_id' => 'integer',
        'total_marks' => 'integer',
        'obtain_marks' => 'integer',
        'percentage' => 'integer',
        'grade' => 'string',
        'status' => 'string',
        'user_id' => 'integer',
        'student_id' => 'integer',
        'subject_id' => 'integer',
        'course_id' => 'integer',
        'status_id' => 'integer',
        'section_id' => 'integer',

    ];
    public function getStudentRollNoAttribute()
    {
        $student = Student::find($this->student_id);
        return $student->roll_no;
    }
    public function getStudentSectionAttribute()
    {
        $student = Student::find($this->student_id);
        return $student->section_name;
    }
    public function getStudentOldRollNoAttribute()
    {
        $student = Student::find($this->student_id);
        return $student->old_roll_no;
    }
    public function getSubjectNameAttribute()
    {
        $subject = Subject::find($this->subject_id);
        return $subject->name;
    }
    public function getDateSheetAttribute()
    {
        $dateSheet = DateSheet::find($this->date_sheet_id);
        return $dateSheet->toArray();
    }
    public function getDateSheetNameAttribute()
    {
        $dateSheet = DateSheet::find($this->date_sheet_id)->date_sheet_name;
        return $dateSheet;
    }
    public function getExamTypeNameAttribute()
    {
        $exam_type_name = DateSheet::find($this->date_sheet_id)->exam_type_name;
        return $exam_type_name;
    }
    public function getStudentNameAttribute()
    {
        $student = Student::find($this->student_id);
        return $student->student_name;
    }

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
}
