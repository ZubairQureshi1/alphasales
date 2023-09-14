<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadFineStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('head_fine_students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('head_id')->unsigned()->nullable()->index('head_fine_students_head_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('head_fine_students_student_id_foreign');
			$table->integer('package_id')->unsigned()->nullable()->index('head_fine_students_package_id_foreign');
			$table->integer('installment_id')->unsigned()->nullable()->index('head_fine_students_installment_id_foreign');
			$table->string('status_name', 191)->nullable();
			$table->integer('status_id')->unsigned()->nullable();
			$table->timestamps(3);
			$table->string('voucher_code', 191)->nullable();
			$table->string('due_date', 191)->nullable();
			$table->string('paid_date', 191)->nullable();
			$table->string('discount_in_amount', 191)->nullable();
			$table->string('discount_in_percentage', 191)->nullable();
			$table->string('amount_after_discount', 191)->nullable();
			$table->string('user_name', 191)->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('head_fine_students_user_id_foreign');
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
			$table->string('paid_amount', 191)->nullable();
			$table->boolean('is_order_placed')->default(0);
			$table->dateTime('date_of_order_delivered')->nullable();
			$table->string('head_amount', 191)->nullable();
			$table->boolean('is_verified')->default(0);
			$table->string('verified_by', 191)->nullable();
			$table->boolean('payment_verification')->default(0);
			$table->string('payment_verified_by', 191)->nullable();
			$table->integer('academic_history_id')->unsigned()->nullable()->index('head_fine_students_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('head_fine_students_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('head_fine_students_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('head_fine_students_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('head_fine_students');
	}

}
