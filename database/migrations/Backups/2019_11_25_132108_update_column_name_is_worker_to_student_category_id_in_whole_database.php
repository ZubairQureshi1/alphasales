<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateColumnNameIsWorkerToStudentCategoryIdInWholeDatabase extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('is_worker', 'student_category_id');
        });
        Schema::table('enquiries', function (Blueprint $table) {
            $table->renameColumn('is_worker', 'student_category_id');
        });
        Schema::table('admissions', function (Blueprint $table) {
            $table->renameColumn('is_worker', 'student_category_id');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

        Schema::table('students', function (Blueprint $table) {
            $table->renameColumn('student_category_id', 'is_worker');
        });
        Schema::table('enquiries', function (Blueprint $table) {
            $table->renameColumn('student_category_id', 'is_worker');
        });
        Schema::table('admissions', function (Blueprint $table) {
            $table->renameColumn('student_category_id', 'is_worker');
        });

    }
}
