<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceFineVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_fine_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('attendance_fine_id')->nullable();
            $table->foreign('attendance_fine_id')->references('id')->on('attendance_fines')->onDelete('cascade');
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
        Schema::table('attendance_fine_vouchers', function (Blueprint $table) {
            $table->dropForeign(['attendance_fine_id']);
        });
        Schema::dropIfExists('attendance_fine_vouchers');
    }
}
