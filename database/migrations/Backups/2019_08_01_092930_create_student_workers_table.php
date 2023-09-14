<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_workers', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedInteger('student_academic_history_id')->nullable();
            $table->foreign('student_academic_history_id')->references('id')->on('student_academic_histories')->onDelete('cascade');

            $table->boolean('is_file_completed')->nullable();
            $table->boolean('file_delivered_to_board')->nullable();
            $table->boolean('payment_received')->nullable();

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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('student_workers');
        Schema::enableForeignKeyConstraints();
    }
}
