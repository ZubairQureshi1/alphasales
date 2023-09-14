<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClaimsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('claims', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->nullable()->index('claims_index_table_id_foreign');
			$table->bigInteger('parent_id')->nullable();
			$table->bigInteger('page_number')->nullable();
			$table->bigInteger('serial_no')->nullable();
			$table->string('claim_head', 191)->nullable();
			$table->string('claim_status', 191)->nullable();
			$table->string('reason', 191)->nullable();
			$table->float('claim_due')->nullable();
			$table->float('amount_due')->nullable();
			$table->float('amount_received')->nullable();
			$table->float('amount_balance')->nullable();
			$table->float('total_amount_due')->nullable();
			$table->float('total_amount_received')->nullable();
			$table->float('total_amount_balance')->nullable();
			$table->timestamps(3);
			$table->string('claim_head_default', 191)->nullable();
			$table->float('claim_amount_due_default')->nullable();
			$table->float('total_amount_due_default')->nullable();
			$table->float('amount_received_last')->nullable();
			$table->float('total_amount_cheque')->nullable();
			$table->date('cheque_date')->nullable();
			$table->string('cheque_no', 191)->nullable();
			$table->string('bank_name', 191)->nullable();
			$table->string('reason_remarks', 191)->nullable();
			$table->float('outstanding_cfe_fee')->nullable();
			$table->float('recovered_amount')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('claims');
	}

}
