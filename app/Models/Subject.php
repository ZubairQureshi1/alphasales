<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Subject extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    public $table = 'subjects';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'name', 'code', 'subject_id', 'organization_id', 'wing_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'name' => 'required',
    ];

    public function courseSubjects()
    {
        return $this->hasMany('App\Models\CourseSubject');
    }

    public function timeSlotShifts()
    {
        return $this->hasMany('App\Models\Shift');
    }

}
