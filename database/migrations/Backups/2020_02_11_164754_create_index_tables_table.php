<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIndexTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('index_tables', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('session')->nullable();
            $table->string('district')->nullable();
            $table->string('district_other')->nullable();
            $table->string('file_received_number')->nullable();
            $table->date('receiving_date')->nullable();
            $table->date('submission_date')->nullable();
            $table->string('file_receipt_voucher_number')->nullable();
            $table->date('file_receipt_voucher_date')->nullable();
            $table->string('fresh_file_submission_in_pwwb_number')->nullable();
            $table->string('priority_of_submission')->nullable();
            $table->string('pwwb_diary_number')->nullable();
            $table->string('wing_id')->nullable();
            $table->string('course_id')->nullable();
            $table->string('affiliated_body_id')->nullable();
            $table->string('annual_semester_id')->nullable();
            $table->date('pwwb_diary_date')->nullable();
            $table->string('pending_files_with_remarks')->nullable();
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
        Schema::dropIfExists('index_tables');
    }
}
