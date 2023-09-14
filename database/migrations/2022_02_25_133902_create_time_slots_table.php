<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimeSlotsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('time_slots', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->string('start_time', 191)->nullable();
			$table->string('end_time', 191)->nullable();
			$table->string('buffer_start_time', 191)->nullable();
			$table->string('buffer_end_time', 191)->nullable();
			$table->string('slot_type_id', 191)->nullable();
			$table->string('slot_type_name', 191)->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('time_slots_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('time_slots_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('time_slots_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('time_slots');
	}

}
