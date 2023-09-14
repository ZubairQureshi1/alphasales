<?php

namespace App\Models\Pwwb;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class StudentPersonalDetail extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;

    public function indexTable(){
        return $this->belongsTo(IndexTable::class);
    }
}
