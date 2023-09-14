<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFineForiegnkeyInVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_vouchers', function (Blueprint $table) {
            $table->unsignedInteger('fine_id')->nullable();
            $table->foreign('fine_id')->references('id')->on('fines');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_vouchers', function (Blueprint $table) {
            $table->dropForeign(['fine_id']);
            $table->dropColumn(['fine_id']);
        });
    }
}
