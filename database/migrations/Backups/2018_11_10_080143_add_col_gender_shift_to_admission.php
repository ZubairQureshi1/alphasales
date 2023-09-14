<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColGenderShiftToAdmission extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->string('gender')->nullable();
            $table->integer('gender_id')->nullable();
            $table->string('shift')->nullable();
            $table->integer('shift_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn('gender');
            $table->dropColumn('gender_id');
            $table->dropColumn('shift');
            $table->dropColumn('shift_id');
        });
    }
}
