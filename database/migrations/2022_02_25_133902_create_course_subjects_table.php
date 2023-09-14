<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_subjects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('course_name', 191)->nullable();
			$table->string('subject_name', 191)->nullable();
			$table->integer('course_id')->unsigned()->nullable()->index();
			$table->integer('subject_id')->unsigned()->nullable()->index();
			$table->timestamps(3);
			$table->softDeletes();
			$table->string('semester', 191)->nullable();
			$table->integer('semester_id')->nullable();
			$table->integer('mid_term_attendance_percentage')->nullable();
			$table->integer('final_term_attendance_percentage')->nullable();
			$table->integer('prerequisite_subject')->unsigned()->nullable()->index('course_subjects_prerequisite_subject_foreign');
			$table->integer('credit_hours')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('course_subjects_organization_id_foreign');
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('course_subjects_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_subjects');
	}

}
