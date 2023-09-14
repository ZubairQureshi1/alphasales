<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionAffiliatedBodyChecklistsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admission_affiliated_body_checklists', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedInteger('admission_id')->nullable();
            $table->foreign('admission_id')->references('id')->on('admissions')->onDelete('cascade');

            $table->unsignedBigInteger('affiliated_body_checklist_id')->nullable();
            $table->foreign('affiliated_body_checklist_id', 'abc_id')->references('id')->on('affiliated_body_checklists')->onDelete('cascade');

            $table->boolean('is_checked')->nullable();

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
        Schema::dropIfExists('admission_affiliated_body_checklists');
    }
}
