<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryWorkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enquiry_workers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('enquiry_id')->unsigned()->nullable()->index('enquiry_workers_enquiry_id_foreign');
			$table->string('factory_name', 191)->nullable();
			$table->string('worker_experience_in_years', 191)->nullable();
			$table->string('worker_designation', 191)->nullable();
			$table->boolean('is_eobi')->nullable();
			$table->boolean('is_social_security')->nullable();
			$table->boolean('is_factory_registered')->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('enquiry_workers_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('enquiry_workers_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('enquiry_workers_academic_wing_id_foreign');
			$table->string('worker_experience_in_months', 191)->nullable();
			$table->string('worker_work_type', 191)->nullable();
			$table->integer('worker_work_type_id')->nullable();
			$table->string('worker_name', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enquiry_workers');
	}

}
