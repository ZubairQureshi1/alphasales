<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use OwenIt\Auditing\Contracts\Auditable;

class StudentAcademicHistory extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'student_academic_histories';
    use SoftDeletes;
    protected $dates = ['deleted_at'];

    public $guarded = [];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'course_name' => 'string',
        'course_id' => 'integer',
        'session_name' => 'string',
        'session_id' => 'integer',
        'year' => 'string',
        'student_id' => 'string',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'course_name' => 'required',
        'course_id' => 'required',
        'session_name' => 'required',
        'session_id' => 'required',
        'year' => 'required',
        'student_id' => 'required',
    ];

    public function Student()
    {
        return $this->belongsTo('App\Models\Student');
    }

    public function studentBooks()
    {
        return $this->hasMany('App\Models\StudentBook', 'student_academic_history_id', 'id');
    }

    public function feePackage()
    {
        return $this->hasOne('App\Models\FeePackage', 'academic_history_id', 'id');
    }

    public function feePackageInstallments()
    {
        return $this->hasMany('App\Models\FeePackageInstallment', 'academic_history_id', 'id');
    }

    public function studentRegistrations()
    {
        return $this->hasMany('App\Models\StudentRegistration', 'academic_history_id', 'id');
    }


    public function delete()
    {
        // TODO: DELETE ALL RELEVANT ROWS FROM TABLES
        // StudentBook::where('student_academic_history_id', $this->id)->delete();
        $this->studentBooks()->delete();
        $this->feePackage()->delete();
        $this->feePackageInstallments()->delete();
        $this->studentRegistrations()->delete();

        // TODO: Delete selected academic history
        return parent::delete();
    }
}
