<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLectureAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('lecture_attendances', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('status_id')->nullable();
			$table->integer('part_id')->nullable();
			$table->integer('course_id')->unsigned()->nullable()->index('lecture_attendances_course_id_foreign');
			$table->integer('subject_id')->unsigned()->nullable()->index('lecture_attendances_subject_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('lecture_attendances_student_id_foreign');
			$table->timestamps(3);
			$table->date('date')->nullable();
			$table->integer('session_id')->unsigned()->nullable()->index('lecture_attendances_session_id_foreign');
			$table->integer('academic_history_id')->unsigned()->nullable()->index('lecture_attendances_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('lecture_attendances_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('lecture_attendances_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('lecture_attendances_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('lecture_attendances');
	}

}
