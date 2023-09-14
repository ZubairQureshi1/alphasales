<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToSectionSubjectDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('section_subject_details', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('section_detail_id')->references('id')->on('section_details')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('section_id')->references('id')->on('sections')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('session_id')->references('id')->on('sections')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('subject_id')->references('id')->on('subjects')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('section_subject_details', function(Blueprint $table)
		{
			$table->dropForeign('section_subject_details_academic_wing_id_foreign');
			$table->dropForeign('section_subject_details_organization_campus_id_foreign');
			$table->dropForeign('section_subject_details_organization_id_foreign');
			$table->dropForeign('section_subject_details_section_detail_id_foreign');
			$table->dropForeign('section_subject_details_section_id_foreign');
			$table->dropForeign('section_subject_details_session_id_foreign');
			$table->dropForeign('section_subject_details_subject_id_foreign');
		});
	}

}
