<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColBranchWingIdToAllTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tables = \DB::connection()->getDoctrineSchemaManager()->listTableNames();
        Schema::table('all_tables', function (Blueprint $table) {
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        $tables = \DB::connection()->getDoctrineSchemaManager()->listTableNames();
        Schema::table('all_tables', function (Blueprint $table) {
        });
    }
}
