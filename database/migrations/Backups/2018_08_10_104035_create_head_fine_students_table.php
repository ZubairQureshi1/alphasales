<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHeadFineStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('head_fine_students', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('head_id')->nullable();
            $table->foreign('head_id')->references('id')->on('head_fines');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students');
            $table->unsignedInteger('package_id')->nullable();
            $table->foreign('package_id')->references('id')->on('fee_packages');
            $table->unsignedInteger('installment_id')->nullable();
            $table->foreign('installment_id')->references('id')->on('fee_package_installments');
            $table->string('status_name')->nullable();
            $table->unsignedInteger('status_id')->nullable();
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
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('head_fine_students');
        Schema::enableForeignKeyConstraints();
    }
}
