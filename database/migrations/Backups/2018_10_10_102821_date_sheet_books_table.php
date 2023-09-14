<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DateSheetBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('date_sheet_books', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('subject_id')->nullable();
            $table->foreign('subject_id')->references('id')->on('subjects')->onDelete('cascade');
            $table->date('date')->nullable();
            $table->dateTime('start_time')->nullable(); 
            $table->dateTime('end_time')->nullable();
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
        Schema::dropIfExists('date_sheet_books');
    }
}
