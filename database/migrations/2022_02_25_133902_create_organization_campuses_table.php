<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationCampusesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('organization_campuses', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('name', 191)->nullable();
			$table->string('code', 191)->nullable();
			$table->integer('city_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('organization_campuses_organization_id_foreign');
			$table->integer('old_organization_id')->nullable();
			$table->text('address')->nullable();
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
		Schema::drop('organization_campuses');
	}

}
