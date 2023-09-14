<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToDualCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('dual_course_details', function (Blueprint $table) {
            $table->string('board_university')->nullable();
            $table->string('previous_percentage')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('dual_course_details', function (Blueprint $table) {
            $table->dropColumn('board_university');
            $table->dropColumn('previous_percentage');
        });
    }
}
