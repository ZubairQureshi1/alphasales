<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendances', function (Blueprint $table) {

            $table->increments('id');
            $table->string('check_in_time')->nullable();
            $table->string('check_out_time')->nullable();
            $table->string('type_name')->nullable();
            $table->integer('type_id')->nullable();
            $table->string('name')->nullable();
            $table->string('emp_code')->nullable();
            $table->string('roll_number')->nullable();
            $table->string('time_slot_name')->nullable();
            $table->unsignedInteger('time_slot_id')->nullable();
            $table->foreign('time_slot_id')->references('id')->on('time_slots');
            $table->string('status')->nullable();
            $table->integer('status_id')->nullable();
            $table->string('punch_type')->nullable();
            $table->integer('punch_type_id')->nullable();
            $table->string('date')->nullable();

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
        Schema::dropIfExists('attendances');
        Schema::enableForeignKeyConstraints();
    }
}
