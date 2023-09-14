<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDualCourseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dual_course_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('educational_wing_cfe')->nullable();
            $table->string('course')->nullable();
            $table->string('roll_no')->nullable();
            $table->string('affiliated_body')->nullable();
            $table->string('duration_of_course')->nullable();
            $table->date('admission_date')->nullable();
            $table->date('ending_date')->nullable();
            $table->string('scheme_of_study')->nullable();
            $table->string('semester_category')->nullable();
            $table->string('shift')->nullable();
            $table->string('registration_status')->nullable();
            $table->string('registration_date')->nullable();
            $table->string('late_fee')->nullable();
            $table->string('total_fee')->nullable();
            $table->string('actual_fee')->nullable();
            $table->string('previous_course')->nullable();
            $table->string('previous_affiliated_body')->nullable();
            $table->string('previous_duration_of_course')->nullable();
            $table->string('previous_roll_no')->nullable();
            $table->date('previous_passing_date')->nullable();
            $table->string('previous_total_marks')->nullable();
            $table->string('previous_marks_obtained')->nullable();
            $table->string('previous_cgpa')->nullable();

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
        Schema::table('dual_course_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('dual_course_details');
    }
}
