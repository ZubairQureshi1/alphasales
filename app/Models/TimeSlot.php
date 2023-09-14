<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TimeSlot extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'time_slots';

    protected $dates = ['deleted_at'];
    protected $appends = ['name_with_time'];

    public $fillable = [
        'name',
        'start_time',
        'end_time',
        'buffer_start_time',
        'buffer_end_time',
        'slot_type_id',
        'slot_type_name',
        'organization_campus_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'start_time' => 'string',
        'end_time' => 'string',
        'buffer_start_time' => 'string',
        'buffer_end_time' => 'string',
        'slot_type_id' => 'integer',
        'slot_type_name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'start_time' => 'required',
        'end_time' => 'required',
        'buffer_start_time' => 'required',
        'buffer_end_time' => 'required',
        'slot_type_id' => 'required',
        'slot_type_name' => 'required',
    ];

    public function getNameWithTimeAttribute()
    {
        $name_with_time = $this->name . ' - (' . $this->start_time . ' - ' . $this->end_time . ')';
        return $name_with_time;
    }

}
