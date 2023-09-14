<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionAffiliatedBodyChecklistsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admission_affiliated_body_checklists', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('admission_id')->unsigned()->nullable()->index('admission_affiliated_body_checklists_admission_id_foreign');
			$table->bigInteger('affiliated_body_checklist_id')->unsigned()->nullable()->index('abc_id');
			$table->boolean('is_checked')->nullable();
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
		Schema::drop('admission_affiliated_body_checklists');
	}

}
