<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryAddressesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enquiry_addresses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('street_address', 191)->nullable();
			$table->integer('city_id')->nullable();
			$table->integer('state_id')->nullable();
			$table->integer('country_id')->nullable();
			$table->integer('address_type_id')->nullable();
			$table->integer('enquiry_id')->unsigned()->nullable()->index('enquiry_addresses_enquiry_id_foreign');
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('enquiry_addresses_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('enquiry_addresses_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('enquiry_addresses_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enquiry_addresses');
	}

}
