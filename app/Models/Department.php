<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Department extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;
    public $table = 'departments';

    protected $appends = ['organization_name', 'organization_campus_name'];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name', 'code','organization_campus_id', 'organization_id'
    ];

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
        return !is_null(OrganizationCampus::find($this->organization_campus_id)) ? OrganizationCampus::find($this->organization_campus_id)->name : '---';
    }

    /* ------------------------------ RelationShips ----------------------------------*/

    public function departmentUsers()
    {
        return $this->hasMany('App\Models\DepartmentUser');
    }

    public function organization()
    {
        return $this->belongsTo('App\Models\Organization');
    }
    public function organizationCampus()
    {
        return $this->belongsTo('App\Models\OrganizationCampus');
    }

    public function scopeActive($query, $status)
    {
        return $query->where('is_active', $status);
    }

    public function scopeCampus($query, $campus)
    {
        return $query->where('organization_campus_id', $campus);
    }

}
