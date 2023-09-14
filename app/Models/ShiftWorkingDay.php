<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ShiftWorkingDay extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    public $table = 'shift_working_days';

    public $fillable = [
        'shift_id',
        'week_day_id',
        'week_day',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'shift_id' => 'integer',
        'week_day_id' => 'integer',
        'week_day' => 'string',
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
        return $this->belongsTo('App\Models\Shift');
    }
}
