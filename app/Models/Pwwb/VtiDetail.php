<?php

namespace App\Models\Pwwb;

use App\Models\SessionCourse;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class VtiDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    public function indexTable()
    {
        return $this->belongsTo(IndexTable::class);
    }

    public function setChangeForObserver($student)
    {
        $session_course = SessionCourse::where('organization_campus_id', $student->organization_campus_id)->where('session_id', $student->session_id)->where('course_id', $student->course_id)->get()->first();
        $this->vti_affiliated_body = $student->affiliated_body_id;
        $this->vti_shift = strtolower(config('constants.shifts')[$student->shift_id]);
        $this->vti_diploma_applied_in = $student->course_id;
        $this->vti_diploma_enrolled_in = $student->course_id;
        $this->vti_diploma_registered_in = $student->course_id;
    }
}
