<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DepartmentUser extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'department_users';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'department_name',
        'user_name',
        'department_id',
        'user_id',
        'user_campus_detail_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'department_name' => 'string',
        'user_name' => 'string',
        'department_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'department_name' => 'required',
        'user_name' => 'required',
        'department_id' => 'required',
        'user_id' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function campusDetail()
    {
        return $this->belongsTo('App\Models\UserCampusDetail');
    }
}
