<?php

use Illuminate\Database\Seeder;
use App\Models\Pwwb\IndexTable;
class IndexTableChangeRToMSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
    	$getData = IndexTable::get();
    	foreach ($getData as $val){
			DB::statement('UPDATE index_tables SET file_received_number = REPLACE("'.$val->file_received_number.'","R", "M") WHERE file_received_number = "'.$val->file_received_number.'" ');
    	}
    	$getData1 = IndexTable::get();
    	foreach ($getData1 as $val){
			DB::statement('UPDATE index_tables SET file_module_number = file_received_number WHERE file_received_number = "'.$val->file_received_number.'" ');
    	}
    	$getData2 = IndexTable::get();
    	foreach ($getData2 as $val){
			DB::statement('UPDATE index_tables SET file_received_number = "" WHERE file_received_number = "'.$val->file_received_number.'" ');
    	}
        // $getData = IndexTable::get();
        // foreach ($getData as $val){
        //     DB::statement('UPDATE index_tables SET file_module_number = REPLACE("'.$val->file_module_number.'","M", "R") WHERE file_module_number = "'.$val->file_module_number.'" ');
        // }
        // $getData1 = IndexTable::get();
        // foreach ($getData1 as $val){
        //     DB::statement('UPDATE index_tables SET file_received_number = file_module_number WHERE file_module_number = "'.$val->file_module_number.'" ');
        // }
        // $getData2 = IndexTable::get();
        // foreach ($getData2 as $val){
        //     DB::statement('UPDATE index_tables SET file_module_number = "" WHERE file_module_number = "'.$val->file_module_number.'" ');
        // }
    }
}
