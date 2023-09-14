<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class TeacherSubject extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['subject_name', 'user_name'];
    public $fillable = [
        'user_id', 'subject_id',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'user_id' => 'integer',
        'subject_id' => 'integer',
    ];

    public function getSubjectNameAttribute()
    {
        $subject = Subject::find($this->subject_id);
        return $subject->name;
    }
    public function getUserNameAttribute()
    {
        $user = User::find($this->user_id);
        return $user->name;
    }
}
