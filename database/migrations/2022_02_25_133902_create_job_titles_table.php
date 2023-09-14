<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJobTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('job_titles', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('serial_no', 191)->nullable()->unique();
			$table->string('name', 191)->nullable();
			$table->string('description', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('job_titles_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('job_titles_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('job_titles_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('job_titles');
	}

}
