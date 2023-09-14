<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionByEnquiryFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_by_enquiry_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->string('student_name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->integer('reference_id')->nullable();
            $table->string('reference_name')->nullable();
            $table->unsignedInteger('enquiry_id')->nullable();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('set null');
            $table->string('enq_form_code')->nullable();
            $table->string('status')->nullable();
            $table->integer('status_id')->nullable();
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
        Schema::table('admission_by_enquiry_forms', function (Blueprint $table) {
            $table->dropForeign(['enquiry_id']);
        });
        Schema::dropIfExists('admission_by_enquiry_forms');
    }
}
