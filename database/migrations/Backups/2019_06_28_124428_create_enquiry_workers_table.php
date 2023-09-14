<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEnquiryWorkersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_workers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('enquiry_id')->nullable();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->string('factory_name')->nullable();
            $table->string('worker_experience')->nullable();
            $table->string('worker_designation')->nullable();
            $table->boolean('is_eobi')->nullable();
            $table->boolean('is_social_security')->nullable();
            $table->boolean('is_factory_registered')->nullable();
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
        Schema::table('enquiry_workers', function (Blueprint $table) {
            $table->dropforeign(['enquiry_id']);
        });

        Schema::dropIfExists('enquiry_workers');
    }
}
