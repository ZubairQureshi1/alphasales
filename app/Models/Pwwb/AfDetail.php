<?php

namespace App\Models\Pwwb;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AfDetail extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public function indexTable()
    {
        return $this->belongsTo(IndexTable::class);
    }

    public function setChangeForObserver($student)
    {
        $this->af_affiliated_body = $student->affiliated_body_id;
        $this->af_shift = strtolower(config('constants.shifts')[$student->shift_id]);
        $this->af_course_applied_in = $student->course_id;
        $this->af_course_enrolled_in = $student->course_id;
        $this->af_course_registered_in = $student->course_id;
    }
}
