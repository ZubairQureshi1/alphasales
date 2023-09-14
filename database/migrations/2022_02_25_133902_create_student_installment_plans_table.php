<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInstallmentPlansTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_installment_plans', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('student_id')->unsigned()->nullable()->index('student_installment_plans_student_id_foreign');
			$table->integer('fee_package_id')->unsigned()->nullable()->index('student_installment_plans_fee_package_id_foreign');
			$table->integer('student_academic_history_id')->unsigned()->nullable()->index('student_installment_plans_student_academic_history_id_foreign');
			$table->integer('no_of_installments')->nullable();
			$table->integer('approval_by_id')->unsigned()->nullable()->index('student_installment_plans_approval_by_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_installment_plans_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_installment_plans_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_installment_plans_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_installment_plans');
	}

}
