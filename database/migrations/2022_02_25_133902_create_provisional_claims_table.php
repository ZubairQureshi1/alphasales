<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvisionalClaimsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('provisional_claims', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('provisional_claims_index_table_id_foreign');
			$table->string('serial_no', 191)->nullable();
			$table->string('claim_due', 191)->nullable();
			$table->string('type_of_claim', 191)->nullable();
			$table->string('type_of_claim_other', 191)->nullable();
			$table->string('claim_status', 191)->nullable();
			$table->string('claim_received', 191)->nullable();
			$table->date('claim_date')->nullable();
			$table->string('reason', 191)->nullable();
			$table->string('cfe_fee', 191)->nullable();
			$table->string('recovery_from_student', 191)->nullable();
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
		Schema::drop('provisional_claims');
	}

}
