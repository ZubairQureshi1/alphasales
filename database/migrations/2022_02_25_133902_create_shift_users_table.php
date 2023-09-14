<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShiftUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('shift_users', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('shift_id')->unsigned()->nullable()->index('shift_users_shift_id_foreign');
			$table->integer('user_id')->unsigned()->nullable()->index('shift_users_user_id_foreign');
			$table->boolean('is_shift_active')->nullable();
			$table->boolean('has_shift_swap')->nullable();
			$table->timestamps(3);
			$table->integer('shift_swap_id')->unsigned()->nullable()->index('shift_users_shift_swap_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('shift_users_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('shift_users_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('shift_users_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('shift_users');
	}

}
