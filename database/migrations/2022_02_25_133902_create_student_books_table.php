<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_books', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('subject_name', 191)->nullable();
			$table->integer('student_academic_history_id')->unsigned()->nullable()->index('student_books_student_academic_history_id_foreign');
			$table->timestamps(3);
			$table->integer('subject_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_books_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_books_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_books_academic_wing_id_foreign');
			$table->bigInteger('section_id')->nullable();
			$table->string('section_name', 191)->nullable();
			$table->bigInteger('section_subject_detail_id')->unsigned()->nullable()->index('student_books_section_subject_detail_id_foreign');
			$table->bigInteger('section_detail_id')->unsigned()->nullable()->index('student_books_section_detail_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_books');
	}

}
