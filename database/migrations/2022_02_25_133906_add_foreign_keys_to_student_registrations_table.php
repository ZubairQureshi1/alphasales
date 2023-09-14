<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToStudentRegistrationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('student_registrations', function(Blueprint $table)
		{
			$table->foreign('academic_history_id')->references('id')->on('student_academic_histories')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('academic_wing_id')->references('id')->on('organization_campus_wings')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('admission_id')->references('id')->on('admissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('student_registrations', function(Blueprint $table)
		{
			$table->dropForeign('student_registrations_academic_history_id_foreign');
			$table->dropForeign('student_registrations_academic_wing_id_foreign');
			$table->dropForeign('student_registrations_admission_id_foreign');
			$table->dropForeign('student_registrations_organization_campus_id_foreign');
			$table->dropForeign('student_registrations_organization_id_foreign');
			$table->dropForeign('student_registrations_student_id_foreign');
		});
	}

}
