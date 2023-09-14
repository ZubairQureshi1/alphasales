<?php

namespace App\Models;

use App\Models\Department;
use App\Models\Designation;
use App\Models\Organization;
use App\Models\OrganizationCampus;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;
use Spatie\Permission\Models\Role;

class UserCampusDetail extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    protected $appends = ['organization_name', 'organization_campus_name', 'department_name', 'designation_name', 'role_name'];

    protected $fillable = [

        'user_id', 'organization_id', 'organization_campus_id', 'designation_id', 'department_id', 'role_id', 'is_working', 'job_title_id'

    ];

    public function getOrganizationNameAttribute()
    {
        return !is_null(Organization::find($this->organization_id)) ? Organization::find($this->organization_id)->name : '---';
    }

    public function getOrganizationCampusNameAttribute()
    {
        return !is_null(OrganizationCampus::find($this->organization_campus_id)) ? OrganizationCampus::find($this->organization_campus_id)->name : '---';
    }

    public function getDepartmentNameAttribute()
    {
        return !is_null(Department::find($this->department_id)) ? Department::find($this->department_id)->name : '---';
    }

    public function getDesignationNameAttribute()
    {
        return !is_null(Designation::find($this->designation_id)) ? Designation::find($this->designation_id)->name : '---';
    }
    public function getRoleNameAttribute()
    {
        return !is_null(Role::find($this->role_id)) ? Role::find($this->role_id)->name : '---';
    }

    /* ----------------------------------- Relationships ---------------------------------------------------- */

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }
    public function designation()
    {
        return $this->belongsTo('App\Models\Designation');
    }
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }
    public function campus()
    {
        return $this->belongsTo(OrganizationCampus::class, 'organization_campus_id', 'id');
    }
    public function userDepartments()
    {
        return $this->hasMany('App\Models\DepartmentUser');
    }
}
