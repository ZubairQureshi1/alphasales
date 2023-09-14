<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('section_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->string('section_name', 191)->nullable();
			$table->string('section_code', 191)->nullable();
			$table->integer('section_strength')->nullable();
			$table->integer('section_id')->unsigned()->nullable()->index('section_details_section_id_foreign');
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
		Schema::drop('section_details');
	}

}
