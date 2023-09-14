<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendanceDetail extends Model
{
    protected $table = 'student_attendance_details';
    protected $guarded = [];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function studentAttendance()
    {
    	return $this->belongsTo('App\Models\StudentAttendance');
    }
    public function wing()
    {
    	return $this->belongsTo('App\Models\Wing');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
   }
