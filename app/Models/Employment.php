<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class Employment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $append = ['user_name'];
    protected $fillable = [
        'user_id', 'end_employment_date', 'reason_end_employment',
    ];
    public function getUserNameAttribute()
    {
        $user = User::find($this->user_id);
        return $user->name;
    }
}
