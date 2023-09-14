<?php

use Illuminate\Database\Seeder;
use App\Models\SessionCourse;
use App\Models\Pwwb\IndexTable;
class Index_TablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $dataIndexTable = SessionCourse::all();
        foreach ($dataIndexTable as $val) {
        	$getDataSessionCourse = SessionCourse::where('wing_id', $val->wing_id)->where('course_id', $val->course_id)->where('affiliated_body_id', $val->affiliated_body_id)->where('academic_term_id', $val->academic_term_id)->where('session_id', $val->session_id)->first();
    		$updateOrganizationCampusId = IndexTable::where('wing_id', $val->wing_id)->where('course_id', $val->course_id)->where('affiliated_body_id', $val->affiliated_body_id)->where('annual_semester_id', $val->academic_term_id)->where('session', $val->session_id)->update(array
            	('organization_campus_id' => $getDataSessionCourse->organization_campus_id)
        	);           
        }
    }
}
