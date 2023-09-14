<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Room extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'rooms';

    public $fillable = [
        'name',
        'sitting_capacity',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',

        'sitting_capacity' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

}
