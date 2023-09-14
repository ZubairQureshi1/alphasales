<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColEmpCodeAndIsPrimaryEmpCodeToUserCampusDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_campus_details', function (Blueprint $table) {
            $table->string('emp_code')->unique()->nullable();
            $table->boolean('is_primary_emp_code')->default(false);
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
            $table->dropColumn(['emp_code']);
            $table->dropColumn(['is_primary_emp_code']);
        });
    }
}
