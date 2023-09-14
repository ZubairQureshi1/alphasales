<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentInstallmentPlan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'student_id', 'fee_package_id', 'student_academic_history_id', 'no_of_installments', 'approval_by_id',
    ];
}
