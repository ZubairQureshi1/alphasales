<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeePackageInstallmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_package_installments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('net_total')->nullable();
            $table->string('course_duration')->nullable();
            $table->string('no_of_semesters')->nullable();
            $table->string('duration_per_semester')->nullable();
            $table->string('installment_interval')->nullable();
            $table->string('no_of_installments')->nullable();
            $table->string('amount_per_installment')->nullable();
            $table->string('due_date')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('paid_date')->nullable();
            $table->string('status_id')->nullable();
            $table->string('status_name')->nullable();
            $table->unsignedInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('fee_packages');
            $table->string('extension_date')->nullable();
            $table->string('remarks')->nullable();
            $table->string('voucher_code')->nullable();
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
        Schema::dropIfExists('fee_package_installments');
    }
}
