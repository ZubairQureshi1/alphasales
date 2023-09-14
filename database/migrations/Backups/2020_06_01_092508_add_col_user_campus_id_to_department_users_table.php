<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColUserCampusIdToDepartmentUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('department_users', function (Blueprint $table) {
           
            $table->unsignedBigInteger('user_campus_detail_id')
                  ->nullable()
                  ->after('user_id');

            $table->foreign('user_campus_detail_id')
                  ->references('id')
                  ->on('user_campus_details')
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
        Schema::table('department_users', function (Blueprint $table) {
            $table->dropForeign(['user_campus_detail_id']);
            
            $table->dropColumn('user_campus_detail_id');
        });
    }
}
