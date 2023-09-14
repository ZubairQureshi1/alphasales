<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropWorkerColsFromEnquiry extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn(['is_eobi', 'is_ssc', 'is_frc', 'experience', 'designation']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->boolean('is_eobi')->nullable();
            $table->string('experience')->nullable();
            $table->string('designation')->nullable();
            $table->boolean('is_ssc')->nullable();
            $table->boolean('is_frc')->nullable();
        });
    }
}
