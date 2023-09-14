<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFirstSemesterDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('first_semester_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('first_semester_details_index_table_id_foreign');
			$table->string('status', 191)->nullable();
			$table->date('degree_date')->nullable();
			$table->string('exam_status', 191)->nullable();
			$table->date('exam_date')->nullable();
			$table->string('amount', 191)->nullable();
			$table->string('roll_no', 191)->nullable();
			$table->timestamps(3);
			$table->string('readmissionfirst', 191)->nullable();
			$table->string('same_course', 191)->nullable();
			$table->string('changed_course', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('first_semester_details');
	}

}
