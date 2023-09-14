<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsForProspectFollowupIntoFollowupsTaboe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiry_followups', function (Blueprint $table) {
            $table->integer('followup_type_id')->nullable();
            $table->string('prospect_name')->nullable();
            $table->string('prospect_relationship')->nullable();
            $table->string('prospect_course')->nullable();
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
            $table->dropColumn('followup_type_id');
            $table->dropColumn('prospect_name');
            $table->dropColumn('prospect_relationship');
            $table->dropColumn('prospect_course');
        });
    }
}
