<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoursePlanColsToSessionCourses extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('session_courses', function (Blueprint $table) {
            $table->integer('degree_type_id')->nullable();
            $table->integer('quota')->nullable();
            $table->integer('tuition_fee')->nullable();
            $table->integer('min_installments')->nullable();
            $table->integer('max_installments')->nullable();
            $table->integer('min_discount')->nullable();
            $table->integer('max_discount')->nullable();

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
            $table->dropColumn('degree_type_id');
            $table->dropColumn('quota');
            $table->dropColumn('tuition_fee');
            $table->dropColumn('min_installments');
            $table->dropColumn('max_installments');
            $table->dropColumn('min_discount');
            $table->dropColumn('max_discount');

        });
    }
}
