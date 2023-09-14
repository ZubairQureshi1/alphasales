<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferenceEnquiriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reference_enquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('reference_id')->unsigned()->index('reference_enquiries_reference_id_foreign');
			$table->integer('enquiry_id')->unsigned()->index('reference_enquiries_enquiry_id_foreign');
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('reference_enquiries_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('reference_enquiries_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('reference_enquiries_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('reference_enquiries');
	}

}
