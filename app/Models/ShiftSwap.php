<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ShiftSwap extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'shift_swaps';

    public $fillable = [
        'shift_id',
        'shift_user_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shift_id' => 'integer',
        'shift_user_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function shift()
    {
        return $this->belongsTo('App\shift');
    }

    public function shiftUser()
    {
        return $this->belongsTo('App\Models\ShiftUser');
    }
}
