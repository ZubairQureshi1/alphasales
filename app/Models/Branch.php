<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
      protected $fillable = [
        'branch_code', 'company_id','location_id', 'country', 'city', 'descripton'
    ];


    public function company(){
    	return $this->belongsTo('App\Company');
    }


    public function location(){
    	return $this->hasOne('App\Location');
    }
    public function jobtitles(){
    	return $this->hasMany('App\JobTitle');
    }
}
