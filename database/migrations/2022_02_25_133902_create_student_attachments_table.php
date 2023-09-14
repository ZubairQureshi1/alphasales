<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentAttachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('student_attachments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('attachment_name', 191)->nullable();
			$table->string('attachment_type', 191)->nullable();
			$table->integer('attachment_type_id')->nullable();
			$table->string('attachment_url', 191)->nullable();
			$table->string('attachment_from', 191)->nullable();
			$table->integer('attachment_for')->unsigned()->nullable()->index('student_attachments_attachment_for_foreign');
			$table->timestamps(3);
			$table->bigInteger('organization_id')->unsigned()->nullable()->index('student_attachments_organization_id_foreign');
			$table->bigInteger('organization_campus_id')->unsigned()->nullable()->index('student_attachments_organization_campus_id_foreign');
			$table->bigInteger('academic_wing_id')->unsigned()->nullable()->index('student_attachments_academic_wing_id_foreign');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('student_attachments');
	}

}
