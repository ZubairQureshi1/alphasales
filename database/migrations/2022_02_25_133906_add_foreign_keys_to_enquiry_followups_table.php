<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeysToEnquiryFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('enquiry_followups', function(Blueprint $table)
		{
			$table->foreign('academic_wing_id')->references('id')->on('wings')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('organization_id')->references('id')->on('organizations')->onUpdate('RESTRICT')->onDelete('SET NULL');
			$table->foreign('session_id')->references('id')->on('sessions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('enquiry_followups', function(Blueprint $table)
		{
			$table->dropForeign('enquiry_followups_academic_wing_id_foreign');
			$table->dropForeign('enquiry_followups_organization_campus_id_foreign');
			$table->dropForeign('enquiry_followups_organization_id_foreign');
			$table->dropForeign('enquiry_followups_session_id_foreign');
		});
	}

}
