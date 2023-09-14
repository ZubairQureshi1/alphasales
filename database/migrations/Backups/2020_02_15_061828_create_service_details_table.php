<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('serial_no')->nullable();
            $table->string('name')->nullable();
            $table->date('appointment_date')->nullable();
            $table->date('job_leaving_date')->nullable();
            $table->string('total_period')->nullable();
            $table->date('completion_date')->nullable();
            $table->string('service_completion_status')->nullable();
            $table->string('attested_by_factory_manager')->nullable();
            $table->string('attested_by_dol')->nullable();
            $table->string('attested_by_director')->nullable();
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
        Schema::table('service_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('service_details');
    }
}
