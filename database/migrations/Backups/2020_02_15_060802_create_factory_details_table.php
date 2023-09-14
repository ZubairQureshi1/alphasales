<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('factory_name')->nullable();
            $table->string('factory_address')->nullable();
            $table->string('factory_registration_number')->nullable();
            $table->date('factory_registration_date')->nullable();
            $table->string('factory_registration_certificate_attested_by_manager')->nullable();
            $table->string('factory_registration_certificate_attested_by_officer')->nullable();
            $table->string('factory_registration_certificate_attested_by_director')->nullable();
            $table->string('signature_of_worker')->nullable();
            $table->date('date_of_submission')->nullable();
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
        Schema::table('factory_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('factory_details');
    }
}
