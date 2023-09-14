<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FeePackageOtherCharge extends Model
{
    use SoftDeletes;

    protected $guarded = [];

    public function feePackage()
    {
    	return $this->belongsTo('App\Models\FeePackage', 'fee_package_id');
    }

    public function feeInstallment()
    {
    	return $this->belongsTo('App\Models\FeePackageInstallment', 'fee_package_installment_id');
    }
}
