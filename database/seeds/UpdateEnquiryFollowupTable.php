<?php

use App\Models\EnquiryFollowup;
use Illuminate\Database\Seeder;

class UpdateEnquiryFollowupTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $followups = EnquiryFollowup::all();
        foreach ($followups as $key => $followup) {
            if ($followup->enquiry_data) {
                $followup->session_id = $followup->enquiry_data->session_id;
                $followup->update();
            }
        }
    }
}
