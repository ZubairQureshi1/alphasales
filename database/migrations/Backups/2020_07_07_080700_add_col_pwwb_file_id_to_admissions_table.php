<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColPwwbFileIdToAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->unsignedBigInteger('pwwb_file_id')
                  ->nullable()
                  ->after('enquiry_id');

            $table->foreign('pwwb_file_id')
                  ->references('id')
                  ->on('index_tables')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['pwwb_file_id']);
            $table->dropColumn('pwwb_file_id');
        });
    }
}
