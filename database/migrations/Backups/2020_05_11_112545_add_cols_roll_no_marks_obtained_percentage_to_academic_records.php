<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsRollNoMarksObtainedPercentageToAcademicRecords extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('academic_records', function (Blueprint $table) {
            $table->string('total_marks')->nullable();
            $table->string("percentage")->nullable();
            $table->string("roll_no")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('academic_records', function (Blueprint $table) {
            $table->dropColumn('total_marks');
            $table->dropColumn('percentage');
            $table->dropColumn('roll_no');
        });
    }
}
