<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInstallmentPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_installment_plans', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->unsignedInteger('fee_package_id')->nullable();
            $table->foreign('fee_package_id')->references('id')->on('fee_packages')->onDelete('cascade');
            $table->unsignedInteger('student_academic_history_id')->nullable();
            $table->foreign('student_academic_history_id')->references('id')->on('student_academic_histories')->onDelete('cascade');
            $table->integer('no_of_installments')->nullable();
            $table->unsignedInteger('approval_by_id')->nullable();
            $table->foreign('approval_by_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('student_installment_plans');
        Schema::enableForeignKeyConstraints();
    }
}
