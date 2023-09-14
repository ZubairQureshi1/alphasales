<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddWorkerColsToStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->integer('is_worker')->nullable();
            $table->string('experience')->nullable();
            $table->string('designation')->nullable();
            $table->string('eobi')->nullable();
            $table->string('ssc')->nullable();
            $table->string('factory_city')->nullable();
            $table->string('factory_reg_no')->nullable();
            $table->integer('is_transport')->nullable();
            $table->integer('is_hostel')->nullable();
            $table->integer('is_provisional_letter')->nullable();
            $table->string('cfe_file_no')->nullable();
            $table->string('dairy_no')->nullable();
            $table->integer('self_worker')->nullable();
            $table->string('r_eight')->nullable();
            $table->string('factory_name')->nullable();
            $table->integer('transport_route_id')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('students', function (Blueprint $table) {
            $table->dropColumn(['is_worker',
                'experience', 'designation', 'eobi', 'ssc', 'factory_city', 'factory_reg_no', 'is_transport', 'is_hostel', 'is_provisional_letter',
                'cfe_file_no', 'dairy_no', 'self_worker', 'r_eight', 'factory_name', 'transport_route_id']);
        });
    }
}
