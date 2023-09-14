<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class OrganizationCampusWing extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    //
    public function wing()
    {
        return $this->belongsTo(Wing::class, 'wing_id', 'id');
    }
}
