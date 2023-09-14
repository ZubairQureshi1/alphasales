<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendancePolicy extends Model
{
    protected $table = 'student_attendance_policies';

    protected $guarded = [];

    public function studentAttendancePolicyDetails()
    {
    	return $this->hasMany('App\Models\StudentAttendancePolicyDetail', 'student_policy_id' , 'id');
    }
    public function studentAttendancePolicy()
    {
    	return $this->belongsTo('App\Models\StudentAttendancePolicyDetail', 'student_policy_id' , 'id');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
