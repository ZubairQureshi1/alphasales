<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseContentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_contents', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->nullable()->index('course_contents_course_id_foreign');
			$table->integer('semester_id')->nullable();
			$table->integer('subject_id')->unsigned()->nullable()->index('course_contents_subject_id_foreign');
			$table->integer('week_id')->nullable();
			$table->string('planned_contents', 191)->nullable();
			$table->string('planned_activities', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->timestamps(3);
			$table->integer('user_id')->unsigned()->nullable()->index('course_contents_user_id_foreign');
			$table->integer('session_id')->unsigned()->nullable()->index('course_contents_session_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_contents');
	}

}
