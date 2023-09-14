<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignExamVoucherIdToExamFine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exam_fines', function (Blueprint $table) {

            $table->unsignedInteger('exam_fine_voucher_id')->nullable();
            $table->foreign('exam_fine_voucher_id')->references('id')->on('exam_fine_vouchers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exam_fines', function (Blueprint $table) {
            $table->dropForeign(['exam_fine_voucher_id']);
            $table->dropColumn(['exam_fine_voucher_id']);
        });
    }
}
