<?php

namespace App\Models;

use App\Models\SessionCourse;
use App\Models\SessionCourseSubject;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    
    protected $table = 'student_attendances';
    protected $guarded = [];

    protected $appends = ['section_name','room_name','wing_name', 'course_name', 'subject_name', 'subject_code', 'user_name'];

    public function student()
    {
        return $this->belongsTo('App\Models\Student');
    }
    public function attendanceDetails()
    {
    	return $this->hasMany('App\Models\StudentAttendanceDetail');
    }

    public function timeslot()
    {
        return $this->belongsTo('App\Models\TimeSlot');
    }
    
    public function section()
    {
        return $this->belongsTo('App\Models\Section');
    }
    public function room()
    {
        return $this->belongsTo('App\Models\Room');
    }
    public function wing()
    {
        return $this->belongsTo('App\Models\Wing');
    }
    public function studentBook()
    {
        return $this->belongsTo('App\Models\StudentBook');
    }
    public function sectionSubject()
    {
        return $this->belongsTo('App\Models\SectionSubjectDetail');
    }
    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function sessionCourseSubject()
    {
        return $this->belongsTo('App\Models\SessionCourseSubject');
    }
    public function affiliatedBody()
    {
        return $this->belongsTo('App\Models\AffiliatedBody');
    }
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function getSectionNameAttribute()
    {
        return SectionDetail::where('id', $this->section_detail_id)->first()->section_name ?? '---';
    }
    public function getSubjectNameAttribute()
    {
        $subject_id = SectionSubjectDetail::where('id', $this->section_subject_detail_id)->first()->subject_id;
        return  SessionCourseSubject::where('subject_id', $subject_id)->first()->subject_name ?? '---';
    }
    public function getSubjectCodeAttribute()
    {
        $subject_id = SectionSubjectDetail::where('id', $this->section_subject_detail_id)->first()->subject_id;
        return  SessionCourseSubject::where('subject_id', $subject_id)->first()->subject_code ?? '---';
    }

    public function getCourseNameAttribute()
    {
        return SessionCourse::where('course_id', SectionDetail::where('id', $this->section_detail_id)->first()->section->course_id)->get()->last()->course_name ?? '---';
    }

    public function getRoomNameAttribute()
    {
        return Room::find($this->room_id) != null ? Room::find($this->room_id)->name : '---';
    }

    public function getUserNameAttribute()
    {
        return \App\User::find($this->user_id)->display_name ?? '---';
    }
    
    public function getWingNameAttribute()
    {
        return Wing::find($this->academic_wing_id) != null ? Wing::find($this->academic_wing_id)->name : '---';
    }
}
