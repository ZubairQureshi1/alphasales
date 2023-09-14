<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExamFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_fines', function (Blueprint $table) {
            $table->increments('id');

            $table->unsignedInteger('exam_type_id');
            $table->foreign('exam_type_id')->references('id')->on('exam_types');

            $table->unsignedInteger('date_sheet_id')->nullable();
            $table->foreign('date_sheet_id')->references('id')->on('date_sheets')->onDelete('set null');

            $table->unsignedInteger('student_academic_history_id')->nullable();
            $table->foreign('student_academic_history_id')->references('id')->on('student_academic_histories')->onDelete('set null');

            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');

            $table->string('amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('balance')->nullable();
            $table->string('voucher_number')->nullable();
            $table->string('amount_waived')->nullable();
            $table->string('amount_after_waived')->nullable();
            $table->string('previous_reference')->nullable();
            $table->string('next_reference')->nullable();

            $table->date('due_date')->nullable();
            $table->date('paid_date')->nullable();
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
        Schema::table('exam_fines', function (Blueprint $table) {
            $table->dropForeign(['exam_type_id']);
            $table->dropForeign(['date_sheet_id']);
            $table->dropForeign(['student_academic_history_id']);
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('exam_fines');

    }
}
