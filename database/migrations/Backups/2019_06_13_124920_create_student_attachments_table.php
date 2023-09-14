<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attachments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('attachment_name')->nullable();
            $table->string('attachment_type')->nullable();
            $table->integer('attachment_type_id')->nullable();
            $table->string('attachment_url')->nullable();
            $table->string('attachment_from')->nullable();
            $table->unsignedInteger('attachment_for')->nullable();
            $table->foreign('attachment_for')->references('id')->on('students')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('student_attachments');
    }
}
