<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancePolicyDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_attendance_policy_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('student_policy_id')->unsigned()->nullable()->index('student_attendance_policy_details_student_policy_id_foreign');
			$table->string('struck_off_limit', 191)->nullable();
			$table->string('credit_hour', 191)->nullable();
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_attendance_policy_details');
	}

}
