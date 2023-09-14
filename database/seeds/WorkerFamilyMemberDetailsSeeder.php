<?php

use Illuminate\Database\Seeder;
use App\Models\Pwwb\WorkerFamilyMemberDetail;


class WorkerFamilyMemberDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $workerFamilyMemberDetails = WorkerFamilyMemberDetail::all();
        foreach ($workerFamilyMemberDetails as $val){
        	if($val->change == 0 || $val->change == null || $val->change == 'null'){
        		$updateChange = WorkerFamilyMemberDetail::where('change', '=', null)->update(array
            		('change' => 1)
        		);           
        	}
			
    	}
    	foreach ($workerFamilyMemberDetails as $val){
        	if($val->change == 0 || $val->change == null || $val->change == 'null'){
        		$updateChange = WorkerFamilyMemberDetail::where('change', '=', '0')->update(array
            		('change' => 1)
        		);           
        	}
			
    	}

    	foreach ($workerFamilyMemberDetails as $val){
        	if($val->change == 0 || $val->change == null || $val->change == 'null'){
        		$updateChange = WorkerFamilyMemberDetail::where('change', '=', 0)->update(array
            		('change' => 1)
        		);           
        	}
			
    	}
    }
}
