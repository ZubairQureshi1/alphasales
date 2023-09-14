<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToSixthSemesterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sixth_semester_details', function (Blueprint $table) {
            $table->string('readmissionsix')->nullable();
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
        Schema::table('sixth_semester_details', function (Blueprint $table) {
            $table->dropColumn('readmissionsix');
            $table->dropColumn('same_course');
            $table->dropColumn('changed_course');
        });
    }
}
