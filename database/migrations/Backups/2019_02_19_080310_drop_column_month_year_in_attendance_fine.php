<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropColumnMonthYearInAttendanceFine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_fines', function (Blueprint $table) {
            $table->dropColumn(['month', 'year']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_fines', function (Blueprint $table) {
            $table->string('month')->nullable();
            $table->string('year')->nullable();
        });
    }
}
