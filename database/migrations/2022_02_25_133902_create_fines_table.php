<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('fines', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('name', 191)->nullable();
			$table->integer('amount')->nullable();
			$table->integer('status_id')->nullable();
			$table->string('status_name', 191)->nullable();
			$table->string('voucher_code', 191)->nullable();
			$table->string('due_date', 191)->nullable();
			$table->string('paid_date', 191)->nullable();
			$table->integer('course_id')->unsigned()->nullable()->index('fines_course_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('fines_student_id_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('fines_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('fines_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('fines_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('fines');
	}

}
