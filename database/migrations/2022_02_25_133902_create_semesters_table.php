<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSemestersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('semesters', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('semester')->nullable();
			$table->integer('course_id')->unsigned()->nullable()->index('semesters_course_id_foreign');
			$table->integer('session_id')->unsigned()->nullable()->index('semesters_session_id_foreign');
			$table->timestamps(3);
			$table->integer('min_discount')->nullable();
			$table->integer('max_discount')->nullable();
			$table->integer('min_installments')->nullable();
			$table->integer('max_installments')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('semesters_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('semesters_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('semesters_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('semesters');
	}

}
