<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateSheetRoomsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_sheet_rooms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('room_id')->unsigned()->nullable()->index('date_sheet_rooms_room_id_foreign');
			$table->integer('date_sheet_id')->unsigned()->nullable()->index('date_sheet_rooms_date_sheet_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('date_sheet_rooms_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('date_sheet_rooms_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('date_sheet_rooms_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('date_sheet_rooms');
	}

}
