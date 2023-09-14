<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFineVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_fine_vouchers', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('exam_fine_id')->nullable();
            $table->foreign('exam_fine_id')->references('id')->on('exam_fines')->onDelete('cascade');
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
        Schema::dropIfExists('exam_fine_vouchers');
    }
}
