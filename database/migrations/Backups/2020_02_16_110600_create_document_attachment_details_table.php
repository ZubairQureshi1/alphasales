<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentAttachmentDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('document_attachment_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('index_table_id');
            $table->foreign('index_table_id')
                ->references('id')->on('index_tables')
                ->onDelete('cascade');
            $table->string('result_card_quantity')->nullable();
            $table->string('result_card_attested')->nullable();
            $table->string('noc_affiliated_body')->nullable();
            $table->string('noc_received_yes_no')->nullable();
            $table->string('equivalence_certificate')->nullable();
            $table->string('equivalence_yes_no')->nullable();
            $table->string('certificate_quantity')->nullable();
            $table->string('character_certificate_attested')->nullable();
            $table->string('collage_card_quantity')->nullable();
            $table->string('transport_card_quantity')->nullable();
            $table->string('admission_letter_original')->nullable();
            $table->string('admission_letter_principal_sign')->nullable();
            $table->string('bonafide_letter_original')->nullable();
            $table->string('bonafide_recieved_ves_no')->nullable();
            $table->string('bonafide_letter_principal_sign')->nullable();
            $table->string('claim_letter_original')->nullable();
            $table->string('claim_letter_principal_sign')->nullable();
            $table->string('affidavit_original')->nullable();
            $table->string('affidavit_worker_sign')->nullable();
            $table->string('worker_thumb')->nullable();
            $table->string('oath_commission_attested')->nullable();

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
        Schema::table('document_attachment_details', function(Blueprint $table) {
            $table->dropForeign(['index_table_id']);
        });
        Schema::dropIfExists('document_attachment_details');
    }
}
