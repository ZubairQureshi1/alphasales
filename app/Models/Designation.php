<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Designation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'designations';
    protected $appends = ['organization_name', 'organization_campus_name', 'department_name',];

    protected $dates = ['deleted_at'];

    protected $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'code' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'code' => 'required',
    ];

    public function getOrganizationNameAttribute()
    {
        return !is_null(Organization::find($this->organization_id)) ? Organization::find($this->organization_id)->name : '---';
    }

    public function getOrganizationCampusNameAttribute()
    {
        return count($this->campuses) > 0 ? $this->campuses()->get()->first()['organization_campus_name'] : '---';
    }

    public function getDepartmentNameAttribute()
    {
        return !is_null(Department::find($this->department_id)) ? Department::find($this->department_id)->name : '---';
    }

    /* ------------------------------- RelationShips ------------------------- */

    public function userDesignations()
    {
        return $this->hasMany('App\Models\UserDesignation');
    }

    public function departments()
    {
        return $this->hasMany('App\Models\DesignationDepartment');
    }

    public function campuses()
    {
        return $this->hasMany('App\Models\DesignationDepartment')->groupBy('organization_campus_id');
    }
}
