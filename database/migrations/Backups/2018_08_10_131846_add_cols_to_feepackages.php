<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToFeepackages extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_packages', function (Blueprint $table) {
            $table->string('admission_fee')->nullable();
            $table->string('tution_fee')->nullable();
            $table->string('total_tution_fee')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_packages', function (Blueprint $table) {
            $table->dropColumn('admission_fee');
            $table->dropColumn('tution_fee');
            $table->dropColumn('total_tution_fee');

        });
    }
}
