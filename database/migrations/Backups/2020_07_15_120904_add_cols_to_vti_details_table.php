<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToVtiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('vti_details', function (Blueprint $table) {
            $table->string('vti_board_university')->nullable();
            $table->string('vti_previous_course')->nullable();
            $table->string('vti_previous_roll_no')->nullable();
            $table->date('vti_previous_passing_date')->nullable();
            $table->string('vti_previous_total_marks')->nullable();
            $table->string('vti_previous_marks_obtained')->nullable();
            $table->string('vti_previous_percentage')->nullable();
            $table->string('vti_previous_cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('vti_details', function (Blueprint $table) {
            $table->dropColumn('vti_board_university');
            $table->dropColumn('vti_previous_course');
            $table->dropColumn('vti_previous_roll_no');
            $table->dropColumn('vti_previous_passing_date');
            $table->dropColumn('vti_previous_total_marks');
            $table->dropColumn('vti_previous_marks_obtained');
            $table->dropColumn('vti_previous_percentage');
            $table->dropColumn('vti_previous_cgpa');
        });
    }
}
