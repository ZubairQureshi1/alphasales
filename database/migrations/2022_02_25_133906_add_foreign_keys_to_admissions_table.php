<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToAdmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('admissions', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('enquiry_id')->references('id')->on('enquiries')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('pwwb_file_id')->references('id')->on('index_tables')->onUpdate('RESTRICT')->onDelete('SET NULL');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('admissions', function(Blueprint $table)
		{
			$table->dropForeign('admissions_academic_wing_id_foreign');
			$table->dropForeign('admissions_enquiry_id_foreign');
			$table->dropForeign('admissions_organization_campus_id_foreign');
			$table->dropForeign('admissions_organization_id_foreign');
			$table->dropForeign('admissions_pwwb_file_id_foreign');
		});
	}

}
