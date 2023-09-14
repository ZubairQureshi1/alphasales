<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSectionRelatedColsInSectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sections', function (Blueprint $table) {
            $table->integer('status_id')->nullable();
        });

        Schema::table('section_details', function (Blueprint $table) {
            $table->integer('section_strength')->after('section_code')->nullable();
        });

        Schema::table('section_subject_details', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['section_name', 'section_code', 'status_id', 'strength', 'shift_id', 'user_id']); 
        });

        Schema::table('section_teachers', function (Blueprint $table) {
            $table->unsignedBigInteger('section_detail_id');
            $table->foreign('section_detail_id')
                  ->references('id')
                  ->on('section_details')
                  ->onDelete('CASCADE');

            $table->unsignedBigInteger('section_subject_detail_id');
            $table->foreign('section_subject_detail_id')
                  ->references('id')
                  ->on('section_subject_details')
                  ->onDelete('CASCADE');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sections', function (Blueprint $table) {
            //
        });
    }
}
