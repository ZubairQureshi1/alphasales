<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToStudentHeadFines extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->string('late_fee_fine')->nullable();
            $table->string('remaining_balance')->nullable();
            $table->string('remaining_balance_late_fine')->nullable();
            $table->string('remaining_balance_paid_date')->nullable();
            $table->string('amount_with_fine')->nullable();
            $table->string('remaining_balance_voucher_id')->nullable();
            $table->string('total_remaining_balance')->nullable();
            $table->string('total_amount_collected')->nullable();
            $table->string('carry_forward')->nullable();
            $table->string('is_carry_forward')->nullable();
            $table->string('paid_amount')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->dropColumn('late_fee_fine');
            $table->dropColumn('remaining_balance');
            $table->dropColumn('remaining_balance_late_fine');
            $table->dropColumn('remaining_balance_paid_date');
            $table->dropColumn('amount_with_fine');
            $table->dropColumn('remaining_balance_voucher_id')->nullable();
            $table->dropColumn('total_remaining_balance')->nullable();
            $table->dropColumn('total_amount_collected')->nullable();
            $table->dropColumn('carry_forward')->nullable();
            $table->dropColumn('is_carry_forward')->nullable();
            $table->dropColumn('paid_amount')->nullable();
        });
    }
}
