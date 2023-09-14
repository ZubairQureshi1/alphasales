<?php

namespace App\Models\Pwwb;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class WorkerFamilyMemberDetail extends Model implements Auditable
{
	use \OwenIt\Auditing\Auditable;
	
    public function indexTable(){
        return $this->belongsTo(IndexTable::class);
    }
}