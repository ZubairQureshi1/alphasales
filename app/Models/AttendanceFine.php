<?php

namespace App\Models;

use App\Models\Attendance;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AttendanceFine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'attendance_fines';
    protected $appends = ['absent_days', 'absent_count'];
    public $fillable = [
        'amount',
        'paid_amount',
        'balance',
        'voucher_number',
        'fee_voucher_id',
        'package_id',
        'installment_id',
        'due_date',
        'paid_date',
        'amount_waived',
        'amount_after_waived',
        'previous_reference',
        'next_reference',
        'student_id',
        'from_date',
        'to_date',
        'academic_history_id',
        'attendance_fine_voucher_id',
    ];

    public function getAbsentDaysAttribute()
    {
        $from_date = new \DateTime($this->from_date);
        $to_date = new \DateTime($this->to_date);
        if ($from_date->format('M') == $to_date->format('M')) {
            $absent_days = Attendance::where('student_id', '=', $this->student_id)->where('status_id', '=', 0)->where('date', '>=', $from_date)->where('date', '<=', $to_date)->orderBy('date', 'asc')->get(['date'])->toArray();
        } else {
            $absent_days = Attendance::where('student_id', '=', $this->student_id)->where('status_id', '=', 0)->where('date', '>=', $from_date)->where('date', '<=', $to_date)->orderBy('date', 'asc')->get(['date'])->toArray();
        }
        return $absent_days;
    }
    public function getAbsentCountAttribute()
    {
        $from_date = new \DateTime($this->from_date);
        $to_date = new \DateTime($this->to_date);
        $absent_days = Attendance::where('student_id', '=', $this->student_id)->where('status_id', '=', 0)->where('date', '>=', $from_date)->where('date', '<=', $to_date)->get()->count();
        return $absent_days;
    }
}
