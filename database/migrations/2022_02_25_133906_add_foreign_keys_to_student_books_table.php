<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_books', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('section_detail_id')->references('id')->on('section_details')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('section_subject_detail_id')->references('id')->on('section_subject_details')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_books', function(Blueprint $table)
		{
			$table->dropForeign('student_books_academic_wing_id_foreign');
			$table->dropForeign('student_books_organization_campus_id_foreign');
			$table->dropForeign('student_books_organization_id_foreign');
			$table->dropForeign('student_books_section_detail_id_foreign');
			$table->dropForeign('student_books_section_subject_detail_id_foreign');
		});
	}

}
