<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToCourseSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_subjects', function (Blueprint $table) {
            $table->integer('mid_term_attendance_percentage')->nullable();
            $table->integer('final_term_attendance_percentage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_subjects', function (Blueprint $table) {
            $table->dropColumn(['mid_term_attendance_percentage', 'final_term_attendance_percentage']);
        });
    }
}
