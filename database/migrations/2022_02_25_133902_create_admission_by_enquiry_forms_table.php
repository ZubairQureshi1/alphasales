<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionByEnquiryFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admission_by_enquiry_forms', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('enquiry_id')->unsigned()->nullable()->index('admission_by_enquiry_forms_enquiry_id_foreign');
			$table->timestamps(3);
			$table->boolean('is_admitted')->default(0);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('admission_by_enquiry_forms_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('admission_by_enquiry_forms_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('admission_by_enquiry_forms_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admission_by_enquiry_forms');
	}

}
