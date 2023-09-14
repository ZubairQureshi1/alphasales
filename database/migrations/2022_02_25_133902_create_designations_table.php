<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDesignationsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('designations', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->default('');
			$table->string('code', 191)->default('');
			$table->timestamps(3);
			$table->softDeletes();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('designations_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('designations_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('designations_academic_wing_id_foreign');
			$table->integer('department_id')->unsigned()->nullable()->index('designations_department_id_foreign');
			$table->boolean('is_active')->default(1);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('designations');
	}

}
