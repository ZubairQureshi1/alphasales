<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToBiseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bise_details', function (Blueprint $table) {
            $table->string('bise_board_university')->nullable();
            $table->string('bise_previous_course')->nullable();
            $table->string('bise_previous_roll_no')->nullable();
            $table->date('bise_previous_passing_date')->nullable();
            $table->string('bise_previous_total_marks')->nullable();
            $table->string('bise_previous_marks_obtained')->nullable();
            $table->string('bise_previous_percentage')->nullable();
            $table->string('bise_previous_cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bise_details', function (Blueprint $table) {
            $table->dropColumn('bise_board_university');
            $table->dropColumn('bise_previous_course');
            $table->dropColumn('bise_previous_roll_no');
            $table->dropColumn('bise_previous_passing_date');
            $table->dropColumn('bise_previous_total_marks');
            $table->dropColumn('bise_previous_marks_obtained');
            $table->dropColumn('bise_previous_percentage');
            $table->dropColumn('bise_previous_cgpa');
        });
    }
}
