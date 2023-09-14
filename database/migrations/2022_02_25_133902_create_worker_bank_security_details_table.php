<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerBankSecurityDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_bank_security_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('worker_bank_security_details_index_table_id_foreign');
			$table->string('social_security', 191)->nullable();
			$table->string('social_security_attested', 191)->nullable();
			$table->string('social_security_office_name', 191)->nullable();
			$table->string('eobi_number', 191)->nullable();
			$table->string('eobi_card_attested', 191)->nullable();
			$table->string('name_of_bank', 191)->nullable();
			$table->string('bank_branch_address', 191)->nullable();
			$table->string('bank_branch_code', 191)->nullable();
			$table->string('bank_iban', 191)->nullable();
			$table->string('permanent_address', 191)->nullable();
			$table->string('temporary_address', 191)->nullable();
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
		Schema::drop('worker_bank_security_details');
	}

}
