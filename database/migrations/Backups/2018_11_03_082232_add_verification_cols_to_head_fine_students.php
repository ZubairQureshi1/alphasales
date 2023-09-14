<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVerificationColsToHeadFineStudents extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('head_fine_students', function (Blueprint $table) {
            $table->boolean('is_verified')->default(false);
            $table->string('verified_by')->nullable();
            $table->boolean('payment_verification')->default(false);
            $table->string('payment_verified_by')->nullable();
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
            $table->dropColumn('is_verified');
            $table->dropColumn('verified_by');
            $table->dropColumn('payment_verification');
            $table->dropColumn('payment_verified_by');
        });
    }
}
