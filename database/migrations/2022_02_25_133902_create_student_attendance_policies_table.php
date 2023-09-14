<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancePoliciesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_attendance_policies', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('student_attendance_policies_wing_id_foreign');
			$table->string('absent_fine', 191)->nullable();
			$table->string('absent_initial_fine', 191)->nullable();
			$table->string('absent_maximum_fine', 191)->nullable();
			$table->string('late_fine', 191)->nullable();
			$table->string('late_initial_fine', 191)->nullable();
			$table->string('late_maximum_fine', 191)->nullable();
			$table->string('leave_quota', 191)->nullable();
			$table->string('apply_absent', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_attendance_policies_organization_campus_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_attendance_policies');
	}

}
