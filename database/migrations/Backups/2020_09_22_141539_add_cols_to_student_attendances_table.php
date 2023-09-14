<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_attendances', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');

            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('set null');

            $table->unsignedBigInteger('academic_wing_id')->nullable();
            $table->foreign('academic_wing_id')->references('id')->on('wings')->onDelete('set null');

            $table->unsignedInteger('session_id')->nullable();
            $table->foreign('session_id')->references('id')->on('sections')->onDelete('set null');  
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('student_attendances', function (Blueprint $table) {
            $table->dropColumn(['organization_id', 'organization_campus_id', 'academic_wing_id', 'session_id']);
            $table->dropForeign(['organization_id', 'organization_campus_id', 'academic_wing_id', 'session_id']);
        });
    }
}
