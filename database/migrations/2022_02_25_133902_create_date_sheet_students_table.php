<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateSheetStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_sheet_students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('date_sheet_id')->unsigned()->nullable()->index('date_sheet_students_date_sheet_id_foreign');
			$table->integer('course_id')->unsigned()->nullable()->index('date_sheet_students_course_id_foreign');
			$table->integer('subject_id')->unsigned()->nullable()->index('date_sheet_students_subject_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('date_sheet_students_student_id_foreign');
			$table->integer('total_marks')->nullable();
			$table->integer('obtain_marks')->nullable();
			$table->integer('percentage')->nullable();
			$table->string('grade', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->timestamps(3);
			$table->integer('status_id')->nullable();
			$table->integer('academic_history_id')->unsigned()->nullable()->index('date_sheet_students_academic_history_id_foreign');
			$table->integer('section_id')->unsigned()->nullable()->index('date_sheet_students_section_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('date_sheet_students_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('date_sheet_students_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('date_sheet_students_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('date_sheet_students');
	}

}
