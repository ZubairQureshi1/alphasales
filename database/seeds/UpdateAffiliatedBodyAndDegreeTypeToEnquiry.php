<?php

use Illuminate\Database\Seeder;
use App\Models\Enquiry;
use App\Models\AffiliatedBody;

class UpdateAffiliatedBodyAndDegreeTypeToEnquiry extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enquiries = Enquiry::all();
        foreach($enquiries as $enquiry)
        {
        	$enquiry->degree_type_id = Config('constants.degree_types')[0];
        	$enquiry->affiliated_body_id = AffiliatedBody::first()->id;
        	$enquiry->update();
        }
    }
}
