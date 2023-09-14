<?php

namespace App\Models;

use App\Models\Course;
use App\Models\Section;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SectionCourse extends Model implements Auditable
{

    use \OwenIt\Auditing\Auditable;
    public $table = 'section_courses';
    protected $appends = ['section_name', 'course_name'];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'section_id',
        'course_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'section_id' => 'integer',
        'course_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'section_id' => 'required',
        'course_id' => 'required',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }

    public function getSectionNameAttribute()
    {
        $name = Section::find($this->section_id);
        return $name['name'];
    }

    public function getCourseNameAttribute()
    {
        $name = Course::find($this->course_id);
        return $name['name'];
    }
}
