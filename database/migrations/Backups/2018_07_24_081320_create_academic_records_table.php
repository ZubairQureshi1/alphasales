<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcademicRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('academic_records', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type_name')->nullable();
            $table->string('type_id')->nullable();
            $table->string('year')->nullable();
            $table->string('marks')->nullable();
            $table->string('grade')->nullable();
            $table->string('school_college')->nullable();
            $table->string('board_uni')->nullable();
            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('set null');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('set null');
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
         Schema::table('academic_records', function (Blueprint $table) {
            $table->dropForeign(['admission_id'],['student_id']);
        });
        Schema::dropIfExists('academic_records');
    }
}
