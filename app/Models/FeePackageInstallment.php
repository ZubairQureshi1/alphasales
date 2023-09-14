<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FeePackageInstallment extends Model implements Auditable
{

    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'fee_package_installments';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'net_total',
        'course_duration',
        'no_of_semesters',
        'duration_per_semester',
        'installment_interval',
        'no_0f_installments',
        'amount_per_installment',
        'due_date',
        'paid_amount',
        'paid_date',
        'extension_date',
        'remarks',
        'status_id',
        'status_name',
        'package_id',
        'voucher_id',
        'voucher_code',
        'late_fee_fine',
        'remaining_balance',
        'remaining_balance_late_fine',
        'remaining_balance_paid_date',
        'amount_with_fine',
        'remaining_balance_voucher_id',
        'total_remaining_balance',
        'total_amount_collected',
        'carry_forwarded',
        'is_carry_forwarded',
        'user_name',
        'user_id',
        'is_varified',
        'payment_verification',
        'payment_verified_by',
        'varified_by',
    ];

    protected $casts = [
        'net_total' => 'string',
        'course_duration' => 'string',
        'no_of_semesters' => 'string',
        'duration_per_semester' => 'string',
        'installment_interval' => 'string',
        'no_0f_installments' => 'string',
        'amount_per_installment' => 'string',
        'due_date' => 'string',
        'due_date' => 'string',
        'paid_amount' => 'string',
        'paid_date' => 'string',
        'extension_date' => 'string',
        'remarks' => 'string',
        'status_id' => 'integer',
        'status_name' => 'string',
        'package_id' => 'integer',
        'voucher_id' => 'string',
        'voucher_code' => 'integer',
        'late_fee_fine' => 'string',
        'remaining_balance' => 'string',
        'remaining_balance_late_fine' => 'string',
        'remaining_balance_paid_date' => 'string',
        'amount_with_fine' => 'string',
        'remaining_balance_voucher_id' => 'string',
        'total_remaining_balance' => 'string',
        'total_amount_collected' => 'string',
        'carry_forwarded' => 'string',
        'is_carry_forwarded' => 'string',
        'user_name' => 'string',
        'user_id' => 'integer',
        'is_varified' => 'boolean',
        'payment_verification' => 'boolean',
        'varified_by' => 'string',
        'payment_verified_by' => 'string',
    ];

    public static $rules = [

        'net_total' => 'required',
        'no_0f_installments' => 'required',
        'amount_per_installment' => 'required',

    ];

    public function feeVoucher()
    {
        return $this->belongsTo('App\Models\FeeVoucher', 'voucher_id');
    }

    public function feePackage()
    {
        return $this->belongsTo('App\Models\FeePackage', 'package_id');
    }

    public function feeFines()
    {
        return $this->hasMany('App\Models\FeeFine', 'installment_id');
    }

    public function feeOtherCharges()
    {
        return $this->hasMany('App\Models\FeePackageOtherCharge');
    }

}
