<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiseDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('bise_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('bise_details_index_table_id_foreign');
			$table->string('bise_educational_wing_cfe', 191)->nullable();
			$table->string('bise_course_applied_in', 191)->nullable();
			$table->string('bise_optional_subject', 191)->nullable();
			$table->string('bise_others', 191)->nullable();
			$table->string('bise_course_enrolled_cfe', 191)->nullable();
			$table->string('bise_course_registered_in', 191)->nullable();
			$table->string('bise_roll_no', 191)->nullable();
			$table->string('bise_affiliated_body', 191)->nullable();
			$table->string('bise_duration_of_course', 191)->nullable();
			$table->date('bise_admission_date')->nullable();
			$table->date('bise_ending_date')->nullable();
			$table->string('bise_academic_term', 191)->nullable();
			$table->string('bise_semester_category', 191)->nullable();
			$table->string('bise_shift', 191)->nullable();
			$table->string('bise_registration_status', 191)->nullable();
			$table->date('bise_registration_date')->nullable();
			$table->string('bise_actual_fee', 191)->nullable();
			$table->string('bise_late_fee', 191)->nullable();
			$table->string('bise_total_fee', 191)->nullable();
			$table->timestamps(3);
			$table->string('bise_board_university', 191)->nullable();
			$table->string('bise_previous_course', 191)->nullable();
			$table->string('bise_previous_roll_no', 191)->nullable();
			$table->date('bise_previous_passing_date')->nullable();
			$table->string('bise_previous_total_marks', 191)->nullable();
			$table->string('bise_previous_marks_obtained', 191)->nullable();
			$table->string('bise_previous_percentage', 191)->nullable();
			$table->string('bise_previous_cgpa', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('bise_details');
	}

}
