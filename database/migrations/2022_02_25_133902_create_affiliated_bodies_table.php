<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatedBodiesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliated_bodies', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191);
			$table->string('code', 191);
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('affiliated_bodies_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('affiliated_bodies_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('affiliated_bodies_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('affiliated_bodies');
	}

}
