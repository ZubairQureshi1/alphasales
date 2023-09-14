<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToAfDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('af_details', function (Blueprint $table) {
            $table->string('af_board_university')->nullable();
            $table->string('af_previous_course')->nullable();
            $table->string('af_previous_roll_no')->nullable();
            $table->date('af_previous_passing_date')->nullable();
            $table->string('af_previous_total_marks')->nullable();
            $table->string('af_previous_marks_obtained')->nullable();
            $table->string('af_previous_percentage')->nullable();
            $table->string('af_previous_cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('af_details', function (Blueprint $table) {
            $table->dropColumn('af_board_university');
            $table->dropColumn('af_previous_course');
            $table->dropColumn('af_previous_roll_no');
            $table->dropColumn('af_previous_passing_date');
            $table->dropColumn('af_previous_total_marks');
            $table->dropColumn('af_previous_marks_obtained');
            $table->dropColumn('af_previous_percentage');
            $table->dropColumn('af_previous_cgpa');
        });
    }
}
