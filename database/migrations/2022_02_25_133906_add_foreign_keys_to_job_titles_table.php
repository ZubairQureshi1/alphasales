<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToJobTitlesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('job_titles', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('job_titles', function(Blueprint $table)
		{
			$table->dropForeign('job_titles_academic_wing_id_foreign');
			$table->dropForeign('job_titles_organization_campus_id_foreign');
			$table->dropForeign('job_titles_organization_id_foreign');
		});
	}

}
