<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Shift extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'shifts';

    protected $dates = ['deleted_at'];

    public $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        // 'time_slot_id' => 'integer',
        'date' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];

    public function timeslot()
    {
        return $this->belongsTo('App\Models\TimeSlot');
    }
    public function shiftUsers()
    {
        return $this->hasMany('App\Models\ShiftUser');
    }
    public function shiftDates()
    {
        return $this->hasMany('App\Models\ShiftDate');
    }
    public function shiftWorkingDays()
    {
        return $this->hasMany('App\Models\ShiftWorkingDay');
    }
    public function shiftSwaps()
    {
        return $this->hasMany('App\Models\ShiftSwap');
    }
}
