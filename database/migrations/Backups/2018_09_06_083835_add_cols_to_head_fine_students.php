<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColsToHeadFineStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->string('discount_in_amount')->nullable();
            $table->string('discount_in_percentage')->nullable();
            $table->string('amount_after_discount')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->dropColumn('discount_in_amount');
            $table->dropColumn('discount_in_percentage');
            $table->dropColumn('amount_after_discount');
        });
    }
}
