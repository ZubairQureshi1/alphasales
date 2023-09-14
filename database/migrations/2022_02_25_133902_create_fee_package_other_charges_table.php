<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePackageOtherChargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_package_other_charges', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('student_id')->unsigned()->nullable()->index('fee_package_other_charges_student_id_foreign');
			$table->integer('fee_package_id')->unsigned()->nullable()->index('fee_package_other_charges_fee_package_id_foreign');
			$table->integer('amount')->nullable();
			$table->string('reason', 191)->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('fee_package_installment_id')->unsigned()->nullable()->index('fee_package_other_charges_fee_package_installment_id_foreign');
			$table->integer('deleted_from_installment_id')->unsigned()->nullable()->index('fee_package_other_charges_deleted_from_installment_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fee_package_other_charges');
	}

}
