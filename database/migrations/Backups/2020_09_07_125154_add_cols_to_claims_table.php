<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->string('claim_head_default')->nullable();
            $table->float('claim_amount_due_default')->nullable();
            $table->float('total_amount_due_default')->nullable();
            $table->float('amount_received_last')->nullable();
            $table->float('total_amount_cheque')->nullable();
            $table->date('cheque_date')->nullable();
            $table->string('cheque_no')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('reason_remarks')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('claims', function (Blueprint $table) {
            $table->dropColumn(['claim_head_default', 'claim_amount_due_default', 'total_amount_due_default', 'amount_received_last', 'total_amount_cheque', 'cheque_date', 'cheque_no', 'bank_name', 'reason_remarks']);
        });
    }
}
