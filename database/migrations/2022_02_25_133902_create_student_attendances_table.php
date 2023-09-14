<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttendancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_attendances', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('section_id')->unsigned()->nullable()->index('student_attendances_section_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('student_attendances_user_id_foreign');
			$table->integer('room_id')->unsigned()->nullable()->index('student_attendances_room_id_foreign');
			$table->dateTime('date_time')->nullable();
			$table->string('title', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('section_detail_id')->unsigned()->nullable()->index('student_attendances_section_detail_id_foreign');
			$table->bigInteger('section_subject_detail_id')->unsigned()->nullable()->index('student_attendances_section_subject_detail_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_attendances_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_attendances_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_attendances_academic_wing_id_foreign');
			$table->integer('session_id')->unsigned()->nullable()->index('student_attendances_session_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_attendances');
	}

}
