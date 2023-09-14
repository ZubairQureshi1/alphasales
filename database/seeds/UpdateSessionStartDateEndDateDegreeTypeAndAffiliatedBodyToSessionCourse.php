<?php

use Illuminate\Database\Seeder;
use App\Models\SessionCourse;
use App\Models\AffiliatedBody;

class UpdateSessionStartDateEndDateDegreeTypeAndAffiliatedBodyToSessionCourse extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $session_courses = SessionCourse::all();
        foreach ($session_courses as $session_course) {
        	$session_course->session_start_date = '2019-09-07';
        	$session_course->session_end_date = '2020-04-15';
        	$session_course->degree_type_id = Config('constants.degree_types')[0];
        	$session_course->affiliated_body_id = AffiliatedBody::first()->id;
        	$session_course->update();
        }
    }
}
