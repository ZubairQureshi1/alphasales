<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements Auditable
{
    use Notifiable;
    use HasRoles;
    use \OwenIt\Auditing\Auditable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected static function boot()
    {
        parent::boot();

        if (auth()->user() && !auth()->user()->isSuperAdmin()) {
            static::addGlobalScope('withoutSuperAdmin', function (Builder $builder) {
                $builder->where('is_super_admin', false);
            });
        }
    }

    protected $appends = ['designation', 'department', 'emp_code', 'audit_title', 'job_title'];

    protected $fillable = [

        'name', 'email', 'password', 'mobile_no', 'landline_no', 'cnic_no', 'cnic_expiry', 'father_name', 'age', 'gender', 'religion', 'martial_status', 'blood_group', 'display_name', 'username', 'profile_pic_url', 'd_o_b', 'qr_code_name', 'gender_id', 'religion_id', 'martial_status_id', 'blood_group_id', 'faculty_type', 'experience_level', 'hourly_salary_rate', 'fixed_salary',

    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function userDesignations()
    {
        return $this->hasMany('App\Models\UserDesignation');
    }

    public function departmentUsers()
    {
        return $this->hasMany('App\Models\DepartmentUser');
    }
    public function shifts()
    {
        return $this->hasMany('App\Models\Shift', 'user_id', 'id');
    }
    public function enquiries()
    {
        return $this->hasMany('App\Models\Enquiry');
    }

    public function attendances()
    {
        return $this->hasMany('App\Models\Attendance');
    }
    public function timePeriods()
    {
        return $this->hasMany('App\Models\TimePeriod');
    }

    public function campusDetails()
    {
        return $this->hasMany('App\Models\UserCampusDetail', 'user_id', 'id');
    }

    public function userAllowedSessions()
    {
        return $this->hasMany('App\Models\UserAllowedSession')->where('is_active', 1);
    }

    public function getDesignationAttribute()
    {
        $designation = !$this->userDesignations()->get()->isEmpty() ? $this->userDesignations()->get()->first()->designation_name : '---';

        return $designation;
    }

    public function getDepartmentAttribute()
    {
        $department = !$this->departmentUsers()->get()->isEmpty() ? $this->departmentUsers()->get()->first()->department_name : '---';
        return $department;
    }

    public function getJobTitleAttribute()
    {
        return !$this->campusDetails()->where('is_primary_emp_code', true)->get()->isEmpty() ? JobTitle::find($this->campusDetails()->where('is_primary_emp_code', true)->first()->job_title_id)->name : '---';
    }

    public function getAuditTitleAttribute()
    {
        return ucfirst($this->display_name);
    }

    public function getSelectedSessionAttribute()
    {
        return SystemSession::get('organization_campus_id');
    }

    public function getEmpCodeAttribute()
    {
        $code = !$this->campusDetails()->where('is_primary_emp_code', 1)->get()->isEmpty() ? $this->campusDetails()->where('is_primary_emp_code', 1)->get()->first()->emp_code : '---';
        return $code;
    }

    public function isGuest()
    {
        return $this->is_guest ? true : false;
    }

    public function isSuperAdmin()
    {
        return $this->is_super_admin ? true : false;
    }
}
