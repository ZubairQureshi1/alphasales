<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_registrations', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('admission_id')->unsigned()->nullable()->index('student_registrations_admission_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('student_registrations_student_id_foreign');
			$table->integer('academic_history_id')->unsigned()->nullable()->index('student_registrations_academic_history_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_registrations_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_registrations_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_registrations_academic_wing_id_foreign');
			$table->integer('registration_platform_id')->nullable();
			$table->integer('registration_type_id')->nullable();
			$table->integer('registration_status_id')->nullable();
			$table->string('registration_no', 191)->nullable();
			$table->integer('registration_card_received_id')->nullable();
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
		Schema::drop('student_registrations');
	}

}
