<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAfDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('af_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');

            $table->string('af_course_applied_in')->nullable();
            $table->string('af_course_enrolled_in')->nullable();
            $table->string('af_course_registered_in')->nullable();
            $table->string('af_roll_no')->nullable();
            $table->string('af_affiliated_body')->nullable();
            $table->string('af_duration_of_course')->nullable();
            $table->date('af_admission_date')->nullable();
            $table->date('af_ending_date')->nullable();
            $table->string('af_academic_term')->nullable();
            $table->string('af_semester_category')->nullable();
            $table->string('af_shift')->nullable();
            $table->string('af_registration_status')->nullable();
            $table->date('af_registration_date')->nullable();
            $table->string('af_actual_fee')->nullable();
            $table->string('af_late_fee')->nullable();
            $table->string('af_total_fee')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('af_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('af_details');
    }
}
