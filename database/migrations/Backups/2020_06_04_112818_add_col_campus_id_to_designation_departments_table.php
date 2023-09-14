<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColCampusIdToDesignationDepartmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('designation_departments', function (Blueprint $table) {
            $table->unsignedBigInteger('organization_campus_id')
                  ->after('department_id')
                  ->nullable();
            
            $table->foreign('organization_campus_id')
                  ->references('id')
                  ->on('organization_campuses')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('designation_departments', function (Blueprint $table) {
            
            $table->dropForeign(['organization_campus_id']);
            $table->dropColumn('organization_campus_id');
        });
    }
}
