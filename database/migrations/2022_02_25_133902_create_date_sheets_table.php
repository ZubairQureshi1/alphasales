<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateSheetsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_sheets', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('course_id')->unsigned()->nullable()->index('date_sheets_course_id_foreign');
			$table->integer('session_id')->unsigned()->nullable()->index('date_sheets_session_id_foreign');
			$table->integer('exam_type_id')->unsigned()->nullable()->index('date_sheets_exam_type_id_foreign');
			$table->string('exam_type_name', 191)->nullable();
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('date_sheets_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('date_sheets_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('date_sheets_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('date_sheets');
	}

}
