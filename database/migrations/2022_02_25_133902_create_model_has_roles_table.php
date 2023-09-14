<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateModelHasRolesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('model_has_roles', function(Blueprint $table)
		{
			$table->integer('role_id')->unsigned();
			$table->string('model_type', 191);
			$table->bigInteger('model_id')->unsigned();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('model_has_roles_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('model_has_roles_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('model_has_roles_academic_wing_id_foreign');
			$table->index(['model_type','model_id']);
			$table->primary(['role_id','model_id','model_type']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('model_has_roles');
	}

}
