<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AttendanceSheetEntry extends Model
{
    protected $table = 'student_attendances';

    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function timeslot()
    {
        return $this->belongsTo('App\Models\TimeSlot');
    }
    
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    public function wing()
    {
        return $this->belongsTo('App\Models\Wing');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function sessionCourseSubject()
    {
        return $this->belongsTo('App\Models\SessionCourseSubject');
    }
    public function affiliatedBody()
    {
        return $this->belongsTo('App\Models\AffiliatedBody');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
