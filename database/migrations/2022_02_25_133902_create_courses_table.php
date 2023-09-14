<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->default('');
			$table->integer('size_kanal')->unsigned()->nullable();
			$table->integer('size_marla')->unsigned()->nullable();
			$table->string('nature_plot', 50)->nullable();
			$table->string('project', 50)->nullable();
			$table->integer('duration')->nullable();
			$table->integer('no_of_semesters')->nullable();
			$table->integer('duration_per_semester')->nullable();
			$table->timestamps(3);
			$table->softDeletes();
			$table->string('course_code', 191)->nullable();
			$table->string('vendor_share_amount', 191)->nullable();
			$table->integer('degree_level_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('courses_organization_id_foreign');
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('courses_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('courses');
	}

}
