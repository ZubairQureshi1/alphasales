<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForiegnkeyToFeefine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_fines', function (Blueprint $table) {

            $table->unsignedInteger('fee_voucher_id')->nullable();
            $table->foreign('fee_voucher_id')->references('id')->on('fee_fine_vouchers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_fines', function (Blueprint $table) {
            $table->dropForeign(['fee_voucher_id']);
            $table->dropColumn('fee_voucher_id');
        });
    }
}
