<?php

namespace App\Models\Pwwb;
use VtiDetail;
use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class EducationalWingCfe extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;
	protected $casts = [
		'educational_wing_cfe' => 'integer'
	];

	protected $appends = ['educational_wing_name','educational_wing', 'educational_shift'];

    public function indexTable(){
        return $this->belongsTo(IndexTable::class);
    }

    public function geteducationalWingNameAttribute()
    {
    	return strtolower(\App\Models\Wing::find($this->educational_wing_cfe)->short_name);
    }

    public function geteducationalWingAttribute()
    {
    	if ($this->educational_wing_cfe == 1) {
    		return \App\Models\Pwwb\AfDetail::where('index_table_id', $this->index_table_id)->first();
    	} elseif($this->educational_wing_cfe == 2) {
    		return \App\Models\Pwwb\BiseDetail::where('index_table_id', $this->index_table_id)->first();
    	} elseif($this->educational_wing_cfe == 3) {
    		return \App\Models\Pwwb\ImsDetail::where('index_table_id', $this->index_table_id)->first();
    	} elseif($this->educational_wing_cfe == 4) {
    		return \App\Models\Pwwb\VtiDetail::where('index_table_id', $this->index_table_id)->first();
    	} else {
    		return null;
    	}
    }

    public function getEducationalShiftAttribute()
    {
    	$shift = '';
    	if ($this->educational_wing_cfe == 1) {
    		return \App\Models\Pwwb\AfDetail::where('index_table_id', $this->index_table_id)->first()->af_shift;
    	} elseif($this->educational_wing_cfe == 2) {
    		return \App\Models\Pwwb\BiseDetail::where('index_table_id', $this->index_table_id)->first()->bise_shift;
    	} elseif($this->educational_wing_cfe == 3) {
    		return \App\Models\Pwwb\ImsDetail::where('index_table_id', $this->index_table_id)->first()->ims_shift;
    	} elseif($this->educational_wing_cfe == 4) {
    		return \App\Models\Pwwb\VtiDetail::where('index_table_id', $this->index_table_id)->first()->vti_shift;
    	} else {
    		return null;
    	}
    }
}
