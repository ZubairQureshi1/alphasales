<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerFamilyMemberDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_family_member_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('worker_family_member_details_index_table_id_foreign');
			$table->string('serial_no', 191)->nullable();
			$table->string('worker_name', 191)->nullable();
			$table->string('worker_cnic', 191)->nullable();
			$table->string('student_name', 191)->nullable();
			$table->string('passed_degree', 191)->nullable();
			$table->string('potential_degree', 191)->nullable();
			$table->string('file_received_status', 191)->nullable();
			$table->date('follow_up')->nullable();
			$table->timestamps(3);
			$table->string('follow_up_status', 191)->nullable();
			$table->integer('family_id')->unsigned()->nullable();
			$table->string('callby', 191)->nullable();
			$table->string('callstatus', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->string('answeredby', 191)->nullable();
			$table->string('attendantrelationship', 191)->nullable();
			$table->string('followupranking', 191)->nullable();
			$table->string('nextfollowupdate', 191)->nullable();
			$table->string('remarks', 191)->nullable();
			$table->string('organization_campus_id', 191)->nullable();
			$table->string('session_id', 191)->nullable();
			$table->string('change', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('worker_family_member_details');
	}

}
