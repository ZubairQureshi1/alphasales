<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_vouchers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('voucher_code', 191)->nullable();
			$table->integer('package_id')->unsigned()->nullable()->index('fee_vouchers_package_id_foreign');
			$table->integer('installment_id')->unsigned()->nullable()->index('fee_vouchers_installment_id_foreign');
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('fine_id')->unsigned()->nullable()->index('fee_vouchers_fine_id_foreign');
			$table->integer('head_fine_student_id')->unsigned()->nullable()->index('fee_vouchers_head_fine_student_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('fee_vouchers_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('fee_vouchers_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('fee_vouchers_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fee_vouchers');
	}

}
