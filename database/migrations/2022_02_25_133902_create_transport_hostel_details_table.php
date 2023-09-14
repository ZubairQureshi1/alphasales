<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTransportHostelDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('transport_hostel_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('transport_hostel_details_index_table_id_foreign');
			$table->string('transport_facility', 191)->nullable();
			$table->string('bus_stop', 191)->nullable();
			$table->string('hostel_facility', 191)->nullable();
			$table->string('hostel_name', 191)->nullable();
			$table->string('address', 191)->nullable();
			$table->string('manager_name', 191)->nullable();
			$table->string('manager_contact', 191)->nullable();
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('transport_hostel_details');
	}

}
