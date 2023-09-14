<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('voucher_code')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('fee_packages');
            $table->unsignedInteger('installment_id')->nullable();
            $table->foreign('installment_id')->references('id')->on('fee_package_installments');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('fee_vouchers');
        Schema::enableForeignKeyConstraints();
    }
}
