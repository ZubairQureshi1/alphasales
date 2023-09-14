<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerPersonalDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_personal_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('worker_personal_details_index_table_id_foreign');
			$table->string('photograph_uploaded', 191)->nullable();
			$table->string('photograph_attested', 191)->nullable();
			$table->integer('photograph_quantity')->nullable();
			$table->string('worker_name', 191)->nullable();
			$table->string('applicant_name', 191)->nullable();
			$table->string('worker_cnic', 191)->nullable();
			$table->string('worker_cnic_attested', 191)->nullable();
			$table->string('worker_current_status', 191)->nullable();
			$table->string('worker_job_nature', 191)->nullable();
			$table->string('factory_status', 191)->nullable();
			$table->string('worker_relationship', 191)->nullable();
			$table->string('specify_relationship', 191)->nullable();
			$table->string('date_of_birth', 191)->nullable();
			$table->string('pwwb_scholarship_form', 191)->nullable();
			$table->string('factory_card', 191)->nullable();
			$table->string('service_letter', 191)->nullable();
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
		Schema::drop('worker_personal_details');
	}

}
