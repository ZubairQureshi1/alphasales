<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentContactInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_contact_information', function(Blueprint $table)
		{
			$table->foreign('admission_id')->references('id')->on('admissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('student_id')->references('id')->on('students')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('student_contact_information', function(Blueprint $table)
		{
			$table->dropForeign('student_contact_information_admission_id_foreign');
			$table->dropForeign('student_contact_information_student_id_foreign');
		});
	}

}
