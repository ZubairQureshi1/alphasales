<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeFinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_fines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('amount', 191)->nullable();
			$table->string('paid_amount', 191)->nullable();
			$table->string('balance', 191)->nullable();
			$table->string('voucher_number', 191)->nullable();
			$table->integer('package_id')->unsigned()->nullable()->index('fee_fines_package_id_foreign');
			$table->integer('installment_id')->unsigned()->nullable()->index('fee_fines_installment_id_foreign');
			$table->string('amount_waived', 191)->nullable();
			$table->string('amount_after_waived', 191)->nullable();
			$table->string('previous_reference', 191)->nullable();
			$table->string('next_reference', 191)->nullable();
			$table->date('due_date')->nullable();
			$table->date('paid_date')->nullable();
			$table->timestamps(3);
			$table->integer('fee_voucher_id')->unsigned()->nullable()->index('fee_fines_fee_voucher_id_foreign');
			$table->integer('academic_history_id')->unsigned()->nullable()->index('fee_fines_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('fee_fines_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('fee_fines_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('fee_fines_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fee_fines');
	}

}
