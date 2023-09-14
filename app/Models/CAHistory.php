<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CAHistory extends Model
{
    public $table = 'c_a_histories';

    protected $dates = ['deleted_at'];

    public $fillable = [
        'ca_subject', 'status', 'status_id', 'raet_institution', 'admission_id', 'student_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'ca_subject' => 'string',
        'status' => 'string',
        'status_id' => 'integer',
        'raet_institution' => 'string',
        'admission_id' => 'integer',
        'student_id' => 'integer',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
    ];
}
