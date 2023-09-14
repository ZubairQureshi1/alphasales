<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('section_teachers', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('user_id')->unsigned()->nullable()->index('section_teachers_user_id_foreign');
			$table->string('user_name', 191)->nullable();
			$table->bigInteger('type')->nullable();
			$table->integer('section_id')->unsigned()->nullable()->index('section_teachers_section_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('section_detail_id')->unsigned()->index('section_teachers_section_detail_id_foreign');
			$table->bigInteger('section_subject_detail_id')->unsigned()->index('section_teachers_section_subject_detail_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('section_teachers');
	}

}
