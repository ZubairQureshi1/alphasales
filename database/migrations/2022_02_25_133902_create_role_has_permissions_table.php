<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleHasPermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('role_has_permissions', function(Blueprint $table)
		{
			$table->integer('permission_id')->unsigned();
			$table->integer('role_id')->unsigned()->index('role_has_permissions_role_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('role_has_permissions_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('role_has_permissions_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('role_has_permissions_academic_wing_id_foreign');
			$table->primary(['permission_id','role_id']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('role_has_permissions');
	}

}
