<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('exam_fines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('exam_type_id')->unsigned()->index('exam_fines_exam_type_id_foreign');
			$table->integer('date_sheet_id')->unsigned()->nullable()->index('exam_fines_date_sheet_id_foreign');
			$table->integer('student_academic_history_id')->unsigned()->nullable()->index('exam_fines_student_academic_history_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('exam_fines_student_id_foreign');
			$table->string('amount', 191)->nullable();
			$table->string('paid_amount', 191)->nullable();
			$table->string('balance', 191)->nullable();
			$table->string('voucher_number', 191)->nullable();
			$table->string('amount_waived', 191)->nullable();
			$table->string('amount_after_waived', 191)->nullable();
			$table->string('previous_reference', 191)->nullable();
			$table->string('next_reference', 191)->nullable();
			$table->date('due_date')->nullable();
			$table->date('paid_date')->nullable();
			$table->timestamps(3);
			$table->integer('exam_fine_voucher_id')->unsigned()->nullable()->index('exam_fines_exam_fine_voucher_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('exam_fines_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('exam_fines_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('exam_fines_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('exam_fines');
	}

}
