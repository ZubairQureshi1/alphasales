<?php

use Illuminate\Database\Seeder;
use App\Models\DateSheetStudent;
class DateSheetResultStatusUpdateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $date_sheet_student_result_statuses = DateSheetStudent::where('status_id','=',2)->where('status','=','Fail')->get();
        // foreach($date_sheet_student_result_statuses as $value){
        //     $status_update = DateSheetStudent::find($value['id']);
        //     $status_update->status_id = 1;
        //     $status_update->update();
        // }

        // $date_sheet_student_result_statuses = DateSheetStudent::where('status_id','=',1)->where('status','=','Pass')->get();
        // foreach($date_sheet_student_result_statuses as $value){
        //     $status_update = DateSheetStudent::find($value['id']);
        //     $status_update->status_id = 0;
        //     $status_update->update();
        // }
    }
}
