<?php

namespace App\Models;

use App\Models\Department;
use Illuminate\Database\Eloquent\Model;

class DesignationDepartment extends Model
{
    protected $guarded = [];

    protected $appends = ['department_name', 'organization_campus_name'];

    protected $table = 'designation_departments';

    public function getDepartmentNameAttribute()
    {
    	return !is_null(Department::find($this->department_id)) ? Department::find($this->department_id)->name : '---';
    }

    public function getOrganizationCampusNameAttribute()
    {
        return !is_null(OrganizationCampus::find($this->organization_campus_id)) ? OrganizationCampus::find($this->organization_campus_id)->name : '---';
    }

    public function department()
    {
    	return $this->belongsTo('App\Models\Department');
    }
}
