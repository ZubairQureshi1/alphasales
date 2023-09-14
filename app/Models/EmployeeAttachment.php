<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EmployeeAttachment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'attachment_name', 'attachment_type', 'attachment_type_id', 'attachment_url', 'attachment_from', 'attachment_for',
    ];
}
