<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationDepartmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designation_departments', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('designation_id')->unsigned()->nullable()->index('designation_departments_designation_id_foreign');
			$table->integer('department_id')->unsigned()->nullable()->index('designation_departments_department_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('designation_departments_organization_campus_id_foreign');
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designation_departments');
	}

}
