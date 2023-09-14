<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class NoticeBoard extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    protected $fillable = ['title', 'description'];
}