<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdmissionAffiliatedBodyChecklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('admission_affiliated_body_checklists', function(Blueprint $table)
		{
			$table->foreign('affiliated_body_checklist_id', 'abc_id')->references('id')->on('affiliated_body_checklists')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('admission_affiliated_body_checklists', function(Blueprint $table)
		{
			$table->dropForeign('abc_id');
			$table->dropForeign('admission_affiliated_body_checklists_admission_id_foreign');
		});
	}

}
