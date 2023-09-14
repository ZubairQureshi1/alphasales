<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAcademicRecordsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academic_records', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('type_name', 191)->nullable();
			$table->string('type_id', 191)->nullable();
			$table->string('year', 191)->nullable();
			$table->string('marks', 191)->nullable();
			$table->string('grade', 191)->nullable();
			$table->string('school_college', 191)->nullable();
			$table->string('board_uni', 191)->nullable();
			$table->integer('admission_id')->unsigned()->nullable()->index('academic_records_admission_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('academic_records_student_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('academic_records_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('academic_records_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('academic_records_academic_wing_id_foreign');
			$table->string('total_marks', 191)->nullable();
			$table->string('percentage', 191)->nullable();
			$table->string('roll_no', 191)->nullable();
			$table->string('attachment_url', 191)->nullable();
			$table->string('other_degree_name', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('academic_records');
	}

}
