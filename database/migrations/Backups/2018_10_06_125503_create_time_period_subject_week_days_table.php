<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTimePeriodSubjectWeekDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('time_period_subject_week_days', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('time_period_id')->nullable();
            $table->foreign('time_period_id')->references('id')->on('time_periods')->onDelete('cascade');
            $table->unsignedInteger('week_day_id')->nullable();
            $table->string('week_day_name')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('time_period_subject_week_days');
    }
}
