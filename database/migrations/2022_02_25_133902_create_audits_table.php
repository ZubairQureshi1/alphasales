<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAuditsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('audits', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('user_type', 191)->nullable();
			$table->bigInteger('user_id')->unsigned()->nullable();
			$table->string('event', 191);
			$table->string('auditable_type', 191);
			$table->bigInteger('auditable_id')->unsigned();
			$table->text('old_values')->nullable();
			$table->text('new_values')->nullable();
			$table->text('url')->nullable();
			$table->string('ip_address', 45)->nullable();
			$table->string('user_agent', 191)->nullable();
			$table->string('tags', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('audits_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('audits_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('audits_academic_wing_id_foreign');
			$table->index(['auditable_type','auditable_id']);
			$table->index(['user_id','user_type']);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('audits');
	}

}
