<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserDesignationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_designations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->nullable()->index('user_designations_user_id_foreign');
			$table->integer('designation_id')->unsigned()->nullable()->index('user_designations_designation_id_foreign');
			$table->string('user_name', 191);
			$table->string('designation_name', 191);
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('user_designations_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('user_designations_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('user_designations_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_designations');
	}

}
