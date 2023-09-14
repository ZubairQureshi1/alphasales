<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendance_fines', function (Blueprint $table) {
            $table->increments('id');
            $table->string('amount')->nullable();
            $table->string('paid_amount')->nullable();
            $table->string('balance')->nullable();
            $table->string('voucher_number')->nullable();
            $table->string('amount_waived')->nullable();
            $table->string('amount_after_waived')->nullable();

            $table->unsignedInteger('student_id')->nullable();
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
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
        Schema::table('attendance_fines', function (Blueprint $table) {
            $table->dropForeign(['student_id']);
        });
        Schema::dropIfExists('attendance_fines');
    }
}
