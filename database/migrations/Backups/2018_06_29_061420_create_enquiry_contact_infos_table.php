<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEnquiryContactInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('enquiry_contact_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('phone_no')->nullable();
            $table->integer('contact_type_id')->nullable();
            $table->string('contact_type_name')->default("");
            $table->unsignedInteger('enquiry_id')->nullable();
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('enquiry_contact_infos', function (Blueprint $table) {
            $table->dropForeign(['enquiry_id']);
        });
        Schema::dropIfExists('enquiry_contact_infos');
    }
}
