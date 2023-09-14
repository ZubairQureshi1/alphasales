<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class JobTitle extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $fillable = [
        'serial_no', 'name', 'description', 'organization_id',
    ];

    public function getOrganizationNameAttribute()
    {
        return !is_null(Organization::find($this->organization_id)) ? Organization::find($this->organization_id)->name : '---';
    }

}
