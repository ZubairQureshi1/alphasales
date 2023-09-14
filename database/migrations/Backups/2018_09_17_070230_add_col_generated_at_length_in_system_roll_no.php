<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColGeneratedAtLengthInSystemRollNo extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('system_roll_numbers', function (Blueprint $table) {
            $table->integer('generated_at_length')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('system_roll_numbers', function (Blueprint $table) {
            $table->dropColumn('generated_at_length');
        });
    }
}
