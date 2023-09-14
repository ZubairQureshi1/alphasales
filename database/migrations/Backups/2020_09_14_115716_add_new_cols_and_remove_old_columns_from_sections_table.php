<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNewColsAndRemoveOldColumnsFromSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->dropColumn(['name', 'code', 'strength', 'active', 'campus_id', 'wing_id']);
            $table->integer('annual_semester')->nullable();
            $table->integer('gender_id')->nullable();
            $table->integer('shift_id')->nullable();
            $table->unsignedInteger('affiliated_body_id')->nullable();
            $table->foreign('affiliated_body_id')->references('id')->on('affiliated_bodies')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            // $table->dropForeign(['annual_semester','gender_id', 'shift_id', 'affiliated_body_id']);
            // $table->dropForeign(['affiliated_body_id']);

            // $table->string('name')->nullable();
            // $table->string('code')->nullable();
            // $table->integer('strength')->nullable();
            // $table->boolean('active')->nullable();
            // $table->unsignedInteger('subject_id')->nullable();
            // $table->foreign('subject_id')->references('id')->on('session_course_subjects');
        });
    }
}
