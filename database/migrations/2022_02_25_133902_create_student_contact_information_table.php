<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentContactInformationTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_contact_information', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->integer('student_id')->unsigned()->nullable()->index('student_contact_information_student_id_foreign');
			$table->integer('admission_id')->unsigned()->nullable()->index('student_contact_information_admission_id_foreign');
			$table->string('contact_no', 191)->nullable();
			$table->integer('contact_type_id')->nullable();
			$table->string('contact_type_name', 191)->default('');
			$table->string('contact_type_other_name', 191)->nullable();
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_contact_information');
	}

}
