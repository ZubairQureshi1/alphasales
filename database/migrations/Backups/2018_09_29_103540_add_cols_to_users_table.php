<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('gender_id')->nullable();
            $table->integer('religion_id')->nullable();
            $table->integer('martial_status_id')->nullable();
            $table->integer('blood_group_id')->nullable();
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
            $table->dropColumn(['gender_id']);
            $table->dropColumn(['religion_id']);
            $table->dropColumn(['martial_status_id']);
            $table->dropColumn(['blood_group_id']);
        });
    }
}
