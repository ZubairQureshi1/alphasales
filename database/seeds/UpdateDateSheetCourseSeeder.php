<?php

use Illuminate\Database\Seeder;
use App\Models\DateSheet;
use App\Models\DateSheetCourse;
class UpdateDateSheetCourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date_sheets = DateSheet::get();
        foreach($date_sheets as $date_sheet){	
            $date_sheet_course = new DateSheetCourse();
            $date_sheet_course->date_sheet_id = $date_sheet->id;
            $date_sheet_course->course_id = $date_sheet->course_id;
            $date_sheet_course->save();
        }
    }
}
