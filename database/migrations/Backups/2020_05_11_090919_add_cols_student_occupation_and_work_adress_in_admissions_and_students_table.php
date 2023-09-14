<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsStudentOccupationAndWorkAdressInAdmissionsAndStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->string('student_occupation')->nullable();
            $table->string('student_work_address')->nullable();
            $table->string('faculty_member_name')->nullable();
            $table->string('academy_school_name')->nullable();
        });
        Schema::table('students', function (Blueprint $table) {
            $table->string('student_occupation')->nullable();
            $table->string('student_work_address')->nullable();
            $table->string('faculty_member_name')->nullable();
            $table->string('academy_school_name')->nullable();
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
            $table->dropColumn('student_occupation');
            $table->dropColumn('student_work_address');
            $table->dropColumn('faculty_member_name');
            $table->dropColumn('academy_school_name');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('student_occupation');
            $table->dropColumn('student_work_address');
            $table->dropColumn('faculty_member_name');
            $table->dropColumn('academy_school_name');
        });
    }
}
