<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateImsDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ims_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('ims_course_applied_in_cfe')->nullable();
            $table->string('ims_course_enrolled_in_cfe')->nullable();
            $table->string('ims_course_registered')->nullable();
            $table->string('ims_roll_no')->nullable();
            $table->string('ims_affiliated_body')->nullable();
            $table->string('ims_duration_of_course')->nullable();
            $table->date('ims_admission_date')->nullable();
            $table->date('ims_ending_date')->nullable();
            $table->string('ims_academic_term')->nullable();
            $table->string('ims_semester_category')->nullable();
            $table->string('ims_shift')->nullable();
            $table->string('ims_registration_status')->nullable();
            $table->date('ims_registration_date')->nullable();
            $table->string('ims_actual_fee')->nullable();
            $table->string('ims_late_fee')->nullable();
            $table->string('ims_total_fee')->nullable();
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
        Schema::table('ims_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('ims_details');
    }
}
