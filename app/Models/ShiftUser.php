<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ShiftUser extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'shift_users';

    public $fillable = [
        'shift_id',
        'user_id',
        'is_shift_active',
        'has_shift_swap',
        'shift_swap_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shift_id' => 'integer',
        'user_id' => 'integer',
        'is_shift_active' => 'boolean',
        'has_shift_swap' => 'boolean',
        'shift_swap_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function shift()
    {
        return $this->belongsTo('App\Models\Shift');
    }
    public function shiftSwaps()
    {
        return $this->hasMany('App\Models\ShiftSwap');
    }
}
