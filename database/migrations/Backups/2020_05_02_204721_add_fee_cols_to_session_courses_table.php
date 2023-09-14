<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFeeColsToSessionCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->integer('cfe_admission_fee')->nullable();
            $table->integer('marketer_incentive')->nullable();
            $table->integer('registration_fee')->nullable();
            $table->integer('transport_charges')->nullable();
            $table->integer('miscellaneous')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->dropColumn(['cfe_admission_fee','marketer_incentive','registration_fee','transport_charges','miscellaneous', ]);
        });
    }
}
