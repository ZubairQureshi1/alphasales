<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColCallStatusAndIdToFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->string('call_status_name')->nullable();
            $table->integer('call_status_id')->nullable();
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
            $table->dropColumn('call_status_id');
            $table->dropColumn('call_status_name');
        });
    }
}
