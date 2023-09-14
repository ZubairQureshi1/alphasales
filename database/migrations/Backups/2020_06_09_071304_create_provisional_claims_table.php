<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvisionalClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provisional_claims', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('serial_no')->nullable();
            $table->string('claim_due')->nullable();
            $table->string('type_of_claim')->nullable();
            $table->string('type_of_claim_other')->nullable();
            $table->string('claim_status')->nullable();
            $table->string('claim_received')->nullable();
            $table->date('claim_date')->nullable();
            $table->string('reason')->nullable();
            $table->string('cfe_fee')->nullable();
            $table->string('recovery_from_student')->nullable();

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
        Schema::table('provisional_claims', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('provisional_claims');
       }
}
