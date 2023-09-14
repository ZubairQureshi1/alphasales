<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCollsWorkerFamilyMemberDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('worker_family_member_details', function (Blueprint $table) {
            $table->unsignedInteger('family_id')->nullable();
            $table->string('callby')->nullable();
            $table->string('callstatus')->nullable();
            $table->string('status')->nullable();
            $table->string('answeredby')->nullable();
            $table->string('attendantrelationship')->nullable();
            $table->string('followupranking')->nullable();
            $table->string('nextfollowupdate')->nullable();
            $table->string('remarks')->nullable();
            $table->string('organization_campus_id')->nullable();
            $table->string('session_id')->nullable();
            $table->string('change')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('worker_family_member_details', function (Blueprint $table) {
            $table->dropColumn('family_id');
            $table->dropColumn('callby');
            $table->dropColumn('callstatus');
            $table->dropColumn('status');
            $table->dropColumn('answeredby');
            $table->dropColumn('attendantrelationship');
            $table->dropColumn('followupranking');
            $table->dropColumn('nextfollowupdate');
            $table->dropColumn('remarks');
            $table->dropColumn('organization_campus_id');
            $table->dropColumn('session_id');
            $table->dropColumn('change');
        });
    }
}
