<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimePeriodSubjectWeekDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_period_subject_week_days', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('time_period_id')->unsigned()->nullable()->index('time_period_subject_week_days_time_period_id_foreign');
			$table->integer('week_day_id')->unsigned()->nullable();
			$table->string('week_day_name', 191)->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('time_period_subject_week_days_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('time_period_subject_week_days_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('time_period_subject_week_days_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('time_period_subject_week_days');
	}

}
