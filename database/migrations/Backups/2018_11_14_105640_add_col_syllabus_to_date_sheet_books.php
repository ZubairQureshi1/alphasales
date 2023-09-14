<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColSyllabusToDateSheetBooks extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('date_sheet_books', function (Blueprint $table) {
            $table->longText('syllabus')->nullable();
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
            $table->dropColumn('syllabus');
        });
    }
}
