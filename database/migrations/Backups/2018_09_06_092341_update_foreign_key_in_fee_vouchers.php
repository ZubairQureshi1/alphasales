<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyInFeeVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_vouchers', function (Blueprint $table) {
            $table->dropForeign('fee_vouchers_head_fine_student_id_foreign');
            $table->foreign('head_fine_student_id')
                ->references('id')->on('head_fine_students')
                ->onDelete('cascade')
                ->change();
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
            // there is no need
        });
    }
}
