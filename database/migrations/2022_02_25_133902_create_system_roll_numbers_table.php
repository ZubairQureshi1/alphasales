<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemRollNumbersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('system_roll_numbers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('roll_no', 191)->nullable();
			$table->integer('student_id')->unsigned()->nullable()->index('system_roll_numbers_student_id_foreign');
			$table->string('student_name', 191)->nullable();
			$table->integer('admission_id')->unsigned()->nullable()->index('system_roll_numbers_admission_id_foreign');
			$table->string('admission_form_code', 191)->nullable();
			$table->integer('course_id')->unsigned()->nullable()->index('system_roll_numbers_course_id_foreign');
			$table->string('course_name', 191)->nullable();
			$table->integer('section_id')->unsigned()->nullable()->index('system_roll_numbers_section_id_foreign');
			$table->string('section_name', 191)->nullable();
			$table->integer('session_id')->unsigned()->nullable()->index('system_roll_numbers_session_id_foreign');
			$table->string('session_name', 191)->nullable();
			$table->boolean('is_assigned')->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('generated_at_length')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('system_roll_numbers_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('system_roll_numbers_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('system_roll_numbers_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('system_roll_numbers');
	}

}
