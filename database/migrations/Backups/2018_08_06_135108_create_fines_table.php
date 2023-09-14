<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fines', function (Blueprint $table) {
            $table->increments('id');

            $table->string('name')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('status_name')->nullable();
            $table->string('voucher_code')->nullable();
            $table->string('due_date')->nullable();
            $table->string('paid_date')->nullable();
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');
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
        Schema::dropIfExists('fines');
        Schema::enableForeignKeyConstraints();
    }
}
