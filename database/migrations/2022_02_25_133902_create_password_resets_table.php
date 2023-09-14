<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasswordResetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('password_resets', function(Blueprint $table)
		{
			$table->string('email', 191)->index();
			$table->string('token', 191);
			$table->dateTime('created_at')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('password_resets_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('password_resets_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('password_resets_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('password_resets');
	}

}
