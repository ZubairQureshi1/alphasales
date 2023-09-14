<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerFamilyMemberDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_family_member_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('serial_no')->nullable();
            $table->string('worker_name')->nullable();
            $table->string('worker_cnic')->nullable();
            $table->string('student_name')->nullable();
            $table->string('passed_degree')->nullable();
            $table->string('potential_degree')->nullable();
            $table->string('file_received_status')->nullable();
            $table->date('follow_up')->nullable();
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
        Schema::table('worker_family_member_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('worker_family_member_details');
    }
}
