<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WhatsappMessageLog extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'whatsapp_message_log';

    protected $fillable = [
        'message',
        'number',
        'request',
        'response',
        'gateway'
    ];
}
