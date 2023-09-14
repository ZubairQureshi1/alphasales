<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Session extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    use SoftDeletes;

    public $table = 'sessions';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'session_name',
        'session_start_date',
        'session_end_date',
        'quota',
        'organization_id',
        'affiliated_body_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'session_name' => 'string',
        'session_start_date' => 'string',
        'session_end_date' => 'string',
        'quota' => 'number',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'session_name' => 'required',
        'session_start_date' => 'required',
        'session_end_date' => 'required',
        'courses' => 'required',
        'quota' => 'required',
    ];

    public function sessionCourses()
    {
        return $this->hasMany('App\Models\SessionCourse')->groupBy('course_id');
    }
    public function sessionCourseCampuses()
    {
        return $this->hasMany(SessionCourse::class, 'session_id', 'id');
    }
    public function userAllowedSessions()
    {
        return $this->hasMany(UserAllowedSession::class, 'session_id', 'id');
    }
    public function getSessionCampusesByCourse($course_id)
    {
        return $this->hasMany(SessionCourse::class, 'session_id', 'id')->where('course_id', $course_id)->get();
    }
    public function enquiries()
    {
        return $this->hasMany('App\Models\Enquiry');
    }
}
