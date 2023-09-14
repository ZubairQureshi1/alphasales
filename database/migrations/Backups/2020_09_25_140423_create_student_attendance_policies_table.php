<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentAttendancePoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_attendance_policies', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
            $table->string('absent_fine')->nullable();
            $table->string('absent_initial_fine')->nullable();
            $table->string('absent_maximum_fine')->nullable();
            $table->string('late_fine')->nullable();
            $table->string('late_initial_fine')->nullable();
            $table->string('late_maximum_fine')->nullable();
            $table->string('leave_quota')->nullable();
            $table->string('apply_absent')->nullable();
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
        Schema::dropIfExists('student_attendance_policies');
    }
}
