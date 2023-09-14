<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shifts', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable()->index('shifts_user_id_foreign');
			$table->integer('time_slot_id')->unsigned()->nullable()->index('shifts_time_slot_id_foreign');
			$table->boolean('is_active')->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->boolean('has_shift_swap')->nullable();
			$table->integer('shift_swap_id')->unsigned()->nullable()->index('shifts_shift_swap_id_foreign');
			$table->string('month_id', 191)->nullable();
			$table->string('year', 191)->nullable();
			$table->date('date')->nullable();
			$table->boolean('is_week_day')->default(0);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('shifts_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('shifts_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('shifts_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shifts');
	}

}
