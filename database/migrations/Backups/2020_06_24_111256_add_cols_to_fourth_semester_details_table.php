<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToFourthSemesterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fourth_semester_details', function (Blueprint $table) {
            $table->string('readmissionfourth')->nullable();
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
        Schema::table('fourth_semester_details', function (Blueprint $table) {
            $table->dropColumn('readmissionfourth');
            $table->dropColumn('same_course');
            $table->dropColumn('changed_course');
        });
    }
}
