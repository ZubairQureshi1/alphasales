<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColDegreeTypeToAcademicTermInAllDb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('course_affiliated_bodies', function (Blueprint $table) {
            $table->renameColumn('degree_type_id', 'academic_term_id');
        });

        Schema::table('session_courses', function (Blueprint $table) {
            $table->renameColumn('degree_type_id', 'academic_term_id');
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->renameColumn('degree_type_id', 'academic_term_id');
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->renameColumn('degree_type_id', 'academic_term_id');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('degree_type_id', 'academic_term_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('course_affiliated_bodies', function (Blueprint $table) {
            $table->renameColumn('academic_term_id', 'degree_type_id');
        });

        Schema::table('session_courses', function (Blueprint $table) {
            $table->renameColumn('academic_term_id', 'degree_type_id');
        });

        Schema::table('enquiries', function (Blueprint $table) {
            $table->renameColumn('academic_term_id', 'degree_type_id');
        });

        Schema::table('admissions', function (Blueprint $table) {
            $table->renameColumn('academic_term_id', 'degree_type_id');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('academic_term_id', 'degree_type_id');
        });
    }
}
