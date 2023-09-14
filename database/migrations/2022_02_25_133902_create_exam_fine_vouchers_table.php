<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFineVouchersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exam_fine_vouchers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('exam_fine_id')->unsigned()->nullable()->index('exam_fine_vouchers_exam_fine_id_foreign');
			$table->string('voucher_code', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('exam_fine_vouchers_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('exam_fine_vouchers_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('exam_fine_vouchers_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exam_fine_vouchers');
	}

}
