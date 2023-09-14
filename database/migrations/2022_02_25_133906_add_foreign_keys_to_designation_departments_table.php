<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToDesignationDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('designation_departments', function(Blueprint $table)
		{
			$table->foreign('department_id')->references('id')->on('departments')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('designation_id')->references('id')->on('designations')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('designation_departments', function(Blueprint $table)
		{
			$table->dropForeign('designation_departments_department_id_foreign');
			$table->dropForeign('designation_departments_designation_id_foreign');
			$table->dropForeign('designation_departments_organization_campus_id_foreign');
		});
	}

}
