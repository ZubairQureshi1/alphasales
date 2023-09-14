<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id')->nullable();
            $table->foreign('index_table_id')->references('id')->on('index_tables')->onDelete('cascade');
            $table->BigInteger('parent_id')->nullable();
            $table->BigInteger('page_number')->nullable();
            $table->BigInteger('serial_no')->nullable();
            $table->string('claim_head')->nullable();
            $table->string('claim_status')->nullable();
            $table->string('reason')->nullable();
            $table->float('claim_due')->nullable();
            $table->float('amount_due')->nullable();
            $table->float('amount_received')->nullable();
            $table->float('amount_balance')->nullable();
            $table->float('total_amount_due')->nullable();
            $table->float('total_amount_received')->nullable();
            $table->float('total_amount_balance')->nullable();
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
        Schema::dropIfExists('claims');
    }
}
