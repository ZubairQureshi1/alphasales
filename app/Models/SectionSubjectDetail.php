<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SectionSubjectDetail extends Model
{
    protected $table = 'section_subject_details';

    protected $guarded = [];

    protected $appends = ['section_name'];

    public function section()
    {
    	return $this->belongsTo('App\Models\Section');
    }

    public function sectionTeachers()
    {
    	return $this->hasMany('App\Models\SectionTeacher');
    }

    public function sectionDetail()
    {
        return $this->belongsTo('App\Models\SectionDetail');
    }

    public function getSectionNameAttribute()
    {
        return SectionDetail::where('id', $this->section_detail_id)->first()->section_name ?? '---';
    }

}
