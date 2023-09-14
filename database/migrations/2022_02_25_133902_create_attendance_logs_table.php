<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceLogsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance_logs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('attendance_time', 191)->nullable();
			$table->string('type_name', 191)->nullable();
			$table->integer('type_id')->nullable();
			$table->string('name', 191)->nullable();
			$table->string('emp_code', 191)->nullable();
			$table->string('roll_number', 191)->nullable();
			$table->string('time_slot_name', 191)->nullable();
			$table->integer('time_slot_id')->unsigned()->nullable()->index('attendance_logs_time_slot_id_foreign');
			$table->string('status', 191)->nullable();
			$table->integer('status_id')->nullable();
			$table->string('punch_type', 191)->nullable();
			$table->integer('punch_type_id')->nullable();
			$table->string('date', 191)->nullable();
			$table->timestamps(3);
			$table->integer('student_id')->unsigned()->nullable()->index('attendance_logs_student_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('attendance_logs_user_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('attendance_logs_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('attendance_logs_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('attendance_logs_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendance_logs');
	}

}
