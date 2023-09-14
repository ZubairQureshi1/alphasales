<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AssignmentResult extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'assignment_id', 'subject_id', 'student_id', 'total_marks', 'obtain_marks', 'percentage',
    ];
}
