<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCAHistoriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('c_a_histories', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('ca_subject', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->integer('status_id')->nullable();
			$table->string('raet_institution', 191)->nullable();
			$table->integer('admission_id')->unsigned()->nullable()->index('c_a_histories_admission_id_foreign');
			$table->integer('student_id')->unsigned()->nullable()->index('c_a_histories_student_id_foreign');
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
		Schema::drop('c_a_histories');
	}

}
