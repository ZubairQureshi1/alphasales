<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ContactUS extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'contact_us';

    protected $fillable = [
        'name',
        'phone_number',
        'email',
    ];
}
