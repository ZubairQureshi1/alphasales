<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPersonalDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_personal_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('student_personal_details_index_table_id_foreign');
			$table->string('name', 191)->nullable();
			$table->string('father_name', 191)->nullable();
			$table->string('cnic_no', 191)->nullable();
			$table->string('quantity', 191)->nullable();
			$table->string('student_cnic_attested', 191)->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('present_address', 191)->nullable();
			$table->string('marital_status', 191)->nullable();
			$table->string('postal_address', 191)->nullable();
			$table->string('email', 191)->nullable();
			$table->string('signature', 191)->nullable();
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
		Schema::drop('student_personal_details');
	}

}
