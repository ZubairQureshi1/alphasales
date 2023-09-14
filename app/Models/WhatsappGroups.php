<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WhatsappGroups extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'whatsapp_groups';

    protected $fillable = [
        'name',
        'description'
    ];
}
