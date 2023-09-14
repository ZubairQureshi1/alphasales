<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_personal_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('photograph_uploaded')->nullable();
            $table->string('photograph_attested')->nullable();
            $table->integer('photograph_quantity')->nullable();
            $table->string('worker_name')->nullable();
            $table->string('applicant_name')->nullable();
            $table->string('worker_cnic')->nullable();
            $table->string('worker_cnic_attested')->nullable();
            $table->string('worker_current_status')->nullable();
            $table->string('worker_job_nature')->nullable();
            $table->string('factory_status')->nullable();
            $table->string('worker_relationship')->nullable();
            $table->string('specify_relationship')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->string('pwwb_scholarship_form')->nullable();
            $table->string('factory_card')->nullable();
            $table->string('service_letter')->nullable();
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
        Schema::table('worker_personal_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('worker_personal_details');
    }
}
