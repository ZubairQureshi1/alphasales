<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class FeeVoucher extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'fee_vouchers';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'voucher_code',
        'package_id',
        'installment_id',
        'fine_id',
        'head_fine_student_id',

    ];

    protected $casts = [
        'voucher_code' => 'string',
        'package_id' => 'integer',
        'installment_id' => 'integer',
        'fine_id' => 'integer',
        'head_fine_student_id' => 'integer',

    ];

    public static $rules = [
        'voucher_code' => 'required',

    ];

    public function feePackageInstallment()
    {
        return $this->belongsTo('App\Models\FeePackageInstallment', 'installment_id');
    }

    public function feePackage()
    {
        return $this->belongsTo('App\Models\FeePackage', 'package_id');
    }

    public function fine()
    {
        return $this->belongsTo('App\Models\Fine', 'fine_id');
    }

}
