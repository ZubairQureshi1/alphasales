<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColVoucherToHeadfinestudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->string('voucher_code')->nullable();

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
            $table->dropColumn('voucher_code');

        });
    }
}
