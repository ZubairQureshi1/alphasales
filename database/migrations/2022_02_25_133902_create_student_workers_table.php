<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentWorkersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_workers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('student_id')->unsigned()->nullable()->index('student_workers_student_id_foreign');
			$table->integer('student_academic_history_id')->unsigned()->nullable()->index('student_workers_student_academic_history_id_foreign');
			$table->boolean('is_file_completed')->nullable();
			$table->boolean('file_delivered_to_board')->nullable();
			$table->boolean('payment_received')->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_workers_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_workers_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_workers_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_workers');
	}

}
