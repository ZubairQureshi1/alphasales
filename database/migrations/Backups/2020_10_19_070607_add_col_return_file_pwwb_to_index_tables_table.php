<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColReturnFilePwwbToIndexTablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('index_tables', function (Blueprint $table) {
            //
            $table->BigInteger('return_file_pwwb')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('index_tables', function (Blueprint $table) {
            //
            $table->dropColumn('return_file_pwwb');
        });
    }
}
