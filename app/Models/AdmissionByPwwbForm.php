<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AdmissionByPwwbForm extends Model
{
    protected $guarded = [];
    
    public function admission()
    {
    	return $this->belongsTo('App\Models\Admission');
    }

}
