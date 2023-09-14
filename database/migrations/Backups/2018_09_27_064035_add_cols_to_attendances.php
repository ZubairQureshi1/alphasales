<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToAttendances extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->boolean('is_late_checkin')->default('0');
            $table->boolean('is_late_checkout')->default('0');
            $table->boolean('is_on_time_checkin')->default('0');
            $table->boolean('is_on_time_checkout')->default('0');
            $table->boolean('is_early_checkin')->default('0');
            $table->boolean('is_early_checkout')->default('0');
            $table->boolean('is_on_leave')->default('0');
            $table->boolean('is_day_off')->default('0');
            $table->boolean('is_on_travel')->default('0');
            $table->boolean('is_holiday')->default('0');
            $table->string('working_hours')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendances', function (Blueprint $table) {
            $table->dropColumn('is_late_checkin');
            $table->dropColumn('is_late_checkout');
            $table->dropColumn('is_on_time_checkin');
            $table->dropColumn('is_on_time_checkout');
            $table->dropColumn('is_early_checkin');
            $table->dropColumn('is_early_checkout');
            $table->dropColumn('is_on_leave');
            $table->dropColumn('is_day_off');
            $table->dropColumn('is_on_travel');
            $table->dropColumn('is_holiday');
            $table->dropColumn('working_hours');
        });
    }
}
