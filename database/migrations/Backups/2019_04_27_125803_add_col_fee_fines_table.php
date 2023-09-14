<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColFeeFinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fee_fines', function (Blueprint $table) {
            $table->unsignedInteger('academic_history_id')->nullable();
            $table->foreign('academic_history_id')->references('id')->on('student_academic_histories')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fee_fines', function (Blueprint $table) {
            //
        });
    }
}
