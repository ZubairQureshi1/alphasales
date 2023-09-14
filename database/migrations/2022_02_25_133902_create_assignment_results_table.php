<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentResultsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignment_results', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('assignment_id')->unsigned()->nullable()->index('assignment_results_assignment_id_foreign');
			$table->integer('subject_id')->unsigned()->nullable()->index('assignment_results_subject_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('assignment_results_student_id_foreign');
			$table->integer('total_marks')->nullable();
			$table->integer('obtain_marks')->nullable();
			$table->integer('percentage')->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('assignment_results_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('assignment_results_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('assignment_results_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assignment_results');
	}

}
