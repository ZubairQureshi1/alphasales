<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionDetail extends Model
{
    protected $guarded = [];

    protected $table = 'section_details';

    public function section()
    {
    	return $this->belongsTo('App\Models\Section');
    }

    public function sectionTeachers()
    {
        return $this->hasMany('App\Models\SectionTeacher');
    }

    public function sectionSubjectDetails()
    {
    	return $this->hasMany('App\Models\SectionSubjectDetail');
    }

    public function studentBooks()
    {
        return $this->hasMany('App\Models\StudentBook');
    }

}
