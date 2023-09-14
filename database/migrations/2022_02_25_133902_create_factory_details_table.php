<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('factory_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('factory_details_index_table_id_foreign');
			$table->string('factory_name', 191)->nullable();
			$table->string('factory_address', 191)->nullable();
			$table->string('factory_registration_number', 191)->nullable();
			$table->date('factory_registration_date')->nullable();
			$table->string('factory_registration_certificate_attested_by_manager', 191)->nullable();
			$table->string('factory_registration_certificate_attested_by_officer', 191)->nullable();
			$table->string('factory_registration_certificate_attested_by_director', 191)->nullable();
			$table->string('signature_of_worker', 191)->nullable();
			$table->date('date_of_submission')->nullable();
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
		Schema::drop('factory_details');
	}

}
