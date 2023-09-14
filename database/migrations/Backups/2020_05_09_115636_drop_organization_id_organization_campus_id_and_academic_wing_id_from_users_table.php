<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropOrganizationIdOrganizationCampusIdAndAcademicWingIdFromUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['organization_id']);
            $table->dropForeign(['organization_campus_id']);
            $table->dropForeign(['academic_wing_id']);
            
            $table->dropColumn(['organization_id', 'organization_campus_id', 'academic_wing_id', 'emp_code'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');

            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('cascade');

            $table->unsignedBigInteger('academic_wing_id')->nullable();
            $table->foreign('academic_wing_id')->references('id')->on('wings')->onDelete('cascade');  
            
            $table->string('emp_code')->unique()->nullable();
        });
    }
}
