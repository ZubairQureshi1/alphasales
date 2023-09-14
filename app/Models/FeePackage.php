<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FeePackage extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'fee_packages';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'total_package',
        'discount',
        'net_tuition_fee',
        'student_id',
        'discount_status',
        'discount_status_id',
        'discount_percentage',
        'status_id',
        'status_name',
        'voucher_id',
        'voucher_code',
        'total_amount',
        'amount_piad',
        'cfe_admission_fee',
        'fee_structure_type_id',
        'miscellaneous_amount',
        'user_name',
        'user_id',
        'is_varified',
        'varified_by',
    ];

    protected $casts = [
        'total_package' => 'string',
        'discount' => 'string',
        'net_tuition_fee' => 'string',
        'student_id' => 'integer',
        'discount_status_id' => 'integer',
        'discount_status' => 'string',
        'discount_percentage' => 'string',
        'status_name' => 'string',
        'status_id' => 'integer',
        'voucher_id' => 'string',
        'voucher_code' => 'integer',
        'total_amount' => 'string',
        'amount_piad' => 'string',
        'cfe_admission_fee' => 'string',
        'fee_structure_type_id' => 'integer',
        'miscellaneous_amount' => 'string',
        'user_name' => 'string',
        'user_id' => 'integer',
        'is_varified' => 'boolean',
        'varified_by' => 'string',

    ];

    public static $rules = [
        'total_package' => 'required',
        'discount' => 'required',
        'net_tuition_fee' => 'required',

    ];

    public function feeVoucher()
    {
        return $this->belongsTo('App\Models\FeeVoucher', 'voucher_id');
    }
    public function feePackageInstallments()
    {
        return $this->hasMany('App\Models\FeePackageInstallment', 'package_id');
    }
    public function student()
    {
        return $this->belongsTo('App\Models\Student', 'student_id');
    }
    public function feeFines()
    {
        return $this->hasMany('App\Models\FeeFine', 'package_id');
    }

    public function feeOtherCharges()
    {
        return $this->hasMany('App\Models\FeePackageOtherCharge', 'fee_package_id');
    }
}
