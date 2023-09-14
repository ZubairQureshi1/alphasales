<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileColsToUser extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobile_no')->nullable();
            $table->string('landline_no')->nullable();
            $table->string('cnic_no')->nullable();
            $table->string('cnic_expiry')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('religion')->nullable();
            $table->string('martial_status')->nullable();
            $table->string('blood_group')->nullable();
            $table->string('father_name')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('mobile_no');
            $table->dropColumn('landline_no');
            $table->dropColumn('cnic_no');
            $table->dropColumn('cnic_expiry');
            $table->dropColumn('age');
            $table->dropColumn('gender');
            $table->dropColumn('religion');
            $table->dropColumn('martial_status');
            $table->dropColumn('blood_group');
            $table->dropColumn('father_name');
        });
    }
}
