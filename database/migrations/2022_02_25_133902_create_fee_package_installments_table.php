<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePackageInstallmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_package_installments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('net_total', 191)->nullable();
			$table->string('course_duration', 191)->nullable();
			$table->string('no_of_semesters', 191)->nullable();
			$table->string('duration_per_semester', 191)->nullable();
			$table->string('installment_interval', 191)->nullable();
			$table->string('no_of_installments', 191)->nullable();
			$table->string('amount_per_installment', 191)->nullable();
			$table->string('due_date', 191)->nullable();
			$table->string('paid_amount', 191)->nullable();
			$table->string('paid_date', 191)->nullable();
			$table->string('status_id', 191)->nullable();
			$table->string('status_name', 191)->nullable();
			$table->integer('package_id')->unsigned()->nullable()->index('fee_package_installments_package_id_foreign');
			$table->string('extension_date', 191)->nullable();
			$table->string('remarks', 191)->nullable();
			$table->string('voucher_code', 191)->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('voucher_id')->unsigned()->nullable()->index('fee_package_installments_voucher_id_foreign');
			$table->string('late_fee_fine', 191)->nullable();
			$table->string('remaining_balance', 191)->nullable();
			$table->string('remaining_balance_late_fine', 191)->nullable();
			$table->string('remaining_balance_paid_date', 191)->nullable();
			$table->string('amount_with_fine', 191)->nullable();
			$table->string('remaining_balance_voucher_id', 191)->nullable();
			$table->string('total_remaining_balance', 191)->nullable();
			$table->string('total_amount_collected', 191)->nullable();
			$table->string('carry_forward', 191)->nullable();
			$table->string('is_carry_forward', 191)->nullable();
			$table->string('user_name', 191)->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('fee_package_installments_user_id_foreign');
			$table->boolean('is_verified')->default(0);
			$table->string('verified_by', 191)->nullable();
			$table->string('late_fee_fine_voucher_code', 191)->nullable();
			$table->string('r_b_late_fee_fine_voucher_code', 191)->nullable();
			$table->string('fine_waived', 191)->nullable();
			$table->string('remaining_balance_fine_waived', 191)->nullable();
			$table->string('remaining_balance_paid_amount', 191)->nullable();
			$table->date('fine_paid_date')->nullable();
			$table->date('remaining_balance_fine_paid_date')->nullable();
			$table->boolean('payment_verification')->default(0);
			$table->string('payment_verified_by', 191)->nullable();
			$table->integer('academic_history_id')->unsigned()->nullable()->index('fee_package_installments_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('fee_package_installments_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('fee_package_installments_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('fee_package_installments_academic_wing_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('fee_package_installments_student_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fee_package_installments');
	}

}
