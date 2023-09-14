<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class GroupContacts extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'group_contacts';

    protected $fillable = [
        'contact_id',
        'group_id'
    ];
}
