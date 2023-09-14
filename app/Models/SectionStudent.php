<?php

namespace App\Models;

use App\Models\Section;
use App\Models\Student;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class SectionStudent extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'section_students';
    protected $appends = ['section_name', 'student_name'];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'section_id',
        'student_id', 'organization_campus_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'section_id' => 'integer',
        'student_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'section_id' => 'required',
        'student_id' => 'required',
    ];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function section()
    {
        return $this->belongsTo('App\Models\section');
    }

    public function getSectionNameAttribute()
    {
        $name = Section::find($this->section_id);
        return $name['name'];
    }

    public function getStudentNameAttribute()
    {
        $name = Student::find($this->student_id);
        return $name['student_name'];
    }
}
