<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ExamFineVoucher extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'exam_fine_vouchers';

    public $fillable = [
        'voucher_code',
        'exam_fine_id',

    ];
}
