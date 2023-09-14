<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Assignment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'title', 'topic', 'due_date', 'attachment_url', 'part_id',
    ];
}
