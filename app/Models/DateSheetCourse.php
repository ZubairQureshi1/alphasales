<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class DateSheetCourse extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['course_name'];
    public $fillable = [
        'course_id', 'date_sheet_id',
    ];

    public function getCourseNameAttribute()
    {
        $course = Course::find($this->course_id);
        return $course->name;
    }
}
