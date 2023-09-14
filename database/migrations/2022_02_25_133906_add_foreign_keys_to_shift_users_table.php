<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToShiftUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('shift_users', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('shift_users', function(Blueprint $table)
		{
			$table->dropForeign('shift_users_academic_wing_id_foreign');
			$table->dropForeign('shift_users_organization_campus_id_foreign');
			$table->dropForeign('shift_users_organization_id_foreign');
		});
	}

}