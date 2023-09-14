<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentAttendancePolicyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_attendance_policy_details', function(Blueprint $table)
		{
			$table->foreign('student_policy_id')->references('id')->on('student_attendance_policies')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_attendance_policy_details', function(Blueprint $table)
		{
			$table->dropForeign('student_attendance_policy_details_student_policy_id_foreign');
		});
	}

}
