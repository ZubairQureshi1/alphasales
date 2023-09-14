<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionCoursesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('session_courses', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('session_id')->unsigned()->index();
			$table->integer('course_id')->unsigned()->nullable()->index();
			$table->timestamps(3);
			$table->softDeletes();
			$table->integer('academic_term_id')->nullable();
			$table->integer('quota')->nullable();
			$table->integer('tuition_fee')->nullable();
			$table->integer('min_installments')->nullable();
			$table->integer('max_installments')->nullable();
			$table->integer('min_discount')->nullable();
			$table->integer('max_discount')->nullable();
			$table->string('session_start_date', 191)->nullable();
			$table->string('session_end_date', 191)->nullable();
			$table->integer('affiliated_body_id')->unsigned()->nullable()->index('session_courses_affiliated_body_id_foreign');
			$table->integer('admission_registration_fee')->nullable();
			$table->integer('exam_fee')->nullable();
			$table->integer('exam_stationery')->nullable();
			$table->integer('cfe_publication')->nullable();
			$table->integer('student_card_fee')->nullable();
			$table->integer('trasnport_card_fee')->nullable();
			$table->integer('uniform_charges')->nullable();
			$table->integer('library_card_fee')->nullable();
			$table->boolean('is_active')->default(1);
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('session_courses_organization_campus_id_foreign');
			$table->bigInteger('wing_id')->unsigned()->nullable()->index('session_courses_wing_id_foreign');
			$table->integer('cfe_admission_fee')->nullable();
			$table->integer('marketer_incentive')->nullable();
			$table->integer('registration_fee')->nullable();
			$table->integer('transport_charges')->nullable();
			$table->integer('miscellaneous')->nullable();
			$table->string('course_code', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('session_courses');
	}

}
