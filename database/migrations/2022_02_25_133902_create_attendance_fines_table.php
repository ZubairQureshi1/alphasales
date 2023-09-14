<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceFinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('attendance_fines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('amount', 191)->nullable();
			$table->string('paid_amount', 191)->nullable();
			$table->string('balance', 191)->nullable();
			$table->string('voucher_number', 191)->nullable();
			$table->string('amount_waived', 191)->nullable();
			$table->string('amount_after_waived', 191)->nullable();
			$table->integer('student_id')->unsigned()->nullable()->index('attendance_fines_student_id_foreign');
			$table->string('previous_reference', 191)->nullable();
			$table->string('next_reference', 191)->nullable();
			$table->date('due_date')->nullable();
			$table->date('paid_date')->nullable();
			$table->timestamps(3);
			$table->date('from_date')->nullable();
			$table->date('to_date')->nullable();
			$table->integer('attendance_fine_voucher_id')->unsigned()->nullable()->index('attendance_fines_attendance_fine_voucher_id_foreign');
			$table->integer('academic_history_id')->unsigned()->nullable()->index('attendance_fines_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('attendance_fines_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('attendance_fines_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('attendance_fines_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('attendance_fines');
	}

}
