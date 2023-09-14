<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePackagesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fee_packages', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('total_package', 191)->nullable();
			$table->string('discount', 191)->nullable();
			$table->string('net_tuition_fee', 191)->nullable();
			$table->string('discount_status', 191)->nullable();
			$table->string('discount_percentage', 191)->nullable();
			$table->integer('discount_status_id')->unsigned()->nullable();
			$table->integer('student_id')->unsigned()->nullable()->index('fee_packages_student_id_foreign');
			$table->integer('status_id')->unsigned()->nullable();
			$table->string('status_name', 191)->nullable();
			$table->string('voucher_code', 191)->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('voucher_id')->unsigned()->nullable()->index('fee_packages_voucher_id_foreign');
			$table->string('paid_date', 191)->nullable();
			$table->string('due_date', 191)->nullable();
			$table->string('marketer_incentive', 191)->nullable();
			$table->string('registration_fee', 191)->nullable();
			$table->string('cfe_admission_fee', 191)->nullable();
			$table->string('total_admission_registration_fee', 191)->nullable();
			$table->string('admission_registration_voucher_code', 191)->nullable();
			$table->string('admission_registration_paid_date', 191)->nullable();
			$table->string('tuition_fee', 191)->nullable();
			$table->integer('academic_history_id')->unsigned()->nullable()->index('fee_packages_academic_history_id_foreign');
			$table->integer('fee_structure_type_id')->nullable();
			$table->string('fee_structure_type', 191)->nullable();
			$table->string('user_name', 191)->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('fee_packages_user_id_foreign');
			$table->boolean('is_verified')->default(0);
			$table->string('verified_by', 191)->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('fee_packages_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('fee_packages_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('fee_packages_academic_wing_id_foreign');
			$table->string('transport_month_count', 191)->nullable();
			$table->string('transport_monthly_amount', 191)->nullable();
			$table->string('total_transport_charges', 191)->nullable();
			$table->string('miscellaneous_charges', 191)->nullable();
			$table->string('other_charges', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fee_packages');
	}

}
