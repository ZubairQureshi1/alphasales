<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('form_no')->unique()->nullable();
            $table->string('student_name')->nullable();
            $table->string('student_cnic_no')->unique()->nullable();
            $table->string('profile_pic')->nullable();
            $table->string('father_name')->nullable();
            $table->string('father_cnic_no')->nullable();
            $table->string('d_o_b')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('session_name')->nullable();
            $table->string('course_name')->nullable();
            $table->string('father_work_address')->nullable();
            $table->string('father_cell_no')->nullable();
            $table->string('student_cell_no')->nullable();
            $table->string('ptcl_no')->nullable();
            $table->string('gaurdian_name')->nullable();
            $table->string('gaurdian_cell_no')->nullable();
            $table->string('gaurdian_relationship')->nullable();
            $table->string('present_address')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('cell_no_emergency')->nullable();
            $table->string('reference_name')->nullable();
            $table->string('reference_id')->nullable();
            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->index(['session_id']);
            $table->unsignedInteger('course_id');
            $table->foreign('course_id')->references('id')->on('courses');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['session_id'], ['course_id']);
        });
        Schema::dropIfExists('admissions');
    }
}
