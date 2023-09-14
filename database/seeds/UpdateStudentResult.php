<?php

use App\Models\DateSheet;
use App\Models\DateSheetStudent;
use Illuminate\Database\Seeder;

class UpdateStudentResult extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //     $results = DateSheetStudent::where('subject_id', '=', '0')->get();
        //     foreach ($results as $key => $result) {
        //         $result->subject_id = 36;
        //         $result->update();
        //     }
        // $datesheets = DateSheet::where('exam_type_id', '=', '3')->where('session_id', '=', '1')->where('course_id', '=', '20')->get();
        // foreach ($datesheets as $key => $date_sheet) {
        //     $results = DateSheetStudent::where('date_sheet_id', '=', $date_sheet->id)->where('subject_id', '=', '36')->get();
        //     foreach ($results as $key => $result) {
        //         $result->subject_id = 13;
        //         $result->update();
        //     }
        // }
        $datesheets = DateSheet::where('exam_type_id', '=', '4')->where('session_id', '=', '2')->where('course_id', '=', '17')->get();
        foreach ($datesheets as $key => $date_sheet) {
            $results = DateSheetStudent::where('date_sheet_id', '=', $date_sheet->id)->where('subject_id', '=', '11')->get();
            foreach ($results as $key => $result) {
                $result->subject_id = 9;
                $result->update();
            }
        }
    }
}
