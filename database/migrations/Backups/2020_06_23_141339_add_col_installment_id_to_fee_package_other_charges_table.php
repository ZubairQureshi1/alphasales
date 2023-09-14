<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColInstallmentIdToFeePackageOtherChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_package_other_charges', function (Blueprint $table) {
            $table->softDeletes();

            $table->unsignedInteger('fee_package_installment_id')->nullable();
            $table->foreign('fee_package_installment_id')->references('id')->on('fee_package_installments')->onDelete('SET NULL');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_package_other_charges', function (Blueprint $table) {
            $table->dropForeign(['fee_package_installment_id']);
            $table->dropColumn(['fee_package_installment_id', 'deleted_at']);
        });
    }
}
