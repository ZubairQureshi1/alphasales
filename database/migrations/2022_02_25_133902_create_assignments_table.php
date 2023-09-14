<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAssignmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('assignments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('title', 191)->nullable();
			$table->string('topic', 191)->nullable();
			$table->dateTime('due_date')->nullable();
			$table->string('attachment_url', 191)->nullable();
			$table->timestamps(3);
			$table->integer('part_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('assignments_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('assignments_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('assignments_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('assignments');
	}

}
