<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSessionCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_courses', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('session_id');
            $table->foreign('session_id')->references('id')->on('sessions');
            $table->index(['session_id']);
            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')->references('id')->on('courses')->onDelete('set null');
            $table->index(['course_id']);
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->dropForeign(['session_id'],['course_id']);
        });
        Schema::dropIfExists('session_courses');
    }
}
