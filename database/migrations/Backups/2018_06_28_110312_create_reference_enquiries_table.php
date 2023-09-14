<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReferenceEnquiriesTable extends Migration
{
    public function up()
    {
        Schema::create('reference_enquiries', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('reference_id');
            $table->foreign('reference_id')->references('id')->on('references');
            $table->unsignedInteger('enquiry_id');
            $table->foreign('enquiry_id')->references('id')->on('enquiries')->onDelete('cascade');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::table('reference_enquiries', function (Blueprint $table) {
            $table->dropForeign(['reference_id'], ['enquiry_id']);
        });
        Schema::dropIfExists('reference_enquiries');
    }
}
