<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FeeFineVoucher extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'fee_fine_vouchers';

    public $fillable = [
        'voucher_code',
        'fee_fine_id',

    ];

    public function feeFine()
    {
        return $this->belongsTo('App\Models\FeeFine');
    }
}
