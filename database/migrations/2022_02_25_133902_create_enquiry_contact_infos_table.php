<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryContactInfosTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enquiry_contact_infos', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('phone_no', 191)->nullable();
			$table->integer('contact_type_id')->nullable();
			$table->string('contact_type_name', 191)->default('');
			$table->integer('enquiry_id')->unsigned()->nullable()->index('enquiry_contact_infos_enquiry_id_foreign');
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('enquiry_contact_infos_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('enquiry_contact_infos_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('enquiry_contact_infos_academic_wing_id_foreign');
			$table->string('other_name', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enquiry_contact_infos');
	}

}
