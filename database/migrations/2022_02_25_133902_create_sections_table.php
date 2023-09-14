<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('sections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('sections_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('sections_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('sections_academic_wing_id_foreign');
			$table->bigInteger('session_id')->nullable();
			$table->integer('annual_semester')->nullable();
			$table->integer('gender_id')->nullable();
			$table->integer('shift_id')->nullable();
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('sections_affiliated_body_id_foreign');
			$table->integer('status_id')->nullable();
			$table->integer('course_id')->unsigned()->nullable()->index('sections_course_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('sections');
	}

}
