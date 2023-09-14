<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColIsOrderPlacedToHeadFineStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->boolean('is_order_placed')->default(false);
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
            $table->dropColumn('is_order_placed');
        });
    }
}
