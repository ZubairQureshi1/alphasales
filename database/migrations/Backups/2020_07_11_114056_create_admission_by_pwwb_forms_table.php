<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionByPwwbFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_by_pwwb_forms', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('cascade');

            $table->unsignedBigInteger('index_table_id')->nullable();
            $table->foreign('index_table_id')->references('id')->on('index_tables')->onDelete('cascade');
            
            $table->boolean('is_admitted')->default(false);

            $table->unsignedBigInteger('organization_id')->nullable();
            $table->foreign('organization_id')->references('id')->on('organizations')->onDelete('set null');

            $table->unsignedBigInteger('organization_campus_id')->nullable();
            $table->foreign('organization_campus_id')->references('id')->on('organization_campuses')->onDelete('set null');

            $table->unsignedBigInteger('academic_wing_id')->nullable();
            $table->foreign('academic_wing_id')->references('id')->on('wings')->onDelete('set null');

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
        Schema::dropIfExists('admission_by_pwwb_forms');
    }
}
