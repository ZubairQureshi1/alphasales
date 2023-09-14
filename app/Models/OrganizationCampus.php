<?php

namespace App\Models;

use Globals;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrganizationCampus extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $appends = ['city_name', 'organization_name', 'name_for_ids'];

    protected $fillable = [
        'name', 'code', 'city_id', 'organization_id', 'old_organization_id', 'address',
    ];

    /* ------------------ RelationShips ----------------------*/

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function location()
    {
        return $this->hasOne('App\Location');
    }
    public function jobtitles()
    {
        return $this->hasMany('App\JobTitle');
    }

    public function designations()
    {
        return $this->hasMany('App\Models\Designation');
    }

    public function organizationCampusWings()
    {
        return $this->hasMany(OrganizationCampusWing::class, 'organization_campus_id', 'id');
    }
    public function organizationCampusDepartments()
    {
        return $this->hasMany('App\Models\Department');
    }

    /* -------------------- Appends ----------------------- */

    public function getCityNameAttribute()
    {
        return empty(City::find($this->city_id)) ? '---' : ucwords(City::find($this->city_id)->name);
    }
    public function getOrganizationNameAttribute()
    {
        return empty(Organization::find($this->organization_id)) ? '---' : ucwords(Organization::find($this->organization_id)->name);
    }

    public function getNameForIdsAttribute()
    {
        return Globals::replaceSpecialChar($this->name);
    }

    // ------------------------ Accessors for text fields which capitalize first letter ----------------------

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getAddressAttribute($value)
    {
        return ucwords($value);
    }

    public function getCodeAttribute($value)
    {
        return strtoupper($value);
    }

    // ------------------------ mutators for text fields which capitalize first letter while saving ----------------------

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function setAddressAttribute($value)
    {
        $this->attributes['address'] = ucwords($value);
    }

    public function setCodeAttribute($value)
    {
        $this->attributes['code'] = strtoupper($value);
    }
}
