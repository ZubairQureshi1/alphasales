<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToStudentBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_books', function (Blueprint $table) {
            //
            $table->BigInteger('section_id')->nullable();
            $table->string('section_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_books', function (Blueprint $table) {
            //
            $table->dropColumn('section_id');
            $table->dropColumn('section_name');
        });
    }
}
