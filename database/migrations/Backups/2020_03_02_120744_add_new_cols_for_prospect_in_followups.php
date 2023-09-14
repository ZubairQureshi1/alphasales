<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColsForProspectInFollowups extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->string('prospect_father_name')->nullable();
            $table->string('prospect_shift_id')->nullable();
            $table->string('prospect_is_transport')->nullable();
            $table->string('prospect_contact_number')->nullable();
            $table->string('prospect_transport_stop')->nullable();
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
            $table->dropColumn('prospect_father_name');
            $table->dropColumn('prospect_shift_id');
            $table->dropColumn('prospect_is_transport');
            $table->dropColumn('prospect_contact_number');
            $table->dropColumn('prospect_transport_stop');
        });
    }
}
