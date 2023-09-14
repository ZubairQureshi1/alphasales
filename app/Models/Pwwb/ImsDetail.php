<?php

namespace App\Models\Pwwb;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ImsDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public function indexTable()
    {
        return $this->belongsTo(IndexTable::class);
    }

    public function setChangeForObserver($student)
    {
        \Log::info('student_id --- ' . $student->id . ' --- Shift ID --- ' . $student->shift_id);
        $this->attributes['ims_affiliated_body'] = $student->affiliated_body_id;
        $this->attributes['ims_shift'] = !is_null($student->shift_id) ? strtolower(config('constants.shifts')[$student->shift_id]) : null;
        $this->attributes['ims_course_applied_in_cfe'] = $student->course_id;
        $this->attributes['ims_course_enrolled_in_cfe'] = $student->course_id;
        $this->attributes['ims_course_registered'] = $student->course_id;
    }
}
