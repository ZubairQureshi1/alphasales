<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOrganizationalStructureColsToSessionAndDegreeRelatedTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');
        });
        Schema::table('session_courses', function (Blueprint $table) {

            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('cascade');

            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
        });

        Schema::table('session_course_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('cascade');

            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
        });

        Schema::table('subjects', function (Blueprint $table) {

            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
        });

        Schema::table('course_subjects', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
        });

        Schema::table('course_affiliated_bodies', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('cascade');

            $table->unsignedBigInteger('wing_id')->nullable();
            $table->foreign('wing_id')->references('id')->on('wings')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sessions', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropColumn(['organization_id']);
        });

        Schema::table('session_courses', function (Blueprint $table) {
            $table->dropForeign(['organization_campus_id']);
            $table->dropForeign(['wing_id']);
            $table->dropColumn(['organization_campus_id', 'wing_id']);
        });

        Schema::table('session_course_subjects', function (Blueprint $table) {
            $table->dropForeign(['organization_campus_id']);
            $table->dropForeign(['wing_id']);
            $table->dropColumn(['organization_campus_id', 'wing_id']);
        });

        Schema::table('courses', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['wing_id']);
            $table->dropColumn(['organization_id', 'wing_id']);
        });

        Schema::table('subjects', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['wing_id']);
            $table->dropColumn(['organization_id', 'wing_id']);
        });

        Schema::table('course_subjects', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['wing_id']);
            $table->dropColumn(['organization_id', 'wing_id']);
        });

        Schema::table('course_affiliated_bodies', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['wing_id']);
            $table->dropColumn(['organization_id', 'wing_id']);
        });
    }
}
