<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFeeHeadsToSessionCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->integer('admission_registration_fee')->nullable();
            $table->integer('exam_fee')->nullable();
            $table->integer('exam_stationary')->nullable();
            $table->integer('cfe_publication')->nullable();
            $table->integer('student_card_fee')->nullable();
            $table->integer('trasnport_card_fee')->nullable();
            $table->integer('uniform_charges')->nullable();
            $table->integer('library_card_fee')->nullable();
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
            $table->dropColumn([
                'admission_registration_fee',
                'exam_fee',
                'exam_stationary',
                'cfe_publication',
                'student_card_fee',
                'trasnport_card_fee',
                'uniform_charges',
                'library_card_fee',
            ]);
        });
    }
}
