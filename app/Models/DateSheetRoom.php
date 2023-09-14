<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheetRoom extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'room_id', 'date_sheet_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'room_id' => 'integer',
        'date_sheet_id' => 'integer',
    ];
}
