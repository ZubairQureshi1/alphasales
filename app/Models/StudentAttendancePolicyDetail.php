<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendancePolicyDetail extends Model
{
    protected $table = 'student_attendance_policy_details';

    protected $guarded = [];

    public function studentAttendancePolicy()
    {
    	return $this->belongsTo('App\Models\StudentAttendancePolicy');
    }
}
