<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class LectureAttendance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['student_name'];
    protected $fillable = ['status_id', 'part_id', 'course_id', 'subject_id', 'student_id', 'date', 'session_id'];

    public function getStudentNameAttribute()
    {
        $student = Student::find($this->student_id);
        return $student->student_name;
    }
}
