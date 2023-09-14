<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentRegistrationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_registrations', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('cascade');

            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->unsignedInteger('academic_history_id')->nullable();
            $table->foreign('academic_history_id')->references('id')->on('student_academic_histories')->onDelete('cascade');

            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('cascade');

            $table->unsignedBigInteger('academic_wing_id')->nullable();
            $table->foreign('academic_wing_id')->references('id')->on('organization_campus_wings')->onDelete('cascade');
            
            $table->integer('registration_platform_id')->nullable();
            $table->integer('registration_type_id')->nullable();
            $table->integer('registration_status_id')->nullable();
            $table->string('registration_no')->nullable();
            $table->integer('registration_card_received_id')->nullable();

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
        Schema::dropIfExists('student_registrations');
    }
}
