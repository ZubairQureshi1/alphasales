<?php

namespace App\Models\Pwwb;

use App\Models\SessionCourse;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DualCourseDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function indexTable()
    {
        return $this->belongsTo(IndexTable::class);
    }
    public function setChangeForObserver($student)
    {

        $session_course = SessionCourse::where('organization_campus_id', $student->organization_campus_id)->where('session_id', $student->session_id)->where('course_id', $student->course_id)->get()->first();
        $this->attributes['affiliated_body'] = $student->affiliated_body_id;
        $this->attributes['shift'] = strtolower(config('constants.shifts')[$student->shift_id]);
        $this->attributes['educational_wing_cfe'] = $session_course->wing_id;
        $this->attributes['course'] = $student->course_id;

    }
}
