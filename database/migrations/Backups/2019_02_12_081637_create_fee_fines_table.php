<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeeFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fee_fines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('balance')->nullable();
            $table->string('voucher_number')->nullable();

            $table->unsignedInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('fee_packages')->onDelete('cascade');

            $table->unsignedInteger('installment_id')->nullable();
            $table->foreign('installment_id')->references('id')->on('fee_package_installments')->onDelete('cascade');
            $table->string('amount_waived')->nullable();
            $table->string('amount_after_waived')->nullable();
            $table->string('previous_reference')->nullable();
            $table->string('next_reference')->nullable();

            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();

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
        Schema::table('fee_fines', function (Blueprint $table) {
            $table->dropForeign(['package_id']);
            $table->dropForeign(['installment_id']);
        });
        Schema::dropIfExists('fee_fines');
    }
}
