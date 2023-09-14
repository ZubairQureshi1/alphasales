<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreColsToEnquiriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->integer('shift_id')->nullable();
            $table->integer('is_eobi')->nullable();
            $table->integer('is_ssc')->nullable();
            $table->integer('is_frc')->nullable();
            $table->integer('source_info_id')->nullable();
            $table->integer('is_transport')->nullable();
            $table->integer('transport_route_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiries', function (Blueprint $table) {
            $table->dropColumn(['shift_id', 'is_eobi', 'is_ssc', 'is_frc', 'source_info_id', 'is_transport', 'transport_route_id']);
        });
    }
}
