<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColExperienceInMonthAndUpdateExperienceToExperienceInYearsInEnquiryWorkers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('enquiry_workers', function (Blueprint $table) {
            $table->string('worker_experience_in_months')->nullable();
            $table->renameColumn('worker_experience', 'worker_experience_in_years');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiry_workers', function (Blueprint $table) {
            $table->dropColumn('worker_experience_in_months');
            $table->renameColumn('worker_experience_in_years', 'worker_experience');
        });
    }
}
