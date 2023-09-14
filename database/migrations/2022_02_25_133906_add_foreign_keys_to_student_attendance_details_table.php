<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentAttendanceDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_attendance_details', function(Blueprint $table)
		{
			$table->foreign('student_attendance_id')->references('id')->on('student_attendances')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_attendance_details', function(Blueprint $table)
		{
			$table->dropForeign('student_attendance_details_student_attendance_id_foreign');
			$table->dropForeign('student_attendance_details_student_id_foreign');
		});
	}

}
