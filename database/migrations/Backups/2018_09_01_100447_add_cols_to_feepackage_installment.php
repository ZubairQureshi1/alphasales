<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToFeepackageInstallment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_package_installments', function (Blueprint $table) {
            $table->string('late_fee_fine')->nullable();
            $table->string('remaining_balance')->nullable();
            $table->string('remaining_balance_late_fine')->nullable();
            $table->string('remaining_balance_paid_date')->nullable();
            $table->string('amount_with_fine')->nullable();
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
            $table->dropColumn('late_fee_fine');
            $table->dropColumn('remaining_balance');
            $table->dropColumn('remaining_balance_late_fine');
            $table->dropColumn('remaining_balance_paid_date');
            $table->dropColumn('amount_with_fine');
        });

    }
}
