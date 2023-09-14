<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignkeyHeadfinestudentToFeevouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_vouchers', function (Blueprint $table) {
            $table->unsignedInteger('head_fine_student_id')->nullable();
            $table->foreign('head_fine_student_id')->references('id')->on('head_fine_students')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_vouchers', function (Blueprint $table) {
            $table->dropForeign(['head_fine_student_id']);
            $table->dropColumn('head_fine_student_id');
        });
    }
}
