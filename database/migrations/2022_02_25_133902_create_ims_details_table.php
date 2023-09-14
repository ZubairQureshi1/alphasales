<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImsDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('ims_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('ims_details_index_table_id_foreign');
			$table->string('ims_course_applied_in_cfe', 191)->nullable();
			$table->string('ims_course_enrolled_in_cfe', 191)->nullable();
			$table->string('ims_course_registered', 191)->nullable();
			$table->string('ims_roll_no', 191)->nullable();
			$table->string('ims_affiliated_body', 191)->nullable();
			$table->string('ims_duration_of_course', 191)->nullable();
			$table->date('ims_admission_date')->nullable();
			$table->date('ims_ending_date')->nullable();
			$table->string('ims_academic_term', 191)->nullable();
			$table->string('ims_semester_category', 191)->nullable();
			$table->string('ims_shift', 191)->nullable();
			$table->string('ims_registration_status', 191)->nullable();
			$table->date('ims_registration_date')->nullable();
			$table->string('ims_actual_fee', 191)->nullable();
			$table->string('ims_late_fee', 191)->nullable();
			$table->string('ims_total_fee', 191)->nullable();
			$table->timestamps(3);
			$table->string('ims_board_university', 191)->nullable();
			$table->string('ims_previous_course', 191)->nullable();
			$table->string('ims_previous_roll_no', 191)->nullable();
			$table->date('ims_previous_passing_date')->nullable();
			$table->string('ims_previous_total_marks', 191)->nullable();
			$table->string('ims_previous_marks_obtained', 191)->nullable();
			$table->string('ims_previous_percentage', 191)->nullable();
			$table->string('ims_previous_cgpa', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('ims_details');
	}

}
