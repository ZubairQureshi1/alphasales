<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class AttendanceLog extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'attendance_logs';

    public $guarded = [];

    protected $casts = [
        'attendance_time' => 'string',
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

    ];

    public static $rules = [
        'attendance_time' => 'required',
        'type_name' => 'required',
    ];

}
