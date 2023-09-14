<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropUniqueConstraintStudentCnicFromAdmissionsAndStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropUnique(['student_cnic_no']);
        });
        Schema::table('students', function (Blueprint $table) {
            $table->dropUnique(['student_cnic_no']);
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
            $table->unique('student_cnic_no');
        });
        Schema::table('students', function (Blueprint $table) {
            $table->unique('student_cnic_no');
        });
    }
}
