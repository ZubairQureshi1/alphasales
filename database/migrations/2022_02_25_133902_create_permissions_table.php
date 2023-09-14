<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('permissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('action_name', 191);
			$table->string('module_name', 191);
			$table->string('guard_name', 191);
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('permissions_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('permissions_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('permissions_academic_wing_id_foreign');
			$table->bigInteger('system_menu_id')->unsigned()->nullable()->index('permissions_system_menu_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('permissions');
	}

}
