<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAffiliatedBodyChecklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('affiliated_body_checklists', function(Blueprint $table)
		{
			$table->foreign('affiliated_body_id')->references('id')->on('affiliated_bodies')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('affiliated_body_checklists', function(Blueprint $table)
		{
			$table->dropForeign('affiliated_body_checklists_affiliated_body_id_foreign');
		});
	}

}
