<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateSemesterDiscountCols extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('semesters', function (Blueprint $table) {
            $table->integer('min_discount')->nullable();
            $table->integer('max_discount')->nullable();
            $table->integer('min_installments')->nullable();
            $table->integer('max_installments')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('semesters', function (Blueprint $table) {
            $table->dropColumn('min_discount');
            $table->dropColumn('max_discount');
            $table->dropColumn('min_installments');
            $table->dropColumn('max_installments');
        });
    }
}
