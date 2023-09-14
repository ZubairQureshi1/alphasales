<?php

namespace App\Models\Pwwb;

use App\Models\SessionCourse;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class BiseDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function indexTable()
    {
        return $this->belongsTo(IndexTable::class);
    }

    public function setChangeForObserver($student)
    {
        $session_course = SessionCourse::where('organization_campus_id', $student->organization_campus_id)->where('session_id', $student->session_id)->where('course_id', $student->course_id)->get()->first();
        $this->bise_educational_wing_cfe = $session_course->wing_id;
        $this->bise_affiliated_body = $student->affiliated_body_id;
        $this->bise_shift = strtolower(config('constants.shifts')[$student->shift_id]);
        $this->bise_course_applied_in = $student->course_id;
        $this->bise_course_enrolled_cfe = $student->course_id;
        $this->bise_course_registered_in = $student->course_id;
    }
}
