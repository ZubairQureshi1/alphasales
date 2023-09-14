<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToUserCampusDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('user_campus_details', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('designation_id')->references('id')->on('designations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('job_title_id')->references('id')->on('job_titles')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('role_id')->references('id')->on('roles')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('user_campus_details', function(Blueprint $table)
		{
			$table->dropForeign('user_campus_details_department_id_foreign');
			$table->dropForeign('user_campus_details_designation_id_foreign');
			$table->dropForeign('user_campus_details_job_title_id_foreign');
			$table->dropForeign('user_campus_details_organization_campus_id_foreign');
			$table->dropForeign('user_campus_details_organization_id_foreign');
			$table->dropForeign('user_campus_details_role_id_foreign');
			$table->dropForeign('user_campus_details_user_id_foreign');
		});
	}

}
