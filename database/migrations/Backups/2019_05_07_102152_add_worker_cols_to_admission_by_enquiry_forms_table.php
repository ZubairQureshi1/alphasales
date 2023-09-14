<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWorkerColsToAdmissionByEnquiryFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admission_by_enquiry_forms', function (Blueprint $table) {
            $table->integer('is_worker')->nullable();
            $table->string('experience')->nullable();
            $table->string('designation')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admission_by_enquiry_forms', function (Blueprint $table) {
            $table->dropColumn(['is_worker','experience','designation']);
        });
    }
}
