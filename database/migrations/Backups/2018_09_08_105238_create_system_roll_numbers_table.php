<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSystemRollNumbersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('system_roll_numbers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('roll_no')->nullable();
            
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
            $table->string('student_name')->nullable();

            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('set null');
            $table->string('admission_form_code')->nullable();

            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
            $table->string('course_name')->nullable();

            $table->unsignedInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('set null');
            $table->string('section_name')->nullable();

            $table->unsignedInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('set null');
            $table->string('session_name')->nullable();

            $table->boolean('is_assigned')->nullable();

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
        Schema::table('system_roll_numbers', function (Blueprint $table) {
            $table->dropForeign(['session_id'], ['course_id'], ['section_id'], ['student_id'], ['admission_id']);
        });
        Schema::dropIfExists('system_roll_numbers');
    }
}
