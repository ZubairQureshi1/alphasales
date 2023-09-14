<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCourseAffiliatedBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('course_affiliated_bodies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->nullable()->index('course_affiliated_bodies_course_id_foreign');
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('course_affiliated_bodies_affiliated_body_id_foreign');
			$table->integer('academic_term_id')->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('course_affiliated_bodies_organization_id_foreign');
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('course_affiliated_bodies_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('course_affiliated_bodies');
	}

}
