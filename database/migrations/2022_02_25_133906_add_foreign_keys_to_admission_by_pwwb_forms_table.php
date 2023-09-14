<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdmissionByPwwbFormsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('admission_by_pwwb_forms', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('admission_id')->references('id')->on('admissions')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('index_table_id')->references('id')->on('index_tables')->onUpdate('RESTRICT')->onDelete('CASCADE');
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
		Schema::table('admission_by_pwwb_forms', function(Blueprint $table)
		{
			$table->dropForeign('admission_by_pwwb_forms_academic_wing_id_foreign');
			$table->dropForeign('admission_by_pwwb_forms_admission_id_foreign');
			$table->dropForeign('admission_by_pwwb_forms_index_table_id_foreign');
			$table->dropForeign('admission_by_pwwb_forms_organization_campus_id_foreign');
			$table->dropForeign('admission_by_pwwb_forms_organization_id_foreign');
		});
	}

}
