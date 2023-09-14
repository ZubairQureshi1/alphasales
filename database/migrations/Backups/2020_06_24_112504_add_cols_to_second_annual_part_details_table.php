<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToSecondAnnualPartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('second_annual_part_details', function (Blueprint $table) {
            $table->string('readmissionparttwo')->nullable();
            $table->string('same_course')->nullable();
            $table->string('changed_course')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('second_annual_part_details', function (Blueprint $table) {
            $table->dropColumn('readmissionparttwo');
            $table->dropColumn('same_course');
            $table->dropColumn('changed_course');
        });
    }
}
