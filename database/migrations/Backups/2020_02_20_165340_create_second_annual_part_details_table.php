<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSecondAnnualPartDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('second_annual_part_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('result')->nullable();
            $table->string('receipt_status')->nullable();
            $table->date('second_part_date')->nullable();
            $table->string('pwwb_status')->nullable();
            $table->date('pwwb_date')->nullable();
            $table->string('diary_pwwb')->nullable();
            $table->string('amount_claim_due')->nullable();
            $table->string('claim_status')->nullable();
            $table->string('amount_received')->nullable();
            $table->date('claim_date')->nullable();
            $table->string('exam_status')->nullable();
            $table->date('exam_date')->nullable();
            $table->string('exam_amount')->nullable();
            $table->string('roll_no')->nullable();
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
        Schema::table('second_annual_part_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('second_annual_part_details');
    }
}
