<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFeeStructureIdToFeePackage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_packages', function (Blueprint $table) {
            $table->integer('fee_structure_type_id')->nullable();
            $table->string('fee_structure_type')->nullable();
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
            $table->dropColumn('fee_structure_type_id');
            $table->dropColumn('fee_structure_type');
        });
    }
}
