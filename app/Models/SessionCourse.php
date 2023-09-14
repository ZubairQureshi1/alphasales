<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class SessionCourse extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table      = 'session_courses';
    protected $appends = ['session_name', 'course_name', 'affiliated_body_name', 'academic_term_name'];

    protected $dates = ['deleted_at'];

    public $fillable = [
        'session_id',
        'course_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'session_id' => 'integer',
        'course_id'  => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'session_id' => 'required',
        'course_id'  => 'required',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function session()
    {
        return $this->belongsTo('App\Models\Session');
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'course_id', 'course_id');
    }

    public function getSessionNameAttribute()
    {
        $name = Session::find($this->session_id);
        if (empty($name)) {
            return "---";
        }
        return $name['session_name'];
    }

    public function getCourseNameAttribute()
    {
        $name = Course::find($this->course_id);
        if (empty($name)) {
            return "---";
        }
        return $name['name'];
    }
    public function getAffiliatedBodyNameAttribute()
    {
        $name = AffiliatedBody::find($this->affiliated_body_id);
        if (empty($name)) {
            return "---";
        }
        return $name['name'];
    }
    public function getAcademicTermNameAttribute()
    {
        $name = config('constants.academic_terms')[$this->academic_term_id];
        if (empty($name)) {
            return "---";
        }
        return $name;
    }
    public function campus()
    {
        return $this->belongsTo(OrganizationCampus::class, 'organization_campus_id', 'id');
    }
    public function sessionCourseSubjects()
    {
        return $this->hasMany(SessionCourseSubject::class, 'session_course_id', 'id');
    }
    public function sessionCourseSubjectGroups($key = null, $value = null)
    {
        if ($key) {
            return $this->hasMany(SessionCourseSubject::class, 'session_course_id', 'id')->where($key, $value)->groupBy('subject_id');
        }
        return $this->hasMany(SessionCourseSubject::class, 'session_course_id', 'id')->groupBy('subject_id');
    }
    public function sessionCourseSubjectAnnualSemesterGroups()
    {
        return $this->hasMany(SessionCourseSubject::class, 'session_course_id', 'id')->groupBy('annual_semester');
    }

    public function getSessionStartYear()
    {
        $date = new \DateTime($this->session_start_date);
        if (empty($date)) {
            return "---";
        }
        return $date->format('Y');
    }

    public function isActive()
    {
        return $this->is_active == 1 ? true : false;
    }
    // Scopes

    public function scopeWingWise($query, $wing_ids)
    {
        return $query->whereIn('wing_id', $wing_ids);
    }
}
