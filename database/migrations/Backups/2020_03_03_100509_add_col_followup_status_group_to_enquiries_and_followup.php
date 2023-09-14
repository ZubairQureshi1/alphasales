<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFollowupStatusGroupToEnquiriesAndFollowup extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->string('followup_status_group_name')->nullable();
        });
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->string('followup_status_group_name')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn('followup_status_group_name');
        });
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->dropColumn('followup_status_group_name');
        });
    }
}
