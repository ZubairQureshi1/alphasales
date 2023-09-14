<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerFollowupsCallsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('worker_followups_calls', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('worker_followups_calls_index_table_id_foreign');
			$table->bigInteger('family_id')->unsigned()->index('worker_followups_calls_family_id_foreign');
			$table->string('callby', 191)->nullable();
			$table->string('callstatus', 191)->nullable();
			$table->string('status', 191)->nullable();
			$table->string('answeredby', 191)->nullable();
			$table->string('attendantrelationship', 191)->nullable();
			$table->string('followupranking', 191)->nullable();
			$table->string('nextfollowupdate', 191)->nullable();
			$table->string('remarks', 191)->nullable();
			$table->timestamps(3);
			$table->string('session_id', 191)->nullable();
			$table->string('organization_campus_id', 191)->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('worker_followups_calls');
	}

}
