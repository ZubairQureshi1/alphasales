<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class UserAllowedSession extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $appends = ['session_name'];

    protected $fillable = [

        'user_id', 'session_id', 'is_active',

    ];

    public function getSessionNameAttribute()
    {
        return !empty(Session::find($this->session_id)) ? Session::find($this->session_id)->session_name : '---';
    }

}
