<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateColAffiliationIdAndAffiliationNameToAffiliatedBodyIdInStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn('affiliation_id');
            $table->dropColumn('affiliation_name');
            $table->unsignedInteger('affiliated_body_id')->nullable();
            $table->foreign('affiliated_body_id')->references('id')->on('affiliated_bodies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->string('affiliation_name')->nullable();
            $table->integer('affiliation_id')->nullable();
            $table->dropForeign(['affiliated_body_id']);
            $table->dropColumn('affiliated_body_id');
        });
    }
}
