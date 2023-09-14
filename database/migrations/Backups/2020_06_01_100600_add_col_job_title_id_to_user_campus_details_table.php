<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColJobTitleIdToUserCampusDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('user_campus_details', function (Blueprint $table) {
            $table->unsignedInteger('job_title_id')
                  ->nullable()
                  ->after('designation_id');

            $table->foreign('job_title_id')
                  ->references('id')
                  ->on('job_titles')
                  ->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('user_campus_details', function (Blueprint $table) {
            $table->dropForeign(['job_title_id']);
            $table->dropColumn('job_title_id');
        });
    }
}
