<?php

use Illuminate\Database\Seeder;
use App\Models\Admission;
use App\Models\AffiliatedBody;

class UpdateAffiliatedBodyDegreeLevelAndDegreeTypeColToAdmission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admissions = Admission::all();
        foreach ($admissions as $key => $admission) {
        	$admission->affiliated_body_id = AffiliatedBody::first()->id;
        	$admission->degree_type_id = Config('constants.degree_types')[0];
        	$admission->degree_level_id = Config('constants.degree_levels')[0];
        	$admission->update();
        }
    }
}
