<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColFinePaidDateToFeePackageInstalments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_package_installments', function (Blueprint $table) {
            $table->date('fine_paid_date')->nullable();
            $table->date('remaining_balance_fine_paid_date')->nullable();
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
            $table->dropColumn('fine_paid_date');
            $table->dropColumn('remaining_balance_fine_paid_date');
        });
    }
}
