<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class TimePeriodSubjectWeekDay extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'time_period_subject_week_days';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'time_period_id',
        'week_day_id',
        'week_day_name',

    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [

        'time_period_id' => 'integer',
        'week_day_id' => 'integer',

        'week_day_name' => 'string',

    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'time_period_id' => 'required',
    ];
}
