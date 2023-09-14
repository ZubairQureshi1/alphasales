<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\ProvisionalClaimDetailFields;
use App\Fields\ProvisionalClaimFields;
use App\Models\Pwwb\ProvisionalClaim;
use App\Models\Pwwb\ProvisionalClaimDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pwwb\Claim;



class ProvisionalClaimDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');
        $status = Arr::get($params,ProvisionalClaimDetailFields::STATUS);
        //$scrutiny_committee = Arr::get($params,ProvisionalClaimDetailFields::SCRUTINY_COMMITTEE);
        $bactch_number = Arr::get($params,ProvisionalClaimDetailFields::BATCH_NUMBER);

        $provisional_letter_date_explode = explode('/',Arr::get($params,ProvisionalClaimDetailFields::PROVISIONAL_LETTER_DATE));
        $scrutiny_committee_explode = explode('/',Arr::get($params,ProvisionalClaimDetailFields::SCRUTINY_COMMITTEE));
        if(count($scrutiny_committee_explode) == 3)
            $scrutiny_committee = Carbon::createFromDate($scrutiny_committee_explode[2],$scrutiny_committee_explode[1],$scrutiny_committee_explode[0])->format('Y-m-d');
        else
            $scrutiny_committee = Arr::get($params,ProvisionalClaimDetailFields::SCRUTINY_COMMITTEE);

        if(count($provisional_letter_date_explode) == 3)
            $provisional_letter_date = Carbon::createFromDate($provisional_letter_date_explode[2],$provisional_letter_date_explode[1],$provisional_letter_date_explode[0])->format('Y-m-d');
        else
            $provisional_letter_date = Arr::get($params,ProvisionalClaimDetailFields::PROVISIONAL_LETTER_DATE);


        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = ProvisionalClaimDetail::where(ProvisionalClaimDetailFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new ProvisionalClaimDetail();
            }
        }

        $object->index_table_id = $indexTableId;
        $object->status = $status;
        $object->scrutiny_committee = $scrutiny_committee;
        $object->bactch_number = $bactch_number;
        $object->provisional_letter_date = $provisional_letter_date;
        $object->save();
        //Provisonal Claim
        $serialNo = Arr::get($params, ProvisionalClaimFields::SERIAL_NO);
        $claim_due = Arr::get($params,ProvisionalClaimFields::CLAIM_DUE);
        $type_of_claim = Arr::get($params,ProvisionalClaimFields::TYPE_OF_CLAIM);
        $type_of_claim_other = Arr::get($params,ProvisionalClaimFields::TYPE_OF_CLAIM_OTHER);
        $claim_status = Arr::get($params,ProvisionalClaimFields::CLAIM_STATUS);
        $claim_date = Arr::get($params,ProvisionalClaimFields::CLAIM_DATE);
        $claim_received = Arr::get($params,ProvisionalClaimFields::CLAIM_RECEIVED);

        // Claims Fileds Start
        $page_number = '14';
        $claim_due_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_DUE_PAGE_14);
        $claim_status_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_STATUS_PAGE_14);
        $reason_page_14 = Arr::get($params, ProvisionalClaimFields::REASON_PAGE_14);
        $outstanding_cfe_fee_page_14 = Arr::get($params, ProvisionalClaimFields::OUTSTANDING_CFE_FEE_PAGE_14);
        $recovered_amount_page_14 = Arr::get($params, ProvisionalClaimFields::RECOVERED_AMOUNT_PAGE_14);
        $claim_head_default_1_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_1_PAGE_14);
        $claim_head_default_2_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_2_PAGE_14);
        $claim_head_default_3_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_3_PAGE_14);
        $claim_head_default_4_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_4_PAGE_14);
        $claim_head_default_5_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_5_PAGE_14);
        $claim_head_default_6_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_6_PAGE_14);
        $claim_head_default_7_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_7_PAGE_14);
        $claim_head_default_8_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_HEAD_DEFAULT_8_PAGE_14);
        $claim_amount_due_default_1_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_14);
        $claim_amount_due_default_2_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_14);
        $claim_amount_due_default_3_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_14);
        $claim_amount_due_default_4_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_14);
        $claim_amount_due_default_5_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_14);
        $claim_amount_due_default_6_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_14);
        $claim_amount_due_default_7_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_14);
        $claim_amount_due_default_8_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_14);
        $claim_amount_due_default_page_14 = Arr::get($params, ProvisionalClaimFields::CLAIM_AMOUNT_DUE_DEFAULT_PAGE_14);
        $type_of_claim_1_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_1_PAGE_14);
        $type_of_claim_2_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_2_PAGE_14);
        $type_of_claim_3_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_3_PAGE_14);
        $type_of_claim_4_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_4_PAGE_14);
        $type_of_claim_5_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_5_PAGE_14);
        $type_of_claim_6_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_6_PAGE_14);
        $type_of_claim_7_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_7_PAGE_14);
        $type_of_claim_8_page_14 = Arr::get($params, ProvisionalClaimFields::TYPE_OF_CLAIM_8_PAGE_14);
        $amount_due_1_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_1_PAGE_14);
        $amount_received_1_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_1_PAGE_14);
        $balance_due_1_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_1_PAGE_14);
        $amount_due_2_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_2_PAGE_14);
        $amount_received_2_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_2_PAGE_14);
        $balance_due_2_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_2_PAGE_14);
        $amount_due_3_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_3_PAGE_14);
        $amount_received_3_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_3_PAGE_14);
        $balance_due_3_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_3_PAGE_14);
        $amount_due_4_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_4_PAGE_14);
        $amount_received_4_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_4_PAGE_14);
        $balance_due_4_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_4_PAGE_14);
        $amount_due_5_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_5_PAGE_14);
        $amount_received_5_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_5_PAGE_14);
        $balance_due_5_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_5_PAGE_14);
        $amount_due_6_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_6_PAGE_14);
        $amount_received_6_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_6_PAGE_14);
        $balance_due_6_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_6_PAGE_14);
        $amount_due_7_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_7_PAGE_14);
        $amount_received_7_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_7_PAGE_14);
        $balance_due_7_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_7_PAGE_14);
        $amount_due_8_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_8_PAGE_14);
        $amount_received_8_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_8_PAGE_14);
        $balance_due_8_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_8_PAGE_14);
        $amount_due_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_DUE_PAGE_14);
        $amount_received_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_PAGE_14);
        $balance_due_page_14 = Arr::get($params, ProvisionalClaimFields::BALANCE_DUE_PAGE_14);
        $amount_received_last_page_14 = Arr::get($params, ProvisionalClaimFields::AMOUNT_RECEIVED_LAST_PAGE_14);
        $total_amount_cheque_page_14 = Arr::get($params, ProvisionalClaimFields::TOTAL_AMOUNT_CHEQUE_PAGE_14);
        $cheque_date_page_14 = Arr::get($params, ProvisionalClaimFields::CHEQUE_DATE_PAGE_14);
        $cheque_no_page_14 = Arr::get($params, ProvisionalClaimFields::CHEQUE_NO_PAGE_14);
        $bank_name_page_14 = Arr::get($params, ProvisionalClaimFields::BANK_NAME_PAGE_14);
        $reason_remarks_page_14 = Arr::get($params, ProvisionalClaimFields::REASON_REMARKS_PAGE_14);

        


        $reason = Arr::get($params,ProvisionalClaimFields::REASON);
        $cfe_fee = Arr::get($params,ProvisionalClaimFields::CFE_FEE);
        $recovery_from_student = Arr::get($params,ProvisionalClaimFields::RECOVERY_FROM_STUDENT);


        // if (!$indexTableId) {
        //     for ($i = 0; $i < count($serialNo); $i++) {
        //         $ProvisionalClaim = new ProvisionalClaim();
        //         $this->fillProvisionalClaimData($i, $ProvisionalClaim, $indexTableId,$serialNo, $claim_due, $claim_status, $claim_received, $claim_date, $reason, $cfe_fee, $recovery_from_student, $type_of_claim, $type_of_claim_other);
        //     }
        // } else {
        //     $j = 0;
        //     foreach (ProvisionalClaim::where('index_table_id', $indexTableId)->get() as $ProvisionalClaim) {
        //         $ProvisionalClaimSingle = ProvisionalClaim::find($ProvisionalClaim->id);
        //         $this->fillProvisionalClaimData($j, $ProvisionalClaimSingle, $indexTableId,$serialNo, $claim_due, $claim_status, $claim_received, $claim_date, $reason, $cfe_fee, $recovery_from_student, $type_of_claim, $type_of_claim_other);
        //         $j++;
        //     }
        //     if ($j < count($serialNo)) {
        //         for ($k = $j; $k < count($serialNo); $k++) {
        //             $ProvisionalClaim = new ProvisionalClaim();
        //             $this->fillProvisionalClaimData($k, $ProvisionalClaim, $indexTableId, $serialNo, $claim_due, $claim_status, $claim_received, $claim_date, $reason, $cfe_fee, $recovery_from_student, $type_of_claim, $type_of_claim_other);
        //         }
        //     }
        // }

        $checkIfClaimExists = Claim::where(ProvisionalClaimDetailFields::INDEX_TABLE_ID,$indexTableId)->where('page_number', '=', 14)->first();
        if(!$checkIfClaimExists){
            // Claims Fields End
            $this->claimsStore(
                '1a',
                '1a',
                'claimAdd',
                $page_number,
                $indexTableId,
                $claim_due_page_14,
                $claim_status_page_14,
                $reason_page_14,
                $outstanding_cfe_fee_page_14,
                $recovered_amount_page_14, 
                $claim_head_default_1_page_14,
                $claim_head_default_2_page_14,
                $claim_head_default_3_page_14,
                $claim_head_default_4_page_14,
                $claim_head_default_5_page_14,
                $claim_head_default_6_page_14,
                $claim_head_default_7_page_14,
                $claim_head_default_8_page_14,
                $claim_amount_due_default_1_page_14,
                $claim_amount_due_default_2_page_14,
                $claim_amount_due_default_3_page_14,
                $claim_amount_due_default_4_page_14,
                $claim_amount_due_default_5_page_14,
                $claim_amount_due_default_6_page_14,
                $claim_amount_due_default_7_page_14,
                $claim_amount_due_default_8_page_14,
                $claim_amount_due_default_page_14,
                $type_of_claim_1_page_14,
                $type_of_claim_2_page_14,
                $type_of_claim_3_page_14,
                $type_of_claim_4_page_14,
                $type_of_claim_5_page_14,
                $type_of_claim_6_page_14,
                $type_of_claim_7_page_14,
                $type_of_claim_8_page_14,
                $amount_due_1_page_14,
                $amount_received_1_page_14,
                $balance_due_1_page_14,
                $amount_due_2_page_14,
                $amount_received_2_page_14,
                $balance_due_2_page_14,
                $amount_due_3_page_14,
                $amount_received_3_page_14,
                $balance_due_3_page_14,
                $amount_due_4_page_14,
                $amount_received_4_page_14,
                $balance_due_4_page_14,
                $amount_due_5_page_14,
                $amount_received_5_page_14,
                $balance_due_5_page_14,
                $amount_due_6_page_14,
                $amount_received_6_page_14,
                $balance_due_6_page_14,
                $amount_due_7_page_14,
                $amount_received_7_page_14,
                $balance_due_7_page_14,
                $amount_due_8_page_14,
                $amount_received_8_page_14,
                $balance_due_8_page_14,
                $amount_due_page_14,
                $amount_received_page_14,
                $balance_due_page_14,
                $amount_received_last_page_14,
                $total_amount_cheque_page_14,
                $cheque_date_page_14,
                $cheque_no_page_14,
                $bank_name_page_14,
                $reason_remarks_page_14
            );
        }
        else{
            $claimIndexTableId = Claim::where(ProvisionalClaimDetailFields::INDEX_TABLE_ID, '=', $indexTableId)->where('page_number', '=', 14)->get();
            // dd($claimIndexTableId, $claimIndexTableId[2]->id);
            // foreach($claimIndexTableId as $key => &$val){
            $j = 1;
            foreach($claimIndexTableId as $val){
                // if($val->inde_table_id == $indexTableI){
                    
                     $this->claimsStore(
                        $j++,
                        $val['id'],
                        'claimEdit',
                        $page_number,
                        $indexTableId,
                        $claim_due_page_14,
                        $claim_status_page_14,
                        $reason_page_14,
                        $outstanding_cfe_fee_page_14,
                $recovered_amount_page_14, 
                        $claim_head_default_1_page_14,
                        $claim_head_default_2_page_14,
                        $claim_head_default_3_page_14,
                        $claim_head_default_4_page_14,
                        $claim_head_default_5_page_14,
                        $claim_head_default_6_page_14,
                        $claim_head_default_7_page_14,
                        $claim_head_default_8_page_14,
                        $claim_amount_due_default_1_page_14,
                        $claim_amount_due_default_2_page_14,
                        $claim_amount_due_default_3_page_14,
                        $claim_amount_due_default_4_page_14,
                        $claim_amount_due_default_5_page_14,
                        $claim_amount_due_default_6_page_14,
                        $claim_amount_due_default_7_page_14,
                        $claim_amount_due_default_8_page_14,
                        $claim_amount_due_default_page_14,
                        $type_of_claim_1_page_14,
                        $type_of_claim_2_page_14,
                        $type_of_claim_3_page_14,
                        $type_of_claim_4_page_14,
                        $type_of_claim_5_page_14,
                        $type_of_claim_6_page_14,
                        $type_of_claim_7_page_14,
                        $type_of_claim_8_page_14,
                        $amount_due_1_page_14,
                        $amount_received_1_page_14,
                        $balance_due_1_page_14,
                        $amount_due_2_page_14,
                        $amount_received_2_page_14,
                        $balance_due_2_page_14,
                        $amount_due_3_page_14,
                        $amount_received_3_page_14,
                        $balance_due_3_page_14,
                        $amount_due_4_page_14,
                        $amount_received_4_page_14,
                        $balance_due_4_page_14,
                        $amount_due_5_page_14,
                        $amount_received_5_page_14,
                        $balance_due_5_page_14,
                        $amount_due_6_page_14,
                        $amount_received_6_page_14,
                        $balance_due_6_page_14,
                        $amount_due_7_page_14,
                        $amount_received_7_page_14,
                        $balance_due_7_page_14,
                        $amount_due_8_page_14,
                        $amount_received_8_page_14,
                        $balance_due_8_page_14,
                        $amount_due_page_14,
                        $amount_received_page_14,
                        $balance_due_page_14,
                        $amount_received_last_page_14,
                        $total_amount_cheque_page_14,
                        $cheque_date_page_14,
                        $cheque_no_page_14,
                        $bank_name_page_14,
                        $reason_remarks_page_14
                    );


             // }
            }
        }

        //  Claims Data Save Start

        

        // Claims data save End


        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }


 private function fillProvisionalClaimData($index,$provisionalClaimObject,$indexTableId, $serialNo, $claim_due, $claim_status, $claim_received, $claim_date, $reason, $cfe_fee, $recovery_from_student, $type_of_claim, $type_of_claim_other){
        $provisionalClaimObject->index_table_id = $indexTableId;
        $provisionalClaimObject->serial_no = isset($serialNo[$index]) ? $serialNo[$index] : null;
        $provisionalClaimObject->claim_due = isset($claim_due[$index]) ? $claim_due[$index] : null;
        $provisionalClaimObject->type_of_claim = isset($type_of_claim[$index]) ? $type_of_claim[$index] : null;
        $provisionalClaimObject->type_of_claim_other = isset($type_of_claim_other[$index]) ? $type_of_claim_other[$index] : null;
        $provisionalClaimObject->claim_status = isset($claim_status[$index]) ? $claim_status[$index] : null;
        $provisionalClaimObject->claim_received = isset($claim_received[$index]) ? $claim_received[$index] : null;
        $provisionalClaimObject->reason = isset($reason[$index]) ? $reason[$index] : null;
        $provisionalClaimObject->cfe_fee = isset($cfe_fee[$index]) ? $cfe_fee[$index] : null;
        $provisionalClaimObject->recovery_from_student = isset($recovery_from_student[$index]) ? $recovery_from_student[$index] : null;
        $claim_dateValue = null;
        if(isset($claim_date[$index])){
            $claim_dateExplode = explode('/',$claim_date[$index]);
            if(count($claim_dateExplode) == 3)
                $claim_dateValue = Carbon::createFromDate($claim_dateExplode[2],$claim_dateExplode[1],$claim_dateExplode[0])->format('Y-m-d');
            else
                $claim_dateValue = $claim_date[$index];
        }

        $provisionalClaimObject->claim_date = $claim_dateValue;
        $provisionalClaimObject->save();
    }

    public function deleteProvisionalClaim(Request $request){
        $params = $request->all();
        $id = Arr::get($params,ProvisionalClaimFields::SERIAL_NO);
        $indexId = Arr::get($params,'index_id');
        $object = ProvisionalClaim::where('serial_no',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    public function claimsStore($j,$indexes,$claim,$page_number,
                        $indexTableId,
                        $claim_due_page_14,
                        $claim_status_page_14,
                        $reason_page_14,
                        $outstanding_cfe_fee_page_14,
                $recovered_amount_page_14, 
                        $claim_head_default_1_page_14,
                        $claim_head_default_2_page_14,
                        $claim_head_default_3_page_14,
                        $claim_head_default_4_page_14,
                        $claim_head_default_5_page_14,
                        $claim_head_default_6_page_14,
                        $claim_head_default_7_page_14,
                        $claim_head_default_8_page_14,
                        $claim_amount_due_default_1_page_14,
                        $claim_amount_due_default_2_page_14,
                        $claim_amount_due_default_3_page_14,
                        $claim_amount_due_default_4_page_14,
                        $claim_amount_due_default_5_page_14,
                        $claim_amount_due_default_6_page_14,
                        $claim_amount_due_default_7_page_14,
                        $claim_amount_due_default_8_page_14,
                        $claim_amount_due_default_page_14,
                        $type_of_claim_1_page_14,
                        $type_of_claim_2_page_14,
                        $type_of_claim_3_page_14,
                        $type_of_claim_4_page_14,
                        $type_of_claim_5_page_14,
                        $type_of_claim_6_page_14,
                        $type_of_claim_7_page_14,
                        $type_of_claim_8_page_14,
                        $amount_due_1_page_14,
                        $amount_received_1_page_14,
                        $balance_due_1_page_14,
                        $amount_due_2_page_14,
                        $amount_received_2_page_14,
                        $balance_due_2_page_14,
                        $amount_due_3_page_14,
                        $amount_received_3_page_14,
                        $balance_due_3_page_14,
                        $amount_due_4_page_14,
                        $amount_received_4_page_14,
                        $balance_due_4_page_14,
                        $amount_due_5_page_14,
                        $amount_received_5_page_14,
                        $balance_due_5_page_14,
                        $amount_due_6_page_14,
                        $amount_received_6_page_14,
                        $balance_due_6_page_14,
                        $amount_due_7_page_14,
                        $amount_received_7_page_14,
                        $balance_due_7_page_14,
                        $amount_due_8_page_14,
                        $amount_received_8_page_14,
                        $balance_due_8_page_14,
                        $amount_due_page_14,
                        $amount_received_page_14,
                        $balance_due_page_14,
                        $amount_received_last_page_14,
                        $total_amount_cheque_page_14,
                        $cheque_date_page_14,
                        $cheque_no_page_14,
                        $bank_name_page_14,
                        $reason_remarks_page_14){
        if($indexes == '1a') {
            for($i = 1; $i<= 8; $i++){           
                if($i ==1){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 1;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_1_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_1_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_1_page_14;
                    $claimTable->amount_due = $amount_due_1_page_14;
                    $claimTable->amount_received = $amount_received_1_page_14;
                    $claimTable->amount_balance = $balance_due_1_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==2){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 2;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_2_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_2_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_2_page_14;
                    $claimTable->amount_due = $amount_due_2_page_14;
                    $claimTable->amount_received = $amount_received_2_page_14;
                    $claimTable->amount_balance = $balance_due_2_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==3){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 3;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_3_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_3_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_3_page_14;
                    $claimTable->amount_due = $amount_due_3_page_14;
                    $claimTable->amount_received = $amount_received_3_page_14;
                    $claimTable->amount_balance = $balance_due_3_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==4){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 4;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_4_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_4_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_4_page_14;
                    $claimTable->amount_due = $amount_due_4_page_14;
                    $claimTable->amount_received = $amount_received_4_page_14;
                    $claimTable->amount_balance = $balance_due_4_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==5){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 5;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_5_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_5_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_5_page_14;
                    $claimTable->amount_due = $amount_due_5_page_14;
                    $claimTable->amount_received = $amount_received_5_page_14;
                    $claimTable->amount_balance = $balance_due_5_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==6){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 6;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_6_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_6_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_6_page_14;
                    $claimTable->amount_due = $amount_due_6_page_14;
                    $claimTable->amount_received = $amount_received_6_page_14;
                    $claimTable->amount_balance = $balance_due_6_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==7){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 7;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_7_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_7_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_7_page_14;
                    $claimTable->amount_due = $amount_due_7_page_14;
                    $claimTable->amount_received = $amount_received_7_page_14;
                    $claimTable->amount_balance = $balance_due_7_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
                elseif($i ==8){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 8;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $indexTableId;
                    $claimTable->claim_due = $claim_due_page_14;
                    $claimTable->claim_status = $claim_status_page_14;
                    $claimTable->reason = $reason_page_14;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_14;
                    $claimTable->recovered_amount = $recovered_amount_page_14;
                    $claimTable->claim_head_default = $claim_head_default_8_page_14;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_8_page_14;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_14;
                    $claimTable->claim_head = $type_of_claim_8_page_14;
                    $claimTable->amount_due = $amount_due_8_page_14;
                    $claimTable->amount_received = $amount_received_8_page_14;
                    $claimTable->amount_balance = $balance_due_8_page_14;        
                    $claimTable->total_amount_due = $amount_due_page_14;
                    $claimTable->total_amount_received = $amount_received_page_14;
                    $claimTable->total_amount_balance = $balance_due_page_14;
                    $claimTable->amount_received_last = $amount_received_last_page_14;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_14;
                    $claimTable->cheque_date = $cheque_date_page_14;
                    $claimTable->cheque_no = $cheque_no_page_14;
                    $claimTable->bank_name = $bank_name_page_14;
                    $claimTable->reason_remarks = $reason_remarks_page_14;
                    $claimTable->save();
                }
            }
        }else{           
            if($j == 1){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_1_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_1_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_1_page_14,
                    'amount_received' => $amount_received_1_page_14,
                    'amount_balance' => $balance_due_1_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }elseif($j == 2){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_2_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_2_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_2_page_14,
                    'amount_received' => $amount_received_2_page_14,
                    'amount_balance' => $balance_due_2_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }elseif($j == 3){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_3_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_3_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_3_page_14,
                    'amount_received' => $amount_received_3_page_14,
                    'amount_balance' => $balance_due_3_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }elseif($j == 4){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_4_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_4_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_4_page_14,
                    'amount_received' => $amount_received_4_page_14,
                    'amount_balance' => $balance_due_4_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }elseif($j == 5){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_5_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_5_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_5_page_14,
                    'amount_received' => $amount_received_5_page_14,
                    'amount_balance' => $balance_due_5_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }elseif($j == 6){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_6_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_6_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_6_page_14,
                    'amount_received' => $amount_received_6_page_14,
                    'amount_balance' => $balance_due_6_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }elseif($j == 7){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_7_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_7_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_7_page_14,
                    'amount_received' => $amount_received_7_page_14,
                    'amount_balance' => $balance_due_7_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }
            elseif($j == 8){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 14)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_14,
                    'claim_status' => $claim_status_page_14,
                    'reason' => $reason_page_14,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_14,
                    'recovered_amount' => $recovered_amount_page_14,
                    'claim_head_default' => $claim_head_default_8_page_14,
                    'claim_amount_due_default' => $claim_amount_due_default_8_page_14,
                    'total_amount_due_default' => $claim_amount_due_default_page_14,
                    'amount_due' => $amount_due_8_page_14,
                    'amount_received' => $amount_received_8_page_14,
                    'amount_balance' => $balance_due_8_page_14,
                    'total_amount_due' => $amount_due_page_14,
                    'total_amount_received' => $amount_received_page_14,
                    'total_amount_balance' => $balance_due_page_14,
                    'amount_received_last' => $amount_received_last_page_14,
                    'total_amount_cheque' => $total_amount_cheque_page_14,
                    'cheque_date' => $cheque_date_page_14,
                    'cheque_no' => $cheque_no_page_14,
                    'bank_name' => $bank_name_page_14,
                    'reason_remarks' => $reason_remarks_page_14
                ]);    
            }
            
            
            
        }

        
    }
}

