<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToWorkerFollowupsCallsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('worker_followups_calls', function (Blueprint $table) {
            //
            $table->string('session_id')->nullable();
            $table->string('organization_campus_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('worker_followups_calls', function (Blueprint $table) {
            //
            $table->dropColumn('session_id');
            $table->dropColumn('organization_campus_id');

        });
    }
}
