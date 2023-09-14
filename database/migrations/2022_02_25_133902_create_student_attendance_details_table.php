<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendanceDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_attendance_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('student_id')->unsigned()->index('student_attendance_details_student_id_foreign');
			$table->bigInteger('student_attendance_id')->unsigned()->index('student_attendance_details_student_attendance_id_foreign');
			$table->bigInteger('status_id')->nullable();
			$table->string('status_type', 191)->nullable();
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_attendance_details');
	}

}
