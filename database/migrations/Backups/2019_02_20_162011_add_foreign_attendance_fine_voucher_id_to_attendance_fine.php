<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignAttendanceFineVoucherIdToAttendanceFine extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('attendance_fines', function (Blueprint $table) {

            $table->unsignedInteger('attendance_fine_voucher_id')->nullable();
            $table->foreign('attendance_fine_voucher_id')->references('id')->on('attendance_fine_vouchers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('attendance_fines', function (Blueprint $table) {
            $table->dropForeign(['attendance_fine_voucher_id']);
            $table->dropColumn(['attendance_fine_voucher_id']);
        });
    }
}
