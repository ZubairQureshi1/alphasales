<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DateSheetRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_sheet_rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('room_id')->nullable();
            $table->foreign('room_id')->references('id')->on('rooms')->onDelete('cascade');
            $table->unsignedInteger('date_sheet_id')->nullable();
            $table->foreign('date_sheet_id')->references('id')->on('date_sheets')->onDelete('cascade');
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
        Schema::dropIfExists('date_sheet_rooms');
    }
}
