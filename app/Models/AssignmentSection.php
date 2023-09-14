<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AssignmentSection extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'section_id', 'assignment_id',
    ];
}
