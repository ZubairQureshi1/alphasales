<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSectionTeachersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('section_teachers', function(Blueprint $table)
		{
			$table->foreign('section_detail_id')->references('id')->on('section_details')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('section_id')->references('id')->on('sections')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('section_subject_detail_id')->references('id')->on('section_subject_details')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('section_teachers', function(Blueprint $table)
		{
			$table->dropForeign('section_teachers_section_detail_id_foreign');
			$table->dropForeign('section_teachers_section_id_foreign');
			$table->dropForeign('section_teachers_section_subject_detail_id_foreign');
			$table->dropForeign('section_teachers_user_id_foreign');
		});
	}

}
