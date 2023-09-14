<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsSubjectCodeAndCreditHoursToSessionCourseSubjects extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_course_subjects', function (Blueprint $table) {
            $table->string('subject_code')->nullable();
            $table->integer('credit_hours')->nullable();
            $table->integer('prerequisite_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_course_subjects', function (Blueprint $table) {
            $table->dropColumn('subject_code');
            $table->dropColumn('credit_hours');
            $table->dropColumn('prerequisite_id');
        });
    }
}
