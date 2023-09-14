<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondAnnualPartDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('second_annual_part_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('second_annual_part_details_index_table_id_foreign');
			$table->string('result', 191)->nullable();
			$table->string('receipt_status', 191)->nullable();
			$table->date('second_part_date')->nullable();
			$table->string('pwwb_status', 191)->nullable();
			$table->date('pwwb_date')->nullable();
			$table->string('diary_pwwb', 191)->nullable();
			$table->string('amount_claim_due', 191)->nullable();
			$table->string('claim_status', 191)->nullable();
			$table->string('amount_received', 191)->nullable();
			$table->date('claim_date')->nullable();
			$table->string('exam_status', 191)->nullable();
			$table->date('exam_date')->nullable();
			$table->string('exam_amount', 191)->nullable();
			$table->string('roll_no', 191)->nullable();
			$table->timestamps(3);
			$table->string('readmissionparttwo', 191)->nullable();
			$table->string('same_course', 191)->nullable();
			$table->string('changed_course', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('second_annual_part_details');
	}

}
