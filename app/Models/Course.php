<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class Course extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'courses';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name', 'plot_size', 'plot_size_number', 'nature_plot', 'plot_type', 'other_plot_type', 'project', 'duration', 'no_of_semesters', 'duration_per_semster', 'course_code', 'vendor_share_amount', 'degree_level_id', 'organization_id', 'wing_id',

    ];


    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'size_kanal' => 'integer',
        'size_marla' => 'integer',
        'nature_plot' => 'string',
        'project' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
        'size_kanal' => 'required',
        'size_marla' => 'required',
        'nature_plot' => 'required',
        'project' => 'required',
    ];

    public function courseEnquiries()
    {
        return $this->hasMany('App\Models\CourseEnquiry');
    }

    public function courseSubjects()
    {
        return $this->hasMany('App\Models\CourseSubject');
    }
    public function courseSessions()
    {
        return $this->hasMany('App\Models\SessionCourse', 'course_id');
    }
    public function sectionCourses()
    {
        return $this->hasMany('App\Models\SectionCourse');
    }
    public function courseAffiliatedBodies()
    {
        return $this->hasMany(CourseAffiliatedBody::class, 'course_id', 'id');
    }
}
