<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadFinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('head_fines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->integer('amount')->nullable();
			$table->timestamps(3);
			$table->string('vendor_share_amount', 191)->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('head_fines_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('head_fines_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('head_fines_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('head_fines');
	}

}
