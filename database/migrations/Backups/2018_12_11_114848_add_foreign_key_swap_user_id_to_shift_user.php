<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeySwapUserIdToShiftUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('shift_users', function (Blueprint $table) {
            $table->unsignedInteger('shift_swap_id')->nullable();
            $table->foreign('shift_swap_id')->references('id')->on('shift_swaps')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('shift_users', function (Blueprint $table) {
            $table->dropForeign(['shift_swap_id']);
            $table->dropColumn(['shift_swap_id']);
        });
    }
}
