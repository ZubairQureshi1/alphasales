<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentAttachment extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
    
    protected $guarded = [];

    public function student()
    {
    	return $this->belongsTo('App\Models\Student', 'attachment_for', 'id');
    }

}
