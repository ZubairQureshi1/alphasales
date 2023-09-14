<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColWorkerWorkTypeToEnquiryWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiry_workers', function (Blueprint $table) {
            $table->string('worker_work_type')->nullable();
            $table->integer('worker_work_type_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiry_workers', function (Blueprint $table) {
            $table->dropColumn('worker_work_type');
            $table->dropColumn('worker_work_type_id');
        });
    }
}
