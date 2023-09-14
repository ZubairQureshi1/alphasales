<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsStudentAndFatherCnicAndStudentDobAndCity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('student_cnic_no')->nullable();
            $table->string('father_cnic_no')->nullable();
            $table->string('dob')->nullable();
            $table->string('email')->nullable();
            $table->unsignedInteger('city_id')->nullable();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropforeign(['city_id']);
            $table->dropColumn(['student_cnic_no', 'father_cnic_no', 'dob', 'email', 'city_id']);
        });
    }
}
