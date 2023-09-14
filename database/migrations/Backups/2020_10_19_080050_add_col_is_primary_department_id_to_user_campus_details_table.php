<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColIsPrimaryDepartmentIdToUserCampusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_campus_details', function (Blueprint $table) {
            $table->unsignedInteger('is_primary_department_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_campus_details', function (Blueprint $table) {
            $table->dropColumn(['is_primary_department_id']);
        });
    }
}
