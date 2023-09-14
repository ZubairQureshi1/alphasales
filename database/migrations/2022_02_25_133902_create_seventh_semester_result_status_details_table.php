<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSeventhSemesterResultStatusDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('seventh_semester_result_status_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('seventh_semester_result_status_details_index_table_id_foreign');
			$table->string('result', 191)->nullable();
			$table->string('fail', 191)->nullable();
			$table->string('next_appearance', 191)->nullable();
			$table->date('next_appearance_date')->nullable();
			$table->date('last_chance_date')->nullable();
			$table->date('passing_date')->nullable();
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('seventh_semester_result_status_details');
	}

}
