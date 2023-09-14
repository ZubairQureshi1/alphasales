<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryFollowupsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enquiry_followups', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('enq_form_code', 191)->nullable();
			$table->integer('enquiry_id')->unsigned()->index('enquiry_followups_enquiry_id_foreign');
			$table->string('next_date', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->integer('status_id')->nullable();
			$table->string('remarks', 191)->nullable();
			$table->timestamps(3);
			$table->string('interest_level', 191)->nullable();
			$table->integer('interest_level_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('enquiry_followups_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('enquiry_followups_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('enquiry_followups_academic_wing_id_foreign');
			$table->integer('followup_type_id')->nullable();
			$table->string('prospect_name', 191)->nullable();
			$table->string('prospect_relationship', 191)->nullable();
			$table->string('prospect_course', 191)->nullable();
			$table->string('prospect_parent_id', 191)->nullable();
			$table->string('called_by', 191)->nullable();
			$table->string('answered_by', 191)->nullable();
			$table->string('prospect_father_name', 191)->nullable();
			$table->string('prospect_shift_id', 191)->nullable();
			$table->string('prospect_is_transport', 191)->nullable();
			$table->string('prospect_contact_number', 191)->nullable();
			$table->string('prospect_transport_stop', 191)->nullable();
			$table->string('followup_status_group_name', 191)->nullable();
			$table->string('student_relationship_with_attendant', 191)->nullable();
			$table->integer('session_id')->unsigned()->nullable()->index('enquiry_followups_session_id_foreign');
			$table->string('call_status_name', 191)->nullable();
			$table->integer('call_status_id')->nullable();
			$table->string('prospect_father_cnic', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enquiry_followups');
	}

}
