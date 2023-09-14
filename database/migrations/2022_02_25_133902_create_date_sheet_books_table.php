<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDateSheetBooksTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('date_sheet_books', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('subject_id')->unsigned()->nullable()->index('date_sheet_books_subject_id_foreign');
			$table->date('date')->nullable();
			$table->dateTime('start_time')->nullable();
			$table->dateTime('end_time')->nullable();
			$table->integer('date_sheet_id')->unsigned()->nullable()->index('date_sheet_books_date_sheet_id_foreign');
			$table->timestamps(3);
			$table->text('syllabus')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('date_sheet_books_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('date_sheet_books_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('date_sheet_books_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('date_sheet_books');
	}

}
