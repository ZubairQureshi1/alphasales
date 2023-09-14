<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AssignmentCourse extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'course_id', 'assignment_id',
    ];
}
