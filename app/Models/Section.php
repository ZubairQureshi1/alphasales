<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    protected $guarded = [];

    protected $table = 'sections';

    protected $appends = ['academic_wing_name', 'session_name', 'course_name', 'affiliated_body_name', 'total_strength'];

    public function sectionDetails()
    {
        return $this->hasMany('App\Models\SectionDetail');
    }

    public function studentBooks()
    {
        return $this->hasMany('App\Models\StudentBook', 'section_id', 'id');
    }

    public function sectionTeachers()
    {
        return $this->hasMany('App\Models\SectionTeacher');
    }

    public function sectionSubjectDetails()
    {
        return $this->hasMany('App\Models\SectionSubjectDetail');
    }

    public function getAcademicWingNameAttribute()
    {
        return !is_null(Wing::find($this->academic_wing_id)) ? Wing::find($this->academic_wing_id)->name : '----';
    }

    public function getSessionNameAttribute()
    {
        return !is_null(Session::find($this->session_id)) ? Session::find($this->session_id)->session_name : '----';
    }

    public function getCourseNameAttribute()
    {
        return !is_null(SessionCourse::where('course_id', $this->course_id)) ? SessionCourse::where('course_id', $this->course_id)->first()->course_name : '----';
    }

    public function getAffiliatedBodyNameAttribute()
    {
        return !is_null(AffiliatedBody::find($this->affiliated_body_id)) ? AffiliatedBody::find($this->affiliated_body_id)->name : '----';
    }

    public function getTotalStrengthAttribute()
    {
        return SectionDetail::where('section_id', $this->id)->sum('section_strength') ?? '---';
    }
}
