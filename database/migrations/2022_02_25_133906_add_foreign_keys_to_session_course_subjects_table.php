<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSessionCourseSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('session_course_subjects', function(Blueprint $table)
		{
			$table->foreign('course_id')->references('id')->on('courses')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('session_course_id')->references('id')->on('session_courses')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('session_id')->references('id')->on('sessions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('session_course_subjects', function(Blueprint $table)
		{
			$table->dropForeign('session_course_subjects_course_id_foreign');
			$table->dropForeign('session_course_subjects_organization_campus_id_foreign');
			$table->dropForeign('session_course_subjects_session_course_id_foreign');
			$table->dropForeign('session_course_subjects_session_id_foreign');
			$table->dropForeign('session_course_subjects_subject_id_foreign');
			$table->dropForeign('session_course_subjects_wing_id_foreign');
		});
	}

}
