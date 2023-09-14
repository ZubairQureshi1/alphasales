<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSessionCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('session_course_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quota')->nullable();
            $table->integer('degree_type_id')->nullable();
            $table->unsignedInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sessions')->onDelete('cascade');
            $table->unsignedInteger('affiliated_body_id')->nullable();
            $table->foreign('affiliated_body_id')->references('id')->on('affiliated_bodies')->onDelete('cascade');
            $table->unsignedInteger('installment_plan_id')->nullable();
            $table->foreign('installment_plan_id')->references('id')->on('installment_plans')->onDelete('cascade');
            $table->unsignedInteger('session_course_id')->nullable();
            $table->foreign('session_course_id')->references('id')->on('session_courses')->onDelete('cascade');
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
        Schema::dropIfExists('session_course_details');
        Schema::enableForeignKeyConstraints();
    }
}
