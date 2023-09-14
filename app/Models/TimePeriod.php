<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TimePeriod extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'time_periods';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'course_id',
        'subject_id',
        'section_id',
        'semester_id',
        'session_id',
        'time_slot_id',
        'room_id',
        'user_id',
        'start_date',
        'is_repeat',
        'end_date',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

        'course_id' => 'integer',
        'subject_id' => 'integer',
        'section_id' => 'integer',
        'time_slot_id' => 'integer',
        'room_id' => 'integer',
        'start_date' => 'string',
        'is_repeat' => 'integer',
        'semester_id' => 'integer',
        'session_id' => 'integer',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_id' => 'required',
        'subject_id' => 'required',
        'section_id' => 'required',
        'time_slot_id' => 'required',
        'room_id' => 'required',
        'start_date' => 'required',
        'is_repeat' => 'required',
        'session_id' => 'required',
        'semester_id' => 'required',
    ];

    public function Course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }
    public function Subject()
    {
        return $this->belongsTo(Subject::class, 'subject_id', 'id');
    }
    public function Section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }
    public function timePeriodSubjectWeekDays()
    {
        return $this->hasMany(TimePeriodSubjectWeekDay::class, 'time_period_id', 'id');
    }
    public function timeSlot()
    {
        return $this->belongsTo(TimeSlot::class, 'time_slot_id', 'id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id', 'id');
    }
}
