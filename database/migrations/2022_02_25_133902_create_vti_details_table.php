<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVtiDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('vti_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('vti_details_index_table_id_foreign');
			$table->string('vti_diploma_applied_in', 191)->nullable();
			$table->string('vti_diploma_enrolled_in', 191)->nullable();
			$table->string('vti_diploma_registered_in', 191)->nullable();
			$table->string('vti_dual_course', 191)->nullable();
			$table->string('vti_reason', 191)->nullable();
			$table->string('vti_further_file_received', 191)->nullable();
			$table->date('vti_follow_up')->nullable();
			$table->string('vti_roll_no', 191)->nullable();
			$table->string('vti_affiliated_body', 191)->nullable();
			$table->string('vti_duration_of_diploma', 191)->nullable();
			$table->date('vti_admission_date')->nullable();
			$table->date('vti_ending_date')->nullable();
			$table->string('vti_scheme_of_study', 191)->nullable();
			$table->string('vti_semester_category', 191)->nullable();
			$table->string('vti_shift', 191)->nullable();
			$table->string('vti_registration_status', 191)->nullable();
			$table->date('vti_date_of_registration')->nullable();
			$table->string('vti_registration_actual_fee', 191)->nullable();
			$table->string('vti_registration_late_fee', 191)->nullable();
			$table->string('vti_registration_total_fee', 191)->nullable();
			$table->timestamps(3);
			$table->string('vti_board_university', 191)->nullable();
			$table->string('vti_previous_course', 191)->nullable();
			$table->string('vti_previous_roll_no', 191)->nullable();
			$table->date('vti_previous_passing_date')->nullable();
			$table->string('vti_previous_total_marks', 191)->nullable();
			$table->string('vti_previous_marks_obtained', 191)->nullable();
			$table->string('vti_previous_percentage', 191)->nullable();
			$table->string('vti_previous_cgpa', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('vti_details');
	}

}
