<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeFineVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_fine_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('fee_fine_id')->nullable();
            $table->foreign('fee_fine_id')->references('id')->on('fee_fines')->onDelete('cascade');
            $table->string('voucher_code')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_fine_vouchers', function (Blueprint $table) {
            $table->dropForeign(['fee_fine_id']);
            $table->dropColumn('fee_fine_id');
        });
        Schema::dropIfExists('fee_fine_vouchers');
    }
}
