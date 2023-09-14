<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSectionDetailIdToSectionSubjectDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('section_subject_details', function (Blueprint $table) {
            $table->unsignedBigInteger('section_detail_id')->nullable();
            $table->foreign('section_detail_id')->references('id')->on('section_details')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('section_subject_details', function (Blueprint $table) {
            $table->dropColumn('section_detail_id');
            $table->dropForeign(['section_detail_id']);
        });
    }
}
