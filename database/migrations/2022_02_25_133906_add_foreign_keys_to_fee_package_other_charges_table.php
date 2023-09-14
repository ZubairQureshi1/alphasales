<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFeePackageOtherChargesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('fee_package_other_charges', function(Blueprint $table)
		{
			$table->foreign('deleted_from_installment_id')->references('id')->on('fee_package_installments')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('fee_package_id')->references('id')->on('fee_packages')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('fee_package_installment_id')->references('id')->on('fee_package_installments')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('fee_package_other_charges', function(Blueprint $table)
		{
			$table->dropForeign('fee_package_other_charges_deleted_from_installment_id_foreign');
			$table->dropForeign('fee_package_other_charges_fee_package_id_foreign');
			$table->dropForeign('fee_package_other_charges_fee_package_installment_id_foreign');
			$table->dropForeign('fee_package_other_charges_student_id_foreign');
		});
	}

}
