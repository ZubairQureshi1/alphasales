<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Attendance extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'attendances';
    protected $appends = ['month_year'];
    public $guarded = [];
    
    protected $casts = [
        'check_in_time' => 'string',
        'check_out_time' => 'string',
        'type_name' => 'string',
        'type_id' => 'integer',
        'emp_code' => 'string',
        'name' => 'string',
        'roll_number' => 'string',
        'time_slot_id' => 'integer',
        'time_slot_name' => 'string',
        'status' => 'string',
        'status_id' => 'integer',
        'punch_type' => 'string',
        'punch_type_id' => 'integer',
        'is_late_checkin' => 'boolean',
        'is_late_checkout' => 'boolean',
        'is_on_time_checkin' => 'boolean',
        'is_on_time_checkout' => 'boolean',
        'is_early_checkin' => 'boolean',
        'is_early_checkout' => 'boolean',
        'is_on_leave' => 'boolean',
        'is_day_off' => 'boolean',
        'is_on_travel' => 'boolean',
        'is_holiday' => 'boolean',
        'working_hours' => 'string',
        'academic_history_id' => 'integer',

    ];

    public static $rules = [
        'check_in_time' => 'required',
        'check_out_time' => 'required',
        'type_name' => 'required',

    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function timeslot()
    {
        return $this->belongsTo('App\Models\TimeSlot');
    }

    public function getMonthYearAttribute()
    {
        $date = new \DateTime($this->date);
        $month_year = $date->format('M, Y');
        return $month_year;
    }
}
