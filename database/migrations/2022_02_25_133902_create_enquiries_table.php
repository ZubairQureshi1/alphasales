<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('enquiries', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('form_code', 191)->default('');
			$table->string('name', 191)->default('');
			$table->string('enquiry_type', 191)->default('');
			$table->string('father_name', 191)->nullable()->default('');
			$table->string('father_occupation', 191)->nullable()->default('');
			$table->string('remarks', 191)->nullable()->default('');
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('user_id')->unsigned()->nullable()->index('enquiries_user_id_foreign');
			$table->integer('entry_by')->nullable();
			$table->string('user_name', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->integer('status_id')->nullable();
			$table->integer('student_category_id')->nullable();
			$table->integer('shift_id')->nullable();
			$table->integer('source_info_id')->nullable();
			$table->integer('is_transport')->nullable();
			$table->integer('transport_route_id')->nullable();
			$table->string('father_cell_no', 191)->nullable();
			$table->string('student_cell_no', 191)->nullable();
			$table->string('gaurdian_cell_no', 191)->nullable();
			$table->string('other_cell_no', 191)->nullable();
			$table->string('present_address', 191)->nullable();
			$table->string('permanent_address', 191)->nullable();
			$table->string('reference_name', 191)->nullable();
			$table->integer('reference_id')->nullable();
			$table->string('session_name', 191)->nullable();
			$table->integer('session_id')->nullable();
			$table->string('marks_obtained', 191)->nullable();
			$table->string('total_marks', 191)->nullable();
			$table->string('percentage', 191)->nullable();
			$table->string('student_cnic_no', 191)->nullable();
			$table->string('father_cnic_no', 191)->nullable();
			$table->string('dob', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->integer('city_id')->unsigned()->nullable()->index('enquiries_city_id_foreign');
			$table->integer('previous_degree_id')->nullable();
			$table->integer('follow_up_interested_level_id')->nullable();
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('enquiries_affiliated_body_id_foreign');
			$table->integer('course_id')->unsigned()->nullable()->index('enquiries_course_id_foreign');
			$table->date('enquiry_date')->nullable();
			$table->string('passing_year', 191)->nullable();
			$table->boolean('is_domicile')->nullable();
			$table->string('previous_degree_body', 191)->nullable();
			$table->integer('academic_term_id')->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('enquiries_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('enquiries_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('enquiries_academic_wing_id_foreign');
			$table->string('transport_stop', 191)->nullable();
			$table->string('degree_name_other', 191)->nullable();
			$table->string('area', 191)->nullable();
			$table->string('marketer_name', 191)->nullable();
			$table->string('social_media_type_id', 191)->nullable();
			$table->string('other_social_media_name', 191)->nullable();
			$table->string('ex_student_wing_type_id', 191)->nullable();
			$table->string('ex_student_name', 191)->nullable();
			$table->string('friend_name', 191)->nullable();
			$table->string('other_source_of_info', 191)->nullable();
			$table->integer('gender_id')->nullable();
			$table->string('followup_status_group_name', 191)->nullable();
			$table->string('parent_id', 191)->nullable();
			$table->string('course_name', 191)->nullable();
			$table->string('affiliated_body_name', 191)->nullable();
			$table->string('student_category_name', 191)->nullable();
			$table->string('other_city_name', 191)->nullable();
			$table->string('previous_degree_name', 191)->nullable();
			$table->string('faculty_member_name', 191)->nullable();
			$table->string('academy_school_name', 191)->nullable();
			$table->boolean('form_bypassed')->default(0);
			$table->integer('provisional_letter_application_recieved')->nullable();
			$table->integer('stamp_paper_filled')->nullable();
			$table->integer('file_received_status')->nullable();
			$table->string('file_received_number', 191)->nullable();
			$table->string('file_module_number', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('enquiries');
	}

}
