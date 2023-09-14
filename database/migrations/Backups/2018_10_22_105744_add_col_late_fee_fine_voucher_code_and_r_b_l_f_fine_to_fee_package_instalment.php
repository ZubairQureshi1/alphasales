<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColLateFeeFineVoucherCodeAndRBLFFineToFeePackageInstalment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_package_installments', function (Blueprint $table) {
            $table->string('late_fee_fine_voucher_code')->nullable();
            $table->string('r_b_late_fee_fine_voucher_code')->nullable();
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
            $table->dropColumn('late_fee_fine_voucher_code');
            $table->dropColumn('r_b_late_fee_fine_voucher_code');
        });
    }
}
