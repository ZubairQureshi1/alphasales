<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftDatesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_dates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->date('date')->nullable();
			$table->integer('shift_id')->unsigned()->nullable()->index('shift_dates_shift_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('shift_dates_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('shift_dates_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('shift_dates_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shift_dates');
	}

}
