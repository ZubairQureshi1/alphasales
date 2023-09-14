<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftWorkingDaysTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_working_days', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shift_id')->unsigned()->nullable()->index('shift_working_days_shift_id_foreign');
			$table->integer('week_day_id')->nullable();
			$table->string('week_day', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('shift_working_days_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('shift_working_days_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('shift_working_days_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shift_working_days');
	}

}
