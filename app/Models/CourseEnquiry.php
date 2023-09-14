<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseEnquiry extends Model implements Auditable
{
    use SoftDeletes;
    use \OwenIt\Auditing\Auditable;

    public $table = 'course_enquiries';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'course_id',
        'enquiry_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'course_id' => 'integer',
        'enquiry_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_id' => 'required',
        'enquiry_id' => 'required',
    ];

    public function course()
    {
        return $this->belongsTo('App\Models\Course');
    }
    public function enquiry()
    {
        return $this->belongsTo('App\Models\Enquiry');
    }
}
