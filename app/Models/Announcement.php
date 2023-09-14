<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Announcement extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'title', 'description', 'part_id', 'subject_id', 'course_id', 'subject_name', 'course_name',
    ];

    public function getCourseNameAttribute()
    {
        $course = Course::find($this->course_id);
        if (empty($course)) {
            return '---';
        }
        return $course->name;
    }
    public function getSubjectNameAttribute()
    {
        $subject = Subject::find($this->subject_id);
        if (empty($subject)) {
            return '---';
        }
        return $subject->name;
    }
}
