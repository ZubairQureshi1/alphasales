<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToFirstAnnualResultStatusDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('first_annual_result_status_details', function(Blueprint $table)
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
		Schema::table('first_annual_result_status_details', function(Blueprint $table)
		{
			$table->dropForeign('first_annual_result_status_details_index_table_id_foreign');
		});
	}

}
