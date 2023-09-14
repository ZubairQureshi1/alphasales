<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryDeathManagerDetailContactsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('factory_death_manager_detail_contacts', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('factory_death_manager_detail_contacts_index_table_id_foreign');
			$table->string('serial_no', 191)->nullable();
			$table->string('contact_number', 191)->nullable();
			$table->timestamps(3);
			$table->string('manager_contact_relationship', 191)->nullable();
			$table->string('manager_specify_relationship', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('factory_death_manager_detail_contacts');
	}

}
