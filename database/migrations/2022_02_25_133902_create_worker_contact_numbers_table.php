<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerContactNumbersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_contact_numbers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('worker_contact_numbers_index_table_id_foreign');
			$table->string('serial_no', 191)->nullable();
			$table->string('worker_contact_relationship', 191)->nullable();
			$table->string('specify_relationship_2', 191)->nullable();
			$table->string('contact_no', 191)->nullable();
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
		Schema::drop('worker_contact_numbers');
	}

}
