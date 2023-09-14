<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_books', function (Blueprint $table) {
            $table->increments('id');
            $table->string('subject_name')->nullable();
            $table->unsignedInteger('student_academic_history_id')->nullable();
            $table->foreign('student_academic_history_id')->references('id')->on('student_academic_histories')->onDelete('set null');
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
        Schema::table('student_books', function (Blueprint $table) {
            $table->dropForeign(['student_academic_history_id']);
        });
        Schema::dropIfExists('student_books');
    }
}
