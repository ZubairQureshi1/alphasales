<?php

use App\Models\EnquiryFollowup;
use Illuminate\Database\Seeder;

class UpdateEnquiryFollowupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enquiries = EnquiryFollowup::where('status_id', '=', 2)->get();
        foreach ($enquiries as $enquiry) {
            $enquiry->next_date = $enquiry->created_at->format('Y-m-d');
            $enquiry->update();
        }
    }
}
