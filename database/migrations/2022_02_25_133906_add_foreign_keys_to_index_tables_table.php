<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToIndexTablesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('index_tables', function(Blueprint $table)
		{
			$table->foreign('admission_id')->references('id')->on('admissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('index_tables', function(Blueprint $table)
		{
			$table->dropForeign('index_tables_admission_id_foreign');
		});
	}

}
