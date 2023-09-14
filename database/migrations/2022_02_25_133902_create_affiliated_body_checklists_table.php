<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAffiliatedBodyChecklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('affiliated_body_checklists', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('affiliated_body_checklists_affiliated_body_id_foreign');
			$table->text('description')->nullable();
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
		Schema::drop('affiliated_body_checklists');
	}

}
