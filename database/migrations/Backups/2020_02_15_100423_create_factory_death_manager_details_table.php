<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFactoryDeathManagerDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('factory_death_manager_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->date('death_date_of_worker')->nullable();
            $table->string('death_grant_claimed')->nullable();
            $table->date('retirement_date_of_worker')->nullable();
            $table->string('factory_manager_name')->nullable();
            $table->string('factory_manager_designation')->nullable();
            $table->string('factory_manager_contact_no')->nullable();
            $table->string('factory_manager_email')->nullable();
            $table->string('form_attested_by_manager_sign')->nullable();
            $table->string('form_attested_by_manager_stamp')->nullable();
            $table->string('form_attested_by_dol_sign')->nullable();
            $table->string('form_attested_by_dol_stamp')->nullable();
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
        Schema::table('factory_death_manager_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('factory_death_manager_details');
    }
}
