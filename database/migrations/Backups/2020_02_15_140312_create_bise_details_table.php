<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBiseDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bise_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');

            $table->string('bise_educational_wing_cfe')->nullable();
            $table->string('bise_course_applied_in')->nullable();
            $table->string('bise_optional_subject')->nullable();
            $table->string('bise_others')->nullable();
            $table->string('bise_course_enrolled_cfe')->nullable();
            $table->string('bise_course_registered_in')->nullable();
            $table->string('bise_roll_no')->nullable();
            $table->string('bise_affiliated_body')->nullable();
            $table->string('bise_duration_of_course')->nullable();
            $table->date('bise_admission_date')->nullable();
            $table->date('bise_ending_date')->nullable();
            $table->string('bise_academic_term')->nullable();
            $table->string('bise_semester_category')->nullable();
            $table->string('bise_shift')->nullable();
            $table->string('bise_registration_status')->nullable();
            $table->date('bise_registration_date')->nullable();
            $table->string('bise_actual_fee')->nullable();
            $table->string('bise_late_fee')->nullable();
            $table->string('bise_total_fee')->nullable();
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
        Schema::table('bise_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('bise_details');
    }
}
