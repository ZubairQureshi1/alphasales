<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendances', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('check_in_time', 191)->nullable();
			$table->string('check_out_time', 191)->nullable();
			$table->string('type_name', 191)->nullable();
			$table->integer('type_id')->nullable();
			$table->string('name', 191)->nullable();
			$table->string('emp_code', 191)->nullable();
			$table->string('roll_number', 191)->nullable();
			$table->string('time_slot_name', 191)->nullable();
			$table->integer('time_slot_id')->unsigned()->nullable()->index('attendances_time_slot_id_foreign');
			$table->string('status', 191)->nullable();
			$table->integer('status_id')->nullable();
			$table->string('punch_type', 191)->nullable();
			$table->integer('punch_type_id')->nullable();
			$table->string('date', 191)->nullable();
			$table->timestamps(3);
			$table->boolean('is_late_checkin')->default(0);
			$table->boolean('is_late_checkout')->default(0);
			$table->boolean('is_on_time_checkin')->default(0);
			$table->boolean('is_on_time_checkout')->default(0);
			$table->boolean('is_early_checkin')->default(0);
			$table->boolean('is_early_checkout')->default(0);
			$table->boolean('is_on_leave')->default(0);
			$table->boolean('is_day_off')->default(0);
			$table->boolean('is_on_travel')->default(0);
			$table->boolean('is_holiday')->default(0);
			$table->string('working_hours', 191)->nullable();
			$table->integer('student_id')->unsigned()->nullable()->index('attendances_student_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('attendances_user_id_foreign');
			$table->integer('academic_history_id')->unsigned()->nullable()->index('attendances_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('attendances_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('attendances_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('attendances_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendances');
	}

}
