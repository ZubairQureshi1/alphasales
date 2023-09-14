<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Organization extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'name', 'short_name', 'description',
    ];

    // ------------------------ Accessors for text fields which capitalize first letter ----------------------

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getShortNameAttribute($value)
    {
        return strtoupper($value);
    }

    public function getDescriptionAttribute($value)
    {
        return ucwords($value);
    }

    // ------------------------ mutators for text fields which capitalize first letter while saving ----------------------

    public function setNameAttribute($value)
    {
        $this->attributes['name'] = ucwords($value);
    }

    public function setShortNameAttribute($value)
    {
        $this->attributes['short_name'] = strtoupper($value);
    }

    public function setDescriptionAttribute($value)
    {
        $this->attributes['description'] = ucwords($value);
    }
}
