<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('af_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('af_details_index_table_id_foreign');
			$table->string('af_course_applied_in', 191)->nullable();
			$table->string('af_course_enrolled_in', 191)->nullable();
			$table->string('af_course_registered_in', 191)->nullable();
			$table->string('af_roll_no', 191)->nullable();
			$table->string('af_affiliated_body', 191)->nullable();
			$table->string('af_duration_of_course', 191)->nullable();
			$table->date('af_admission_date')->nullable();
			$table->date('af_ending_date')->nullable();
			$table->string('af_academic_term', 191)->nullable();
			$table->string('af_semester_category', 191)->nullable();
			$table->string('af_shift', 191)->nullable();
			$table->string('af_registration_status', 191)->nullable();
			$table->date('af_registration_date')->nullable();
			$table->string('af_actual_fee', 191)->nullable();
			$table->string('af_late_fee', 191)->nullable();
			$table->string('af_total_fee', 191)->nullable();
			$table->timestamps(3);
			$table->string('af_board_university', 191)->nullable();
			$table->string('af_previous_course', 191)->nullable();
			$table->string('af_previous_roll_no', 191)->nullable();
			$table->date('af_previous_passing_date')->nullable();
			$table->string('af_previous_total_marks', 191)->nullable();
			$table->string('af_previous_marks_obtained', 191)->nullable();
			$table->string('af_previous_percentage', 191)->nullable();
			$table->string('af_previous_cgpa', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('af_details');
	}

}
