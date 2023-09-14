<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdatePwwbFileIdConstraintInAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropForeign(['pwwb_file_id']);
            // new foreign key
            $table->foreign('pwwb_file_id')->references('id')->on('index_tables')->onDelete('SET NULL');
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
            // drop new constraint
            $table->dropForeign(['pwwb_file_id']);
            // old constraint
            $table->foreign('pwwb_file_id')->references('id')->on('index_tables')->onDelete('CASCADE');
        });
    }
}
