<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCampusWingsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organization_campus_wings', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('organization_campus_wings_organization_campus_id_foreign');
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('organization_campus_wings_wing_id_foreign');
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
		Schema::drop('organization_campus_wings');
	}

}
