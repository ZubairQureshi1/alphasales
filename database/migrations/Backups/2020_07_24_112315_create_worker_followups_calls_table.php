<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkerFollowupsCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_followups_calls', function (Blueprint $table) {
            // $table->bigIncrements('id');
            // $table->unsignedBigInteger('index_table_id');
            // $table->foreign('index_table_id')
            //     ->references('id')->on('index_tables')
            //     ->onDelete('cascade');
            $table->unsignedBigInteger('family_id');
            // $table->foreign('family_id')
            //     ->references('id')->on('worker_family_member_details')
            //     ->onDelete('cascade');
            $table->string('callby')->nullable();
            $table->string('callstatus')->nullable();
            $table->string('status')->nullable();
            $table->string('answeredby')->nullable();
            $table->string('attendantrelationship')->nullable();
            $table->string('followupranking')->nullable();
            $table->string('nextfollowupdate')->nullable();
            $table->string('remarks')->nullable();
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
        Schema::dropIfExists('worker_followups_calls');
    }
}
