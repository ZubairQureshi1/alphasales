<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentPersonalDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('student_personal_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('father_name')->nullable();
            $table->string('cnic_no')->nullable();
            $table->string('quantity')->nullable();
            $table->string('student_cnic_attested')->nullable();
            $table->date('date_of_birth')->nullable();
            $table->string('present_address')->nullable();
            $table->string('marital_status')->nullable();
            // $table->string('contact_no_1')->nullable();
            // $table->string('contact_no_2')->nullable();
            $table->string('postal_address')->nullable();
            $table->string('email')->nullable();
            $table->string('signature')->nullable();
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
        Schema::table('student_personal_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('student_personal_details');
    }
}
