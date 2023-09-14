<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('admissions', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('form_no', 191)->nullable();
			$table->string('student_name', 191)->nullable();
			$table->string('student_cnic_no', 191)->nullable();
			$table->string('profile_pic', 191)->nullable();
			$table->string('father_name', 191)->nullable();
			$table->string('father_cnic_no', 191)->nullable();
			$table->string('d_o_b', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('session_name', 191)->nullable();
			$table->string('course_name', 191)->nullable();
			$table->string('father_work_address', 191)->nullable();
			$table->string('father_cell_no', 191)->nullable();
			$table->string('student_cell_no', 191)->nullable();
			$table->string('ptcl_no', 191)->nullable();
			$table->string('gaurdian_name', 191)->nullable();
			$table->string('gaurdian_cell_no', 191)->nullable();
			$table->string('gaurdian_relationship', 191)->nullable();
			$table->string('present_address', 191)->nullable();
			$table->string('permanent_address', 191)->nullable();
			$table->string('cell_no_emergency', 191)->nullable();
			$table->string('reference_name', 191)->nullable();
			$table->string('reference_id', 191)->nullable();
			$table->integer('session_id')->unsigned()->index();
			$table->integer('course_id')->unsigned()->index('admissions_course_id_foreign');
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('student_id')->unsigned()->nullable()->index('admissions_student_id_foreign');
			$table->string('old_roll_no', 191)->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('admissions_user_id_foreign');
			$table->string('user_name', 191)->nullable();
			$table->integer('admission_type_id')->nullable();
			$table->string('admission_type', 191)->nullable();
			$table->date('admission_date')->nullable();
			$table->string('semester', 191)->nullable();
			$table->integer('semester_id')->nullable();
			$table->string('icap_crn', 191)->nullable();
			$table->string('icap_roll_no', 191)->nullable();
			$table->string('gender', 191)->nullable();
			$table->integer('gender_id')->nullable();
			$table->string('shift', 191)->nullable();
			$table->integer('shift_id')->nullable();
			$table->string('counselor_by', 191)->nullable();
			$table->integer('student_category_id')->nullable();
			$table->string('experience', 191)->nullable();
			$table->string('designation', 191)->nullable();
			$table->string('eobi', 191)->nullable();
			$table->string('ssc', 191)->nullable();
			$table->string('factory_city', 191)->nullable();
			$table->string('factory_reg_no', 191)->nullable();
			$table->integer('is_transport')->nullable();
			$table->integer('is_hostel')->nullable();
			$table->integer('is_provisional_letter')->nullable();
			$table->string('cfe_file_no', 191)->nullable();
			$table->string('dairy_no', 191)->nullable();
			$table->integer('self_worker')->nullable();
			$table->string('r_eight', 191)->nullable();
			$table->string('factory_name', 191)->nullable();
			$table->integer('transport_route_id')->nullable();
			$table->date('worker_joining_date')->nullable();
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('admissions_affiliated_body_id_foreign');
			$table->integer('degree_level_id')->nullable();
			$table->integer('academic_term_id')->nullable();
			$table->string('transport_stop', 191)->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('admissions_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('admissions_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('admissions_academic_wing_id_foreign');
			$table->string('student_category_name', 191)->nullable();
			$table->string('father_occupation', 191)->nullable();
			$table->string('city_id', 191)->nullable();
			$table->string('other_city_name', 191)->nullable();
			$table->string('source_info_id', 191)->nullable();
			$table->string('marketer_name', 191)->nullable();
			$table->string('social_media_type_id', 191)->nullable();
			$table->string('other_social_media_name', 191)->nullable();
			$table->string('ex_student_wing_type_id', 191)->nullable();
			$table->string('ex_student_name', 191)->nullable();
			$table->string('friend_name', 191)->nullable();
			$table->string('other_source_of_info', 191)->nullable();
			$table->string('guardian_cnic', 191)->nullable();
			$table->integer('enquiry_id')->unsigned()->nullable()->index('admissions_enquiry_id_foreign');
			$table->bigInteger('pwwb_file_id')->unsigned()->nullable()->index('admissions_pwwb_file_id_foreign');
			$table->string('student_occupation', 191)->nullable();
			$table->string('student_work_address', 191)->nullable();
			$table->string('faculty_member_name', 191)->nullable();
			$table->string('academy_school_name', 191)->nullable();
			$table->string('attachment_url', 191)->nullable();
			$table->boolean('checklist_incomplete')->default(0);
			$table->string('area', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('admissions');
	}

}
