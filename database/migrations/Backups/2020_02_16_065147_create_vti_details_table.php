<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVtiDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vti_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('vti_diploma_applied_in')->nullable();
            $table->string('vti_diploma_enrolled_in')->nullable();
            $table->string('vti_diploma_registered_in')->nullable();
            $table->string('vti_dual_course')->nullable();
            $table->string('vti_reason')->nullable();
            $table->string('vti_further_file_received')->nullable();
            $table->date('vti_follow_up')->nullable();
            $table->string('vti_roll_no')->nullable();
            $table->string('vti_affiliated_body')->nullable();
            $table->string('vti_duration_of_diploma')->nullable();
            $table->date('vti_admission_date')->nullable();
            $table->date('vti_ending_date')->nullable();
            $table->string('vti_scheme_of_study')->nullable();
            $table->string('vti_semester_category')->nullable();
            $table->string('vti_shift')->nullable();
            $table->string('vti_registration_status')->nullable();
            $table->date('vti_date_of_registration')->nullable();
            $table->string('vti_registration_actual_fee')->nullable();
            $table->string('vti_registration_late_fee')->nullable();
            $table->string('vti_registration_total_fee')->nullable();
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
        Schema::table('vti_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('vti_details');
    }
}
