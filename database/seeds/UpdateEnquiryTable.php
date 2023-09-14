<?php

use App\Models\Enquiry;
use Illuminate\Database\Seeder;

class UpdateEnquiryTable extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enquiries = Enquiry::all();
        foreach ($enquiries as $key => $enquiry) {
            $enquiry->course_name = $enquiry->course_name;
            $enquiry->affiliated_body_name = $enquiry->affiliated_body;
            if ($enquiry->student_category_id != null) {
                $enquiry->student_category_name = isset(config('constants.student_categories')[$enquiry->student_category_id]) ? config('constants.student_categories')[$enquiry->student_category_id] : null;
            } else {
                $enquiry->student_category_name = '---';
            }
            if ($enquiry->previous_degree_id != null) {
                $enquiry->previous_degree_name = isset(config('constants.previous_degrees')[$enquiry->previous_degree_id]) ? config('constants.previous_degrees')[$enquiry->previous_degree_id] : null;
            } else {
                $enquiry->previous_degree_name = '---';
            }
            $enquiry->update();
        }
    }
}
