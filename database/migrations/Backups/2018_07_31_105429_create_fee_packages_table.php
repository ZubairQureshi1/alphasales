<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_packages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('total_package')->nullable();
            $table->string('discount')->nullable();
            $table->string('net_total')->nullable();
            $table->string('discount_status')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->unsignedInteger('discount_status_id')->nullable();
            $table->unsignedInteger('student_id')->nullable();
            $table->unsignedInteger('status_id')->nullable();
            $table->string('status_name')->nullable();

            $table->string('voucher_code')->nullable();
            $table->foreign('student_id')->references('id')->on('students');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fee_packages');
    }
}
