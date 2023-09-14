<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class FeeFine extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'fee_fines';

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
        'academic_history_id',

    ];

    protected $casts = [
        'amount' => 'string',
        'paid_amount' => 'string',
        'balance' => 'string',
        'voucher_number' => 'string',
        'fee_voucher_id' => 'integer',
        'package_id' => 'string',
        'installment_id' => 'string',
        'due_date' => 'date',
        'paid_date' => 'date',
    ];

    public static $rules = [
    ];

    public function feeFineVoucher()
    {
        return $this->belongsTo('App\Models\FeeVoucher');
    }
    public function feePackageInstallment()
    {
        return $this->belongsTo('App\Models\FeePackageInstallment');
    }
}
