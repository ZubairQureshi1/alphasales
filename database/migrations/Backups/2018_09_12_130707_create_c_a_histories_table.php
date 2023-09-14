<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCAHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('c_a_histories', function (Blueprint $table) {
            $table->increments('id');
            $table->string('ca_subject')->nullable();
            $table->string('status')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('raet_institution')->nullable();
            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('cascade');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::table('c_a_histories', function (Blueprint $table) {
            $table->dropForeign(['admission_id'], ['student_id']);
        });
        Schema::dropIfExists('c_a_histories');
    }
}
