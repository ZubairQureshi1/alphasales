<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheetBook extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['subject_name'];

    public $fillable = [
        'subject_id', 'date', 'start_time', 'end_time', 'date_sheet_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'subject_id' => 'integer',
        'date' => 'date',
        'start_time' => 'dateTime',
        'end_time' => 'dateTime',
        'date_sheet_id' => 'integer',

    ];
    public function getSubjectNameAttribute()
    {
        $subject = Subject::find($this->subject_id);
        return $subject->name;
    }
}
