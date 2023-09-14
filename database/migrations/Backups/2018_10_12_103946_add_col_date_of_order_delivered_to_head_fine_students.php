<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColDateOfOrderDeliveredToHeadFineStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->datetime('date_of_order_delivered')->nullable();
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
            $table->dropColumn('date_of_order_delivered');
        });
    }
}
