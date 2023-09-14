<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColsToIndexTablesTable extends Migration
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
            $table->string('file_module_number')->nullable();
            $table->string('admission_set_submitted')->nullable();
            $table->string('file_submitted_to_pwwb')->nullable();
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
            $table->dropColumn('file_module_number');
            $table->dropColumn('admission_set_submitted');
            $table->dropColumn('file_submitted_to_pwwb');
        });
    }
}
