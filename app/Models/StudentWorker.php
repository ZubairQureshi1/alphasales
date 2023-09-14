<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentWorker extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    public $table = 'student_workers';

    public $fillable = [
        'student_id',
        'student_academic_history_id',
        'is_file_completed',
        'file_delivered_to_board',
        'payment_received',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'student_id' => 'integer',
        'student_academic_history_id' => 'integer',
        'is_file_completed' => 'boolean',
        'file_delivered_to_board' => 'boolean',
        'payment_received' => 'boolean',
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [

    ];
}
