<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToImsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ims_details', function (Blueprint $table) {
            $table->string('ims_board_university')->nullable();
            $table->string('ims_previous_course')->nullable();
            $table->string('ims_previous_roll_no')->nullable();
            $table->date('ims_previous_passing_date')->nullable();
            $table->string('ims_previous_total_marks')->nullable();
            $table->string('ims_previous_marks_obtained')->nullable();
            $table->string('ims_previous_percentage')->nullable();
            $table->string('ims_previous_cgpa')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ims_details', function (Blueprint $table) {
            $table->dropColumn('ims_board_university');
            $table->dropColumn('ims_previous_course');
            $table->dropColumn('ims_previous_roll_no');
            $table->dropColumn('ims_previous_passing_date');
            $table->dropColumn('ims_previous_total_marks');
            $table->dropColumn('ims_previous_marks_obtained');
            $table->dropColumn('ims_previous_percentage');
            $table->dropColumn('ims_previous_cgpa');
        });
    }
}
