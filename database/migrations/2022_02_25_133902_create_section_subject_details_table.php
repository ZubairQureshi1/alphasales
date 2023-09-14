<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectionSubjectDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('section_subject_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('subject_id')->unsigned()->nullable()->index('section_subject_details_subject_id_foreign');
			$table->integer('section_id')->unsigned()->nullable()->index('section_subject_details_section_id_foreign');
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('section_subject_details_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('section_subject_details_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('section_subject_details_academic_wing_id_foreign');
			$table->integer('session_id')->unsigned()->nullable()->index('section_subject_details_session_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('section_detail_id')->unsigned()->nullable()->index('section_subject_details_section_detail_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('section_subject_details');
	}

}
