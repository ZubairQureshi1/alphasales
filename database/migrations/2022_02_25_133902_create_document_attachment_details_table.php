<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDocumentAttachmentDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('document_attachment_details', function(Blueprint $table)
		{
			$table->bigInteger('id', true)->unsigned();
			$table->bigInteger('index_table_id')->unsigned()->index('document_attachment_details_index_table_id_foreign');
			$table->string('result_card_quantity', 191)->nullable();
			$table->string('result_card_attested', 191)->nullable();
			$table->string('noc_affiliated_body', 191)->nullable();
			$table->string('noc_received_yes_no', 191)->nullable();
			$table->string('equivalence_certificate', 191)->nullable();
			$table->string('equivalence_yes_no', 191)->nullable();
			$table->string('certificate_quantity', 191)->nullable();
			$table->string('character_certificate_attested', 191)->nullable();
			$table->string('collage_card_quantity', 191)->nullable();
			$table->string('transport_card_quantity', 191)->nullable();
			$table->string('admission_letter_original', 191)->nullable();
			$table->string('admission_letter_principal_sign', 191)->nullable();
			$table->string('bonafide_letter_original', 191)->nullable();
			$table->string('bonafide_recieved_ves_no', 191)->nullable();
			$table->string('bonafide_letter_principal_sign', 191)->nullable();
			$table->string('claim_letter_original', 191)->nullable();
			$table->string('claim_letter_principal_sign', 191)->nullable();
			$table->string('affidavit_original', 191)->nullable();
			$table->string('affidavit_worker_sign', 191)->nullable();
			$table->string('worker_thumb', 191)->nullable();
			$table->string('oath_commission_attested', 191)->nullable();
			$table->timestamps(3);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('document_attachment_details');
	}

}
