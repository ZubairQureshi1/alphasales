<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Location extends Model implements Auditable
{
    //
    use \OwenIt\Auditing\Auditable;
    protected $fillable = [
        'address', 'company_id', 'branch_id', 'branch_code',
    ];

    public function company()
    {
        return $this->belongsTo('App\Company');
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
}
