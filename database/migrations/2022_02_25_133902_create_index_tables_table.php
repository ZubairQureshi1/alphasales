<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexTablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('index_tables', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('session', 191)->nullable();
			$table->string('district', 191)->nullable();
			$table->string('district_other', 191)->nullable();
			$table->string('file_received_number', 191)->nullable();
			$table->date('receiving_date')->nullable();
			$table->date('submission_date')->nullable();
			$table->string('file_receipt_voucher_number', 191)->nullable();
			$table->date('file_receipt_voucher_date')->nullable();
			$table->string('fresh_file_submission_in_pwwb_number', 191)->nullable();
			$table->string('priority_of_submission', 191)->nullable();
			$table->string('pwwb_diary_number', 191)->nullable();
			$table->string('wing_id', 191)->nullable();
			$table->string('course_id', 191)->nullable();
			$table->string('affiliated_body_id', 191)->nullable();
			$table->string('annual_semester_id', 191)->nullable();
			$table->date('pwwb_diary_date')->nullable();
			$table->string('pending_files_with_remarks', 191)->nullable();
			$table->boolean('admitted')->default(0);
			$table->integer('admission_id')->unsigned()->nullable()->index('index_tables_admission_id_foreign');
			$table->timestamps(3);
			$table->string('course_name', 191)->nullable();
			$table->string('course_enrolled_id', 191)->nullable();
			$table->string('course_registered_id', 191)->nullable();
			$table->string('course_enrolled_name', 191)->nullable();
			$table->string('course_registered_name', 191)->nullable();
			$table->string('organization_campus_id', 191)->nullable();
			$table->string('file_module_number', 191)->nullable();
			$table->string('admission_set_submitted', 191)->nullable();
			$table->string('file_submitted_to_pwwb', 191)->nullable();
			$table->string('roll_no', 191)->nullable();
			$table->bigInteger('is_dsm');
			$table->bigInteger('dual_course')->nullable();
			$table->bigInteger('return_file_pwwb')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('index_tables');
	}

}
