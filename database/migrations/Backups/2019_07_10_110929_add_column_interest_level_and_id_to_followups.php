<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnInterestLevelAndIdToFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->string('interest_level')->nullable();
            $table->integer('interest_level_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->dropColumn('interest_level');
            $table->dropColumn('interest_level_id');
        });
    }
}
