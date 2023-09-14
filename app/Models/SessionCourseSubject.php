<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SessionCourseSubject extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    public function sectionSubjectDetails()
    {
        return $this->hasMany(SectionSubjectDetail::class, 'subject_id', 'subject_id');
    }

}
