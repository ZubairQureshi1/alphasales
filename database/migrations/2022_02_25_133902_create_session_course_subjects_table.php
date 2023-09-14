<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionCourseSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('session_course_subjects', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('session_course_id')->unsigned()->index('session_course_subjects_session_course_id_foreign');
			$table->integer('session_id')->unsigned()->index('session_course_subjects_session_id_foreign');
			$table->integer('course_id')->unsigned()->index('session_course_subjects_course_id_foreign');
			$table->string('course_name', 191);
			$table->integer('subject_id')->unsigned()->index('session_course_subjects_subject_id_foreign');
			$table->string('subject_name', 191);
			$table->timestamps(3);
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('session_course_subjects_organization_campus_id_foreign');
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('session_course_subjects_wing_id_foreign');
			$table->integer('annual_semester')->nullable();
			$table->string('subject_code', 191)->nullable();
			$table->integer('credit_hours')->nullable();
			$table->integer('prerequisite_id')->nullable();
			$table->softDeletes();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('session_course_subjects');
	}

}
