<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class ExamType extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $fillable = [
        'exam_type',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'exam_type' => 'string',
    ];
}
