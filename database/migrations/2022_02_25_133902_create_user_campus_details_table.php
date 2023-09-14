<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserCampusDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('user_campus_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id')->unsigned()->nullable()->index('user_campus_details_user_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('user_campus_details_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('user_campus_details_organization_campus_id_foreign');
			$table->integer('designation_id')->unsigned()->nullable()->index('user_campus_details_designation_id_foreign');
			$table->integer('job_title_id')->unsigned()->nullable()->index('user_campus_details_job_title_id_foreign');
			$table->integer('department_id')->unsigned()->nullable()->index('user_campus_details_department_id_foreign');
			$table->integer('role_id')->unsigned()->nullable()->index('user_campus_details_role_id_foreign');
			$table->boolean('is_working')->default(1);
			$table->timestamps(3);
			$table->string('emp_code', 191)->nullable()->unique();
			$table->boolean('is_primary_emp_code')->default(0);
			$table->integer('is_primary_department_id')->unsigned()->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('user_campus_details');
	}

}
