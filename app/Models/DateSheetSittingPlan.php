<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheetSittingPlan extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'invigilator', 'days', 'start_time', 'end_time', 'room_id', 'section_id', 'date_sheet_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'invigilator' => 'string',
        'days' => 'string',
        'start_time' => 'dateTime',
        'end_time' => 'dateTime',
        'room_id' => 'integer',
        'section_id' => 'integer',
        'date_sheet_id' => 'integer',
    ];
}
