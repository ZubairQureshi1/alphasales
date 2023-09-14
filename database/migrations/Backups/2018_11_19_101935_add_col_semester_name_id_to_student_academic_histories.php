<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColSemesterNameIdToStudentAcademicHistories extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_academic_histories', function (Blueprint $table) {
            $table->string('semester')->nullable();
            $table->integer('semester_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_academic_histories', function (Blueprint $table) {
            $table->dropColumn('semester');
            $table->dropColumn('semester_id');
        });
    }
}
