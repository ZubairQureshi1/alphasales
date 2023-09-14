<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AttendanceFineVoucher extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'attendance_fine_vouchers';

    public $fillable = [
        'voucher_code',
        'attendance_fine_id',

    ];

}
