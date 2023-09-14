<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCarryforwardedToFeepackageinstall extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('fee_package_installments', function (Blueprint $table) {
            $table->string('carry_forward')->nullable();
            $table->string('is_carry_forward')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_package_installments', function (Blueprint $table) {
            $table->dropColumn('carry_forward')->nullable();
            $table->dropColumn('is_carry_forward')->nullable();

        });
    }
}
