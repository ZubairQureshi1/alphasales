<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('service_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('service_details_index_table_id_foreign');
			$table->string('serial_no', 191)->nullable();
			$table->string('name', 191)->nullable();
			$table->date('appointment_date')->nullable();
			$table->date('job_leaving_date')->nullable();
			$table->string('total_period', 191)->nullable();
			$table->date('completion_date')->nullable();
			$table->string('service_completion_status', 191)->nullable();
			$table->string('attested_by_factory_manager', 191)->nullable();
			$table->string('attested_by_dol', 191)->nullable();
			$table->string('attested_by_director', 191)->nullable();
			$table->timestamps(3);
			$table->string('worker_eligibliity_follow_up', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('service_details');
	}

}
