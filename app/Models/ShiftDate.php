<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ShiftDate extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'shift_dates';

    public $fillable = [
        'date',
        'shift_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shift_id' => 'integer',
        'date' => 'date',

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
}
