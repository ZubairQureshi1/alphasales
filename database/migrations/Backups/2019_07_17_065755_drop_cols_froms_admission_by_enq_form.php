<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColsFromsAdmissionByEnqForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admission_by_enquiry_forms', function (Blueprint $table) {
            $table->dropColumn(['student_name', 'father_name', 'present_address', 'permanent_address', 'reference_name', 'reference_id', 'enq_form_code', 'status', 'status_id', 'is_worker', 'experience', 'designation']);
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
            $table->string('student_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('enq_form_code')->nullable();
            $table->string('status')->nullable();
            $table->string('experience')->nullable();
            $table->string('designation')->nullable();
            $table->integer('reference_id')->nullable();
            $table->integer('status_id')->nullable();
            $table->boolean('is_worker')->nullable();
        });
    }
}
