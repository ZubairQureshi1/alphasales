<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('students', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('roll_no', 191)->nullable();
			$table->string('student_name', 191)->nullable();
			$table->string('student_cnic_no', 191)->nullable();
			$table->string('profile_pic', 191)->nullable();
			$table->string('father_name', 191)->nullable();
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
			$table->integer('admission_id')->unsigned()->nullable()->index('students_admission_id_foreign');
			$table->integer('session_id')->unsigned()->index();
			$table->integer('course_id')->unsigned()->index('students_course_id_foreign');
			$table->timestamps(3);
			$table->softDeletes();
			$table->string('qr_code_name', 191)->nullable();
			$table->string('old_roll_no', 191)->nullable();
			$table->string('reference_name', 191)->nullable();
			$table->string('reference_id', 191)->nullable();
			$table->string('father_cnic_no', 191)->nullable();
			$table->integer('section_id')->unsigned()->nullable()->index('students_section_id_foreign');
			$table->string('section_name', 191)->nullable();
			$table->integer('user_id')->unsigned()->nullable()->index('students_user_id_foreign');
			$table->string('user_name', 191)->nullable();
			$table->integer('system_roll_number_id')->unsigned()->nullable()->index('students_system_roll_number_id_foreign');
			$table->integer('admission_type_id')->nullable();
			$table->string('admission_type', 191)->nullable();
			$table->boolean('is_end_of_reg')->default(0);
			$table->string('remark_end_of_reg', 191)->nullable();
			$table->date('admission_date')->nullable();
			$table->string('semester', 191)->nullable();
			$table->integer('semester_id')->nullable();
			$table->string('reason_end_of_reg', 191)->nullable();
			$table->integer('reason_end_of_reg_id')->nullable();
			$table->string('icap_crn', 191)->nullable();
			$table->string('icap_roll_no', 191)->nullable();
			$table->string('gender', 191)->nullable();
			$table->integer('gender_id')->nullable();
			$table->string('shift', 191)->nullable();
			$table->integer('shift_id')->nullable();
			$table->string('name', 191);
			$table->dateTime('email_verified_at')->nullable();
			$table->string('password', 191)->default('y$/RFPM0RxLTflYkoJzFbiEel9ApFe6e5FA8FSuJdyBoZa3uk5Cr4d6');
			$table->integer('semester_freeze_id')->nullable();
			$table->string('semester_freeze_reason', 191)->nullable();
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
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('students_affiliated_body_id_foreign');
			$table->integer('degree_level_id')->nullable();
			$table->integer('academic_term_id')->nullable();
			$table->string('transport_stop', 191)->nullable();
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('students_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('students_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('students_academic_wing_id_foreign');
			$table->integer('is_registered')->nullable();
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
			$table->integer('enquiry_id')->unsigned()->nullable()->index('students_enquiry_id_foreign');
			$table->string('student_occupation', 191)->nullable();
			$table->string('student_work_address', 191)->nullable();
			$table->string('faculty_member_name', 191)->nullable();
			$table->string('academy_school_name', 191)->nullable();
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
		Schema::drop('students');
	}

}
