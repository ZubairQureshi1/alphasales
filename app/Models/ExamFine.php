<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ExamFine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'exam_fines';

    protected $appends = ['exam_type_name'];

    public $fillable = [
        'exam_type_id',
        'date_sheet_id',
        'student_academic_history_id',
        'amount',
        'paid_amount',
        'balance',
        'voucher_number',
        'due_date',
        'paid_date',
        'amount_waived',
        'amount_after_waived',
        'previous_reference',
        'next_reference',
        'student_id',
        'exam_fine_voucher_id',
    ];

    public function getExamTypeNameAttribute()
    {
        return ExamType::find($this->exam_type_id)->exam_type;
    }

}
