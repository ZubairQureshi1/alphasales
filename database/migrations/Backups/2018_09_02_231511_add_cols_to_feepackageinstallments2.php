<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToFeepackageinstallments2 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_package_installments', function (Blueprint $table) {

            $table->string('remaining_balance_voucher_id')->nullable();
            $table->string('total_remaining_balance')->nullable();
            $table->string('total_amount_collected')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_package_installments', function (Blueprint $table) {
            $table->dropColumn('remaining_balance_voucher_id')->nullable();
            $table->dropColumn('total_remaining_balance')->nullable();
            $table->dropColumn('total_amount_collected')->nullable();

        });
    }
}
