<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EnquiryWorker extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'enquiry_workers';

    public $fillable = [
        'enquiry_id', 'factory_name','worker_name' ,'worker_experience_in_years', 'worker_experience_in_months', 'worker_designation', 'is_eobi', 'is_social_security', 'is_factory_registered', 'worker_work_type', 'worker_work_type_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'factory_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'code' => 'required',
    ];

    public function departmentUsers()
    {
        return $this->hasMany('App\Models\DepartmentUser');
    }
}
