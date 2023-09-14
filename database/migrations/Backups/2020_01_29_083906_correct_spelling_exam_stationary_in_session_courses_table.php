<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CorrectSpellingExamStationaryInSessionCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->renameColumn('exam_stationary', 'exam_stationery');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->renameColumn('exam_stationery', 'exam_stationary');
        });
    }
}
