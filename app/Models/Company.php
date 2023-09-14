<?php

namespace App\Models;



use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
      protected $fillable = [
        'company_name', 'company_code', 'company_year_start','company_year_end','address', 'description'
    ];


      public function branches()
   {
       return $this->hasMany('App\Branch');
   }

     public function location()
   {
       return $this->hasOne('App\Location');
   }
    public function jobtitles()
   {
       return $this->hasMany('App\JobTitle');
   }
   


}
