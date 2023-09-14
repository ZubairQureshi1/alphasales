<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryDeathManagerDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('factory_death_manager_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('factory_death_manager_details_index_table_id_foreign');
			$table->date('death_date_of_worker')->nullable();
			$table->string('death_grant_claimed', 191)->nullable();
			$table->date('retirement_date_of_worker')->nullable();
			$table->string('factory_manager_name', 191)->nullable();
			$table->string('factory_manager_designation', 191)->nullable();
			$table->string('factory_manager_contact_no', 191)->nullable();
			$table->string('factory_manager_email', 191)->nullable();
			$table->string('form_attested_by_manager_sign', 191)->nullable();
			$table->string('form_attested_by_manager_stamp', 191)->nullable();
			$table->string('form_attested_by_dol_sign', 191)->nullable();
			$table->string('form_attested_by_dol_stamp', 191)->nullable();
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
		Schema::drop('factory_death_manager_details');
	}

}
