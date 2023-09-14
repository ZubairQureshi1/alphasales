<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class HeadFineStudent extends Model implements Auditable
{
    public $table = 'head_fine_students';
    use \OwenIt\Auditing\Auditable;

    protected $dates = ['deleted_at'];
    protected $appends = ['head_name'];

    public $fillable = [
        'head_id',
        'student_id',
        'package_id',
        'installment_id',
        'status_name',
        'discount_in_amount',
        'amount_after_discount',
        'status_id',
        'discount_in_percentage',
        'due_date',
        'paid_date',
        'voucher_code',
        'user_name',
        'user_id',
        'late_fee_fine',
        'remaining_balance',
        'remaining_balance_late_fine',
        'remaining_balance_paid_date',
        'amount_with_fine',
        'remaining_balance_voucher_id',
        'total_remaining_balance',
        'total_amount_collected',
        'carry_forwarded',
        'paid_amount',
        'is_carry_forwarded',
        'is_order_placed',
        'date_of_order_delivered',
        'head_amount',
        'academic_history_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'head_id' => 'integer',
        'student_id' => 'integer',
        'package_id' => 'integer',
        'installment_id' => 'integer',
        'discount_in_amount' => 'string',
        'amount_after_discount' => 'string',
        'status_name' => 'string',
        'status_id' => 'integer',
        'discount_in_percentage' => 'string',
        'due_date' => 'string',
        'paid_date' => 'string',
        'voucher_code' => 'string',
        'user_name' => 'string',
        'user_id' => 'integer',
        'late_fee_fine' => 'string',
        'remaining_balance' => 'string',
        'remaining_balance_late_fine' => 'string',
        'remaining_balance_paid_date' => 'string',
        'amount_with_fine' => 'string',
        'remaining_balance_voucher_id' => 'string',
        'total_remaining_balance' => 'string',
        'total_amount_collected' => 'string',
        'carry_forwarded' => 'string',
        'paid_amount' => 'string',
        'is_carry_forwarded' => 'string',
        'is_order_placed' => 'boolean',
        'date_of_order_delivered' => 'datetime',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'head_id' => 'required',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function headFine()
    {
        return $this->belongsTo('App\Models\HeadFine', 'head_id');
    }
    public function feeVoucher()
    {
        return $this->belongsTo('App\Models\FeeVoucher');
    }
    public function getHeadNameAttribute()
    {
        $head = HeadFine::find($this->head_id);
        return $head['name'];
    }

    public function getHeadAmountAttribute($value)
    {
        if ($value == null) {
            $head = HeadFine::find($this->head_id);
            return $head['amount'];
        }
        return $value;
    }

}
