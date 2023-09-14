<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimePeriodsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_periods', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->nullable()->index('time_periods_course_id_foreign');
			$table->integer('section_id')->unsigned()->nullable()->index('time_periods_section_id_foreign');
			$table->integer('subject_id')->unsigned()->nullable()->index('time_periods_subject_id_foreign');
			$table->softDeletes();
			$table->timestamps(3);
			$table->integer('time_slot_id')->unsigned()->nullable()->index('time_periods_time_slot_id_foreign');
			$table->integer('room_id')->unsigned()->nullable()->index('time_periods_room_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('time_periods_user_id_foreign');
			$table->string('start_date', 191)->nullable();
			$table->string('is_repeat', 191)->nullable();
			$table->string('end_date', 191)->nullable();
			$table->integer('session_id')->unsigned()->nullable()->index('time_periods_session_id_foreign');
			$table->integer('semester_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('time_periods_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('time_periods_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('time_periods_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('time_periods');
	}

}
