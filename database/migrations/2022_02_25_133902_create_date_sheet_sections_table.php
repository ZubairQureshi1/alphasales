<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateSheetSectionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_sheet_sections', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('section_id')->unsigned()->nullable()->index('date_sheet_sections_section_id_foreign');
			$table->integer('date_sheet_id')->unsigned()->nullable()->index('date_sheet_sections_date_sheet_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('date_sheet_sections_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('date_sheet_sections_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('date_sheet_sections_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('date_sheet_sections');
	}

}
