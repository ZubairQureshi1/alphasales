<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEighthSemesterDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('eighth_semester_details', function(Blueprint $table)
		{
			$table->foreign('index_table_id')->references('id')->on('index_tables')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('eighth_semester_details', function(Blueprint $table)
		{
			$table->dropForeign('eighth_semester_details_index_table_id_foreign');
		});
	}

}
