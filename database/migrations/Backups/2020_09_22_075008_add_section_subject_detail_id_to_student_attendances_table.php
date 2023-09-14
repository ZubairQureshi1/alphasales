<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSectionSubjectDetailIdToStudentAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('student_attendances', function (Blueprint $table) {
            //
            // section_subject_detail_id
            $table->unsignedBigInteger('section_subject_detail_id')->nullable();
            // $table->foreign('section_subject_detail_id')->references('id')->on('student_attendances')->onDelete('set null');
            $table->foreign('section_subject_detail_id')->references('id')->on('section_subject_details')->onDelete('cascade');
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
            //
            $table->dropColumn('section_subject_detail_id');
            $table->dropForeign(['section_subject_detail_id']);
        });
    }
}
