<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class UserDesignation extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'user_designations';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'designation_name',
        'user_name',
        'designation_id',
        'user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'designation_name' => 'string',
        'user_name' => 'string',
        'designation_id' => 'integer',
        'user_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'designation_name' => 'required',
        'user_name' => 'required',
        'designation_id' => 'required',
        'user_id' => 'required',
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function designation()
    {
        return $this->belongsTo('App\Models\Designation');
    }
}
