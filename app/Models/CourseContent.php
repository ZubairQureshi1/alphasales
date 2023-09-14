<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class CourseContent extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $appends = ['user_name'];

    protected $fillable = [
        'course_id', 'semester_id', 'subject_id',
        'lecture_days', 'week_id', 'session_id',
        'planned_contents', 'planned_activities', 'date', 'status', 'user_id',
    ];

    public function getUserNameAttribute()
    {
        $user_name = ucfirst(User::find($this->user_id)->name);
        return $user_name;
    }

}
