<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAcademicHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_academic_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('course_name', 191)->nullable();
			$table->string('course_id', 191)->nullable();
			$table->string('session_name', 191)->nullable();
			$table->string('session_id', 191)->nullable();
			$table->boolean('is_promoted')->nullable();
			$table->integer('student_id')->unsigned()->nullable()->index('student_academic_histories_student_id_foreign');
			$table->timestamps(3);
			$table->string('semester', 191)->nullable();
			$table->integer('semester_id')->nullable();
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_academic_histories_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_academic_histories_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_academic_histories_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_academic_histories');
	}

}
