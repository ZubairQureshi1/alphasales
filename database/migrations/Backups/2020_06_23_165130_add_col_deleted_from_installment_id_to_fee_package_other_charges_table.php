<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColDeletedFromInstallmentIdToFeePackageOtherChargesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_package_other_charges', function (Blueprint $table) {
            $table->unsignedInteger('deleted_from_installment_id')->nullable();
            $table->foreign('deleted_from_installment_id')->references('id')->on('fee_package_installments')->onDelete('SET NULL');
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
            $table->dropForeign(['deleted_from_installment_id']);
            $table->dropColumn('deleted_from_installment_id');
        });
    }
}
