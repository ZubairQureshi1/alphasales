<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AssignmentSubject extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'subject_id', 'assignment_id',
    ];
}
