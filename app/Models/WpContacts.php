<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WpContacts extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'wp_contacts';

    protected $fillable = [
        'name', 'phone_number'
    ];
}
