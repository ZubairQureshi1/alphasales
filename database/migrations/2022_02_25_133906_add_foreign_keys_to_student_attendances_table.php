<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_attendances', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('room_id')->references('id')->on('rooms')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('section_detail_id')->references('id')->on('section_details')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('section_id')->references('id')->on('sections')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('section_subject_detail_id')->references('id')->on('section_subject_details')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('session_id')->references('id')->on('sections')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_attendances', function(Blueprint $table)
		{
			$table->dropForeign('student_attendances_academic_wing_id_foreign');
			$table->dropForeign('student_attendances_organization_campus_id_foreign');
			$table->dropForeign('student_attendances_organization_id_foreign');
			$table->dropForeign('student_attendances_room_id_foreign');
			$table->dropForeign('student_attendances_section_detail_id_foreign');
			$table->dropForeign('student_attendances_section_id_foreign');
			$table->dropForeign('student_attendances_section_subject_detail_id_foreign');
			$table->dropForeign('student_attendances_session_id_foreign');
			$table->dropForeign('student_attendances_user_id_foreign');
		});
	}

}
