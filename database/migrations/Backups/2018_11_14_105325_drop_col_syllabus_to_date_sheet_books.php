<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropColSyllabusToDateSheetBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('date_sheet_books', function (Blueprint $table) {
            $table->dropColumn('syllabus')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('date_sheet_books', function (Blueprint $table) {
            $table->string('syllabus')->nullable();
        });
    }
}
