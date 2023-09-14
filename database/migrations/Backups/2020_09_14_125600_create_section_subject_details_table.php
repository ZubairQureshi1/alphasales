<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSectionSubjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('section_subject_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('section_name')->nullable();
            $table->string('section_code')->nullable();
            $table->integer('status_id')->nullable();
            $table->integer('strength')->nullable();
            $table->integer('shift_id')->nullable();

            $table->unsignedInteger('course_id')->nullable();
            $table->foreign('course_id')
                  ->references('id')
                  ->on('courses');

            $table->unsignedInteger('subject_id')->nullable();
            $table->foreign('subject_id')
                  ->references('id')
                  ->on('subjects');

            $table->unsignedInteger('section_id')->nullable();
            $table->foreign('section_id')->references('id')->on('sections')->onDelete('cascade');          

            $table->unsignedInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null'); 

            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');

            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('set null');

            $table->unsignedBigInteger('academic_wing_id')->nullable();
            $table->foreign('academic_wing_id')->references('id')->on('wings')->onDelete('set null');

            $table->unsignedInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sections')->onDelete('set null');  
            
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
        Schema::dropIfExists('section_subject_details');
    }
}
