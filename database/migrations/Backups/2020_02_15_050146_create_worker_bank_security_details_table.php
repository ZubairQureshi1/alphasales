<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWorkerBankSecurityDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('worker_bank_security_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('social_security')->nullable();
            $table->string('social_security_attested')->nullable();
            $table->string('social_security_office_name')->nullable();
            $table->string('eobi_number')->nullable();
            $table->string('eobi_card_attested')->nullable();
            $table->string('name_of_bank')->nullable();
            $table->string('bank_branch_address')->nullable();
            $table->string('bank_branch_code')->nullable();
            $table->string('bank_iban')->nullable();
            $table->string('permanent_address')->nullable();
            $table->string('temporary_address')->nullable();
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
        Schema::table('worker_bank_security_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('worker_bank_security_details');
    }
}
