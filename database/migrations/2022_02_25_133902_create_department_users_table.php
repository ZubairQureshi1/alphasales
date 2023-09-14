<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDepartmentUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('department_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('department_id')->unsigned()->nullable()->index('department_users_department_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('department_users_user_id_foreign');
			$table->bigInteger('user_campus_detail_id')->unsigned()->nullable()->index('department_users_user_campus_detail_id_foreign');
			$table->string('user_name', 191)->nullable();
			$table->string('department_name', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('department_users_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('department_users_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('department_users_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('department_users');
	}

}
