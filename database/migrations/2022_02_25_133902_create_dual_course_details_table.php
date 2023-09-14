<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDualCourseDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('dual_course_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('dual_course_details_index_table_id_foreign');
			$table->string('educational_wing_cfe', 191)->nullable();
			$table->string('course', 191)->nullable();
			$table->string('roll_no', 191)->nullable();
			$table->string('affiliated_body', 191)->nullable();
			$table->string('duration_of_course', 191)->nullable();
			$table->date('admission_date')->nullable();
			$table->date('ending_date')->nullable();
			$table->string('scheme_of_study', 191)->nullable();
			$table->string('semester_category', 191)->nullable();
			$table->string('shift', 191)->nullable();
			$table->string('registration_status', 191)->nullable();
			$table->string('registration_date', 191)->nullable();
			$table->string('late_fee', 191)->nullable();
			$table->string('total_fee', 191)->nullable();
			$table->string('actual_fee', 191)->nullable();
			$table->string('previous_course', 191)->nullable();
			$table->string('previous_affiliated_body', 191)->nullable();
			$table->string('previous_duration_of_course', 191)->nullable();
			$table->string('previous_roll_no', 191)->nullable();
			$table->date('previous_passing_date')->nullable();
			$table->string('previous_total_marks', 191)->nullable();
			$table->string('previous_marks_obtained', 191)->nullable();
			$table->string('previous_cgpa', 191)->nullable();
			$table->timestamps(3);
			$table->string('board_university', 191)->nullable();
			$table->string('previous_percentage', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('dual_course_details');
	}

}
