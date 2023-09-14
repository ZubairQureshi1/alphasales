<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;

use App\Models\Pwwb\DocumentAttachmentDetail;
use App\Fields\DocumentAttachmentDetailFields;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class DocumentAttachmentDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');
        $result_card_quantity = Arr::get($params,DocumentAttachmentDetailFields::RESULT_CARD_QUANTITY);
        $result_card_attested = Arr::get($params,DocumentAttachmentDetailFields::RESULT_CARD_ATTESTED);
        $noc_affiliated_body = Arr::get($params,DocumentAttachmentDetailFields::NOC_AFFILIATED_BODY);
        // Ali Naeem Edit.
        $noc_received_yes_no = Arr::get($params,DocumentAttachmentDetailFields::NOC_RECIEVED_YES_NO);
        $equivalence_certificate = Arr::get($params,DocumentAttachmentDetailFields::EQUIVALENCE_CERTIFICATE);
        // Ali Naeem Edit.
        $equivalence_yes_no = Arr::get($params,DocumentAttachmentDetailFields::EQUIVALENCE_YES_NO);
        $certificate_quantity = Arr::get($params,DocumentAttachmentDetailFields::CERTIFICATE_QUANTITY);
        $character_certificate_attested = Arr::get($params,DocumentAttachmentDetailFields::CHARACTER_CERTIFICATE_ATTESTED);
        $collage_card_quantity = Arr::get($params,DocumentAttachmentDetailFields::COLLAGE_CARD_QUANTITY);
        $transport_card_quantity = Arr::get($params,DocumentAttachmentDetailFields::TRANSPORT_CARD_QUANTITY);
        $admission_letter_original = Arr::get($params,DocumentAttachmentDetailFields::ADMISSION_LETTER_ORIGINAL);
        $admission_letter_principal_sign = Arr::get($params,DocumentAttachmentDetailFields::ADMISSION_LETTER_PRINCIPAL_SIGN);
        $bonafide_letter_original = Arr::get($params,DocumentAttachmentDetailFields::BONAFIDE_LETTER_ORIGINAL);
        // aLI nAEEM eDIT .
        $bonafide_recieved_ves_no = Arr::get($params,DocumentAttachmentDetailFields::BONAFIDE_RECIEVED_YES_NO);
        $bonafide_letter_principal_sign = Arr::get($params,DocumentAttachmentDetailFields::BONAFIDE_LETTER_PRINCIPAL_SIGN);
        $claim_letter_original = Arr::get($params,DocumentAttachmentDetailFields::CLAIM_LETTER_ORIGINAL);
        $claim_letter_principal_sign = Arr::get($params,DocumentAttachmentDetailFields::CLAIM_LETTER_PRINCIPAL_SIGN);
        $affidavit_original = Arr::get($params,DocumentAttachmentDetailFields::AFFIDAVIT_ORIGINAL);
        $affidavit_worker_sign = Arr::get($params,DocumentAttachmentDetailFields::AFFIDAVIT_WORKER_SIGN);
        $worker_thumb = Arr::get($params,DocumentAttachmentDetailFields::WORKER_THUMB);
        $oath_commission_attested = Arr::get($params,DocumentAttachmentDetailFields::OATH_COMMISSION_ATTESTED);

        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = DocumentAttachmentDetail::where(DocumentAttachmentDetailFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new DocumentAttachmentDetail();
            }
        }

        $object->index_table_id = $indexTableId;
        $object->result_card_quantity = $result_card_quantity;
        $object->result_card_attested = $result_card_attested;
        $object->noc_affiliated_body = $noc_affiliated_body;
        // Ali Naeem Edit .
        $object->noc_received_yes_no = $noc_received_yes_no;
        $object->equivalence_certificate = $equivalence_certificate;
        // Ali Naeem Edit.
        $object->equivalence_yes_no = $equivalence_yes_no;
        $object->certificate_quantity = $certificate_quantity;
        $object->character_certificate_attested = $character_certificate_attested;
        $object->collage_card_quantity = $collage_card_quantity;
        $object->transport_card_quantity = $transport_card_quantity;
        $object->admission_letter_original = $admission_letter_original;
        $object->admission_letter_principal_sign = $admission_letter_principal_sign;
        $object->bonafide_letter_original = $bonafide_letter_original;
        // alI nAEEM eDIT .
        $object->bonafide_recieved_ves_no = $bonafide_recieved_ves_no;
        $object->bonafide_letter_principal_sign = $bonafide_letter_principal_sign;
        $object->claim_letter_original = $claim_letter_original;
        $object->claim_letter_principal_sign = $claim_letter_principal_sign;
        $object->affidavit_original = $affidavit_original;
        $object->affidavit_worker_sign = $affidavit_worker_sign;
        $object->worker_thumb = $worker_thumb;
        $object->oath_commission_attested = $oath_commission_attested;
        $object->save();


        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }
}
