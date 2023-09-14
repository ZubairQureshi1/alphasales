<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeacherSubjectsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('teacher_subjects', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable()->index('teacher_subjects_user_id_foreign');
			$table->integer('subject_id')->unsigned()->nullable()->index('teacher_subjects_subject_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('teacher_subjects_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('teacher_subjects_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('teacher_subjects_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('teacher_subjects');
	}

}
