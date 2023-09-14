<?php

namespace App\Http\Controllers\Pwwb;

use App\Fields\FirstAnnualDetailFields;
use Illuminate\Routing\Controller;
use App\Fields\FirstSemesterDetailFields;
use App\Fields\FirstSemesterResultStatusDetailFields;
use App\Models\Pwwb\FirstSemesterDetail;
use App\Models\Pwwb\FirstSemesterResultStatusDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pwwb\Claim;

class FirstSemesterDetailController extends Controller
{
    public function post(Request $request)
    {
        $params = $request->all();

        $status = Arr::get($params, FirstSemesterDetailFields::STATUS);

        $degree_date_explode = explode('/',Arr::get($params,FirstSemesterDetailFields::DEGREE_DATE));
        if(count($degree_date_explode) == 3)
            $degree_date = Carbon::createFromDate($degree_date_explode[2],$degree_date_explode[1],$degree_date_explode[0])->format('Y-m-d');
        else
            $degree_date = Arr::get($params, FirstSemesterDetailFields::DEGREE_DATE);

        $exam_status = Arr::get($params, FirstSemesterDetailFields::EXAM_STATUS);
        $roll_no = Arr::get($params, FirstSemesterDetailFields::ROLL_NO);

        $exam_date_explode = explode('/',Arr::get($params,FirstSemesterDetailFields::EXAM_DATE));
        if(count($exam_date_explode) == 3)
            $exam_date = Carbon::createFromDate($exam_date_explode[2],$exam_date_explode[1],$exam_date_explode[0])->format('Y-m-d');
        else
            $exam_date = Arr::get($params, FirstSemesterDetailFields::EXAM_DATE);

        $amount = Arr::get($params, FirstSemesterDetailFields::AMOUNT);
        $readmissionfirst = Arr::get($params, FirstSemesterDetailFields::READMISSIONFIRST);
        $same_course = Arr::get($params, FirstSemesterDetailFields::SAME_COURSE);
        $changed_course = Arr::get($params, FirstSemesterDetailFields::CHANGED_COURSE);

        //Result Status Details
        $result = Arr::get($params,FirstSemesterResultStatusDetailFields::RESULT);
        $fail = Arr::get($params,FirstSemesterResultStatusDetailFields::FAIL);
        $next_appearance = Arr::get($params,FirstSemesterResultStatusDetailFields::NEXT_APPEARANCE);
        $next_appearance_date = Arr::get($params,FirstSemesterResultStatusDetailFields::NEXT_APPEARANCE_DATE);
        $last_chance_date = Arr::get($params,FirstSemesterResultStatusDetailFields::LAST_CHANCE_DATE);
        $passing_date = Arr::get($params,FirstSemesterResultStatusDetailFields::PASSING_DATE);

        $index_id = Arr::get($params, 'index_id');
        if(!$index_id) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }

        $firstSemesterDetail = FirstSemesterDetail::where(FirstSemesterDetailFields::INDEX_TABLE_ID,$index_id)->first();
        if(!$firstSemesterDetail){
            $firstSemesterDetail = new FirstSemesterDetail();
        }

        $firstSemesterDetail->index_table_id = $index_id;
        $firstSemesterDetail->status = $status;
        $firstSemesterDetail->degree_date = $degree_date;
        $firstSemesterDetail->exam_status = $exam_status;
        $firstSemesterDetail->roll_no = $roll_no;
        $firstSemesterDetail->exam_date = $exam_date;
        $firstSemesterDetail->amount = $amount;
        $firstSemesterDetail->readmissionfirst = $readmissionfirst;
        $firstSemesterDetail->same_course = $same_course;
        $firstSemesterDetail->changed_course = $changed_course;
        $firstSemesterDetail->save();

        // Claims Fileds Start
        $page_number = '17';
        $claim_due_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_DUE_PAGE_17);
        $claim_status_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_STATUS_PAGE_17);
        $reason_page_17 = Arr::get($params, FirstSemesterDetailFields::REASON_PAGE_17);
        $outstanding_cfe_fee_page_17 = Arr::get($params, FirstSemesterDetailFields::OUTSTANDING_CFE_FEE_PAGE_17);
        $recovered_amount_page_17 = Arr::get($params, FirstSemesterDetailFields::RECOVERED_AMOUNT_PAGE_17);
        $claim_head_default_1_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_1_PAGE_17);
        $claim_head_default_2_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_2_PAGE_17);
        $claim_head_default_3_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_3_PAGE_17);
        $claim_head_default_4_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_4_PAGE_17);
        $claim_head_default_5_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_5_PAGE_17);
        $claim_head_default_6_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_6_PAGE_17);
        $claim_head_default_7_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_7_PAGE_17);
        $claim_head_default_8_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_HEAD_DEFAULT_8_PAGE_17);
        $claim_amount_due_default_1_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_17);
        $claim_amount_due_default_2_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_17);
        $claim_amount_due_default_3_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_17);
        $claim_amount_due_default_4_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_17);
        $claim_amount_due_default_5_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_17);
        $claim_amount_due_default_6_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_17);
        $claim_amount_due_default_7_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_17);
        $claim_amount_due_default_8_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_17);
        $claim_amount_due_default_page_17 = Arr::get($params, FirstSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_PAGE_17);
        $type_of_claim_1_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_1_PAGE_17);
        $type_of_claim_2_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_2_PAGE_17);
        $type_of_claim_3_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_3_PAGE_17);
        $type_of_claim_4_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_4_PAGE_17);
        $type_of_claim_5_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_5_PAGE_17);
        $type_of_claim_6_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_6_PAGE_17);
        $type_of_claim_7_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_7_PAGE_17);
        $type_of_claim_8_page_17 = Arr::get($params, FirstSemesterDetailFields::TYPE_OF_CLAIM_8_PAGE_17);
        $amount_due_1_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_1_PAGE_17);
        $amount_received_1_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_1_PAGE_17);
        $balance_due_1_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_1_PAGE_17);
        $amount_due_2_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_2_PAGE_17);
        $amount_received_2_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_2_PAGE_17);
        $balance_due_2_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_2_PAGE_17);
        $amount_due_3_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_3_PAGE_17);
        $amount_received_3_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_3_PAGE_17);
        $balance_due_3_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_3_PAGE_17);
        $amount_due_4_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_4_PAGE_17);
        $amount_received_4_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_4_PAGE_17);
        $balance_due_4_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_4_PAGE_17);
        $amount_due_5_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_5_PAGE_17);
        $amount_received_5_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_5_PAGE_17);
        $balance_due_5_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_5_PAGE_17);
        $amount_due_6_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_6_PAGE_17);
        $amount_received_6_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_6_PAGE_17);
        $balance_due_6_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_6_PAGE_17);
        $amount_due_7_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_7_PAGE_17);
        $amount_received_7_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_7_PAGE_17);
        $balance_due_7_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_7_PAGE_17);
        $amount_due_8_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_8_PAGE_17);
        $amount_received_8_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_8_PAGE_17);
        $balance_due_8_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_8_PAGE_17);
        $amount_due_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_DUE_PAGE_17);
        $amount_received_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_PAGE_17);
        $balance_due_page_17 = Arr::get($params, FirstSemesterDetailFields::BALANCE_DUE_PAGE_17);
        $amount_received_last_page_17 = Arr::get($params, FirstSemesterDetailFields::AMOUNT_RECEIVED_LAST_PAGE_17);
        $total_amount_cheque_page_17 = Arr::get($params, FirstSemesterDetailFields::TOTAL_AMOUNT_CHEQUE_PAGE_17);
        $cheque_date_page_17 = Arr::get($params, FirstSemesterDetailFields::CHEQUE_DATE_PAGE_17);
        $cheque_no_page_17 = Arr::get($params, FirstSemesterDetailFields::CHEQUE_NO_PAGE_17);
        $bank_name_page_17 = Arr::get($params, FirstSemesterDetailFields::BANK_NAME_PAGE_17);
        $reason_remarks_page_17 = Arr::get($params, FirstSemesterDetailFields::REASON_REMARKS_PAGE_17);

        


        // $reason = Arr::get($params,FirstSemesterDetailFields::REASON);
        // $cfe_fee = Arr::get($params,FirstSemesterDetailFields::CFE_FEE);
        // $recovery_from_student = Arr::get($params,FirstSemesterDetailFields::RECOVERY_FROM_STUDENT);
        $checkIfClaimExists = Claim::where(FirstSemesterDetailFields::INDEX_TABLE_ID,$index_id)->where('page_number', '=', 17)->first();
        if(!$checkIfClaimExists){
            // Claims Fields End
            $this->claimsStore(
                '1a',
                '1a',
                'claimAdd',
                $page_number,
                $index_id,
                $claim_due_page_17,
                $claim_status_page_17,
                $reason_page_17,
                $outstanding_cfe_fee_page_17,
                $recovered_amount_page_17,
                $claim_head_default_1_page_17,
                $claim_head_default_2_page_17,
                $claim_head_default_3_page_17,
                $claim_head_default_4_page_17,
                $claim_head_default_5_page_17,
                $claim_head_default_6_page_17,
                $claim_head_default_7_page_17,
                $claim_head_default_8_page_17,
                $claim_amount_due_default_1_page_17,
                $claim_amount_due_default_2_page_17,
                $claim_amount_due_default_3_page_17,
                $claim_amount_due_default_4_page_17,
                $claim_amount_due_default_5_page_17,
                $claim_amount_due_default_6_page_17,
                $claim_amount_due_default_7_page_17,
                $claim_amount_due_default_8_page_17,
                $claim_amount_due_default_page_17,
                $type_of_claim_1_page_17,
                $type_of_claim_2_page_17,
                $type_of_claim_3_page_17,
                $type_of_claim_4_page_17,
                $type_of_claim_5_page_17,
                $type_of_claim_6_page_17,
                $type_of_claim_7_page_17,
                $type_of_claim_8_page_17,
                $amount_due_1_page_17,
                $amount_received_1_page_17,
                $balance_due_1_page_17,
                $amount_due_2_page_17,
                $amount_received_2_page_17,
                $balance_due_2_page_17,
                $amount_due_3_page_17,
                $amount_received_3_page_17,
                $balance_due_3_page_17,
                $amount_due_4_page_17,
                $amount_received_4_page_17,
                $balance_due_4_page_17,
                $amount_due_5_page_17,
                $amount_received_5_page_17,
                $balance_due_5_page_17,
                $amount_due_6_page_17,
                $amount_received_6_page_17,
                $balance_due_6_page_17,
                $amount_due_7_page_17,
                $amount_received_7_page_17,
                $balance_due_7_page_17,
                $amount_due_8_page_17,
                $amount_received_8_page_17,
                $balance_due_8_page_17,
                $amount_due_page_17,
                $amount_received_page_17,
                $balance_due_page_17,
                $amount_received_last_page_17,
                $total_amount_cheque_page_17,
                $cheque_date_page_17,
                $cheque_no_page_17,
                $bank_name_page_17,
                $reason_remarks_page_17
            );
        }
        else{
            $claimindex_id = Claim::where(FirstSemesterDetailFields::INDEX_TABLE_ID, '=', $index_id)->where('page_number', 17)->get();
            // dd($claimindex_id, $claimindex_id[2]->id);
            // foreach($claimindex_id as $key => &$val){
            $j = 1;
            foreach($claimindex_id as $val){
                // if($val->inde_table_id == $indexTableI){
                    
                     $this->claimsStore(
                        $j++,
                        $val['id'],
                        'claimEdit',
                        $page_number,
                        $index_id,
                        $claim_due_page_17,
                        $claim_status_page_17,
                        $reason_page_17,
                        $outstanding_cfe_fee_page_17,
                $recovered_amount_page_17,
                        $claim_head_default_1_page_17,
                        $claim_head_default_2_page_17,
                        $claim_head_default_3_page_17,
                        $claim_head_default_4_page_17,
                        $claim_head_default_5_page_17,
                        $claim_head_default_6_page_17,
                        $claim_head_default_7_page_17,
                        $claim_head_default_8_page_17,
                        $claim_amount_due_default_1_page_17,
                        $claim_amount_due_default_2_page_17,
                        $claim_amount_due_default_3_page_17,
                        $claim_amount_due_default_4_page_17,
                        $claim_amount_due_default_5_page_17,
                        $claim_amount_due_default_6_page_17,
                        $claim_amount_due_default_7_page_17,
                        $claim_amount_due_default_8_page_17,
                        $claim_amount_due_default_page_17,
                        $type_of_claim_1_page_17,
                        $type_of_claim_2_page_17,
                        $type_of_claim_3_page_17,
                        $type_of_claim_4_page_17,
                        $type_of_claim_5_page_17,
                        $type_of_claim_6_page_17,
                        $type_of_claim_7_page_17,
                        $type_of_claim_8_page_17,
                        $amount_due_1_page_17,
                        $amount_received_1_page_17,
                        $balance_due_1_page_17,
                        $amount_due_2_page_17,
                        $amount_received_2_page_17,
                        $balance_due_2_page_17,
                        $amount_due_3_page_17,
                        $amount_received_3_page_17,
                        $balance_due_3_page_17,
                        $amount_due_4_page_17,
                        $amount_received_4_page_17,
                        $balance_due_4_page_17,
                        $amount_due_5_page_17,
                        $amount_received_5_page_17,
                        $balance_due_5_page_17,
                        $amount_due_6_page_17,
                        $amount_received_6_page_17,
                        $balance_due_6_page_17,
                        $amount_due_7_page_17,
                        $amount_received_7_page_17,
                        $balance_due_7_page_17,
                        $amount_due_8_page_17,
                        $amount_received_8_page_17,
                        $balance_due_8_page_17,
                        $amount_due_page_17,
                        $amount_received_page_17,
                        $balance_due_page_17,
                        $amount_received_last_page_17,
                        $total_amount_cheque_page_17,
                        $cheque_date_page_17,
                        $cheque_no_page_17,
                        $bank_name_page_17,
                        $reason_remarks_page_17
                    );


             // }
            }
        }


        if (!$index_id) {
            for ($i = 0; $i < count($result); $i++) {
                $firstSemesterResultStatusDetail = new FirstSemesterResultStatusDetail();
                $this->fillFirstSemesterResultStatusDetailData($i, $firstSemesterResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
            }
        } else {
            $j = 0;
            foreach (FirstSemesterResultStatusDetail::where('index_table_id', $index_id)->get() as $firstSemesterResultStatusDetail) {
                $firstSemesterResultStatusDetailSingle = FirstSemesterResultStatusDetail::find($firstSemesterResultStatusDetail->id);
                $this->fillFirstSemesterResultStatusDetailData($j, $firstSemesterResultStatusDetailSingle, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                $j++;
            }
            if ($j < count($result)) {
                for ($k = $j; $k < count($result); $k++) {
                    $firstSemesterResultStatusDetail = new FirstSemesterResultStatusDetail();
                    $this->fillFirstSemesterResultStatusDetailData($k, $firstSemesterResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
        ], 200);
    }

    private function fillFirstSemesterResultStatusDetailData($index,$firstSemesterResultStatusDetailObject,$index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date){
        $firstSemesterResultStatusDetailObject->index_table_id = $index_id;
        $firstSemesterResultStatusDetailObject->result = isset($result[$index]) ? $result[$index] : null;
        $firstSemesterResultStatusDetailObject->fail = isset($fail[$index]) ? $fail[$index] : null;
        $firstSemesterResultStatusDetailObject->next_appearance = isset($next_appearance[$index]) ? $next_appearance[$index] : null;
        $NextAppearance = null;
        if(isset($next_appearance_date[$index])){
            $NextAppearanceExplode = explode('/',$next_appearance_date[$index]);
            if(count($NextAppearanceExplode) == 3)
                $NextAppearance = Carbon::createFromDate($NextAppearanceExplode[2],$NextAppearanceExplode[1],$NextAppearanceExplode[0])->format('Y-m-d');
            else
                $NextAppearance = $next_appearance_date[$index];
        }
        $firstSemesterResultStatusDetailObject->next_appearance_date = $NextAppearance;

        $LastChance = null;
        if(isset($last_chance_date[$index])){
            $LastChanceExplode = explode('/',$last_chance_date[$index]);
            if(count($LastChanceExplode) == 3)
                $LastChance = Carbon::createFromDate($LastChanceExplode[2],$LastChanceExplode[1],$LastChanceExplode[0])->format('Y-m-d');
            else
                $LastChance = $last_chance_date[$index];
        }
        $firstSemesterResultStatusDetailObject->last_chance_date = $LastChance;

         $Passing = null;
        if(isset($passing_date[$index])){
            $PassingExplode = explode('/',$passing_date[$index]);
            if(count($PassingExplode) == 3)
                $Passing = Carbon::createFromDate($PassingExplode[2],$PassingExplode[1],$PassingExplode[0])->format('Y-m-d');
            else
                $Passing = $passing_date[$index];
        }
        $firstSemesterResultStatusDetailObject->passing_date = $Passing;
        $firstSemesterResultStatusDetailObject->save();
    }

    public function deleteFirstSemesterResultStatusDetail(Request $request){
        $params = $request->all();
        $id = Arr::get($params,FirstSemesterResultStatusDetailFields::ID);
        $indexId = Arr::get($params,'index_id');
        $object = FirstSemesterResultStatusDetail::where('id',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    public function claimsStore($j,$indexes,$claim,$page_number,
                $index_id,
                $claim_due_page_17,
                $claim_status_page_17,
                $reason_page_17,
                $outstanding_cfe_fee_page_17,
                $recovered_amount_page_17,
                $claim_head_default_1_page_17,
                $claim_head_default_2_page_17,
                $claim_head_default_3_page_17,
                $claim_head_default_4_page_17,
                $claim_head_default_5_page_17,
                $claim_head_default_6_page_17,
                $claim_head_default_7_page_17,
                $claim_head_default_8_page_17,
                $claim_amount_due_default_1_page_17,
                $claim_amount_due_default_2_page_17,
                $claim_amount_due_default_3_page_17,
                $claim_amount_due_default_4_page_17,
                $claim_amount_due_default_5_page_17,
                $claim_amount_due_default_6_page_17,
                $claim_amount_due_default_7_page_17,
                $claim_amount_due_default_8_page_17,
                $claim_amount_due_default_page_17,
                $type_of_claim_1_page_17,
                $type_of_claim_2_page_17,
                $type_of_claim_3_page_17,
                $type_of_claim_4_page_17,
                $type_of_claim_5_page_17,
                $type_of_claim_6_page_17,
                $type_of_claim_7_page_17,
                $type_of_claim_8_page_17,
                $amount_due_1_page_17,
                $amount_received_1_page_17,
                $balance_due_1_page_17,
                $amount_due_2_page_17,
                $amount_received_2_page_17,
                $balance_due_2_page_17,
                $amount_due_3_page_17,
                $amount_received_3_page_17,
                $balance_due_3_page_17,
                $amount_due_4_page_17,
                $amount_received_4_page_17,
                $balance_due_4_page_17,
                $amount_due_5_page_17,
                $amount_received_5_page_17,
                $balance_due_5_page_17,
                $amount_due_6_page_17,
                $amount_received_6_page_17,
                $balance_due_6_page_17,
                $amount_due_7_page_17,
                $amount_received_7_page_17,
                $balance_due_7_page_17,
                $amount_due_8_page_17,
                $amount_received_8_page_17,
                $balance_due_8_page_17,
                $amount_due_page_17,
                $amount_received_page_17,
                $balance_due_page_17,
                $amount_received_last_page_17,
                $total_amount_cheque_page_17,
                $cheque_date_page_17,
                $cheque_no_page_17,
                $bank_name_page_17,
                $reason_remarks_page_17){
        $index_id = request('index_id');
        if($indexes == '1a') {
            for($i = 1; $i<= 8; $i++){           
                if($i ==1){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 1;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_1_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_1_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_1_page_17;
                    $claimTable->amount_due = $amount_due_1_page_17;
                    $claimTable->amount_received = $amount_received_1_page_17;
                    $claimTable->amount_balance = $balance_due_1_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;

                    $claimTable->save();
                }
                elseif($i ==2){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 2;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_2_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_2_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_2_page_17;
                    $claimTable->amount_due = $amount_due_2_page_17;
                    $claimTable->amount_received = $amount_received_2_page_17;
                    $claimTable->amount_balance = $balance_due_2_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
                elseif($i ==3){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 3;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_3_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_3_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_3_page_17;
                    $claimTable->amount_due = $amount_due_3_page_17;
                    $claimTable->amount_received = $amount_received_3_page_17;
                    $claimTable->amount_balance = $balance_due_3_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
                elseif($i ==4){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 4;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_4_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_4_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_4_page_17;
                    $claimTable->amount_due = $amount_due_4_page_17;
                    $claimTable->amount_received = $amount_received_4_page_17;
                    $claimTable->amount_balance = $balance_due_4_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
                elseif($i ==5){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 5;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_5_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_5_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_5_page_17;
                    $claimTable->amount_due = $amount_due_5_page_17;
                    $claimTable->amount_received = $amount_received_5_page_17;
                    $claimTable->amount_balance = $balance_due_5_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
                elseif($i ==6){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 6;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_6_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_6_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_6_page_17;
                    $claimTable->amount_due = $amount_due_6_page_17;
                    $claimTable->amount_received = $amount_received_6_page_17;
                    $claimTable->amount_balance = $balance_due_6_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
                elseif($i ==7){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 7;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_7_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_7_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_7_page_17;
                    $claimTable->amount_due = $amount_due_7_page_17;
                    $claimTable->amount_received = $amount_received_7_page_17;
                    $claimTable->amount_balance = $balance_due_7_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
                elseif($i ==8){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 8;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_17;
                    $claimTable->claim_status = $claim_status_page_17;
                    $claimTable->reason = $reason_page_17;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_17;
                    $claimTable->recovered_amount = $recovered_amount_page_17;
                     $claimTable->claim_head_default = $claim_head_default_8_page_17;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_8_page_17;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_17;
                    $claimTable->claim_head = $type_of_claim_8_page_17;
                    $claimTable->amount_due = $amount_due_8_page_17;
                    $claimTable->amount_received = $amount_received_8_page_17;
                    $claimTable->amount_balance = $balance_due_8_page_17;        
                    $claimTable->total_amount_due = $amount_due_page_17;
                    $claimTable->total_amount_received = $amount_received_page_17;
                    $claimTable->total_amount_balance = $balance_due_page_17;
                    $claimTable->amount_received_last = $amount_received_last_page_17;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_17;
                    $claimTable->cheque_date = $cheque_date_page_17;
                    $claimTable->cheque_no = $cheque_no_page_17;
                    $claimTable->bank_name = $bank_name_page_17;
                    $claimTable->reason_remarks = $reason_remarks_page_17;
                    $claimTable->save();
                }
            }
        }else{           
            if($j == 1){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_1_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_1_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_1_page_17,
                    'amount_received' => $amount_received_1_page_17,
                    'amount_balance' => $balance_due_1_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }elseif($j == 2){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_2_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_2_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_2_page_17,
                    'amount_received' => $amount_received_2_page_17,
                    'amount_balance' => $balance_due_2_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }elseif($j == 3){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_3_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_3_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_3_page_17,
                    'amount_received' => $amount_received_3_page_17,
                    'amount_balance' => $balance_due_3_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }elseif($j == 4){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_4_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_4_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_4_page_17,
                    'amount_received' => $amount_received_4_page_17,
                    'amount_balance' => $balance_due_4_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }elseif($j == 5){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_5_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_5_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_5_page_17,
                    'amount_received' => $amount_received_5_page_17,
                    'amount_balance' => $balance_due_5_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }elseif($j == 6){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_6_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_6_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_6_page_17,
                    'amount_received' => $amount_received_6_page_17,
                    'amount_balance' => $balance_due_6_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }elseif($j == 7){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_7_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_7_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_7_page_17,
                    'amount_received' => $amount_received_7_page_17,
                    'amount_balance' => $balance_due_7_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }
            elseif($j == 8){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 17)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_17,
                    'claim_status' => $claim_status_page_17,
                    'reason' => $reason_page_17,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_17,
                    'recovered_amount' => $recovered_amount_page_17,
                    'claim_head_default' => $claim_head_default_8_page_17,
                    'claim_amount_due_default' => $claim_amount_due_default_8_page_17,
                    'total_amount_due_default' => $claim_amount_due_default_page_17,
                    'amount_due' => $amount_due_8_page_17,
                    'amount_received' => $amount_received_8_page_17,
                    'amount_balance' => $balance_due_8_page_17,
                    'total_amount_due' => $amount_due_page_17,
                    'total_amount_received' => $amount_received_page_17,
                    'total_amount_balance' => $balance_due_page_17,
                    'amount_received_last' => $amount_received_last_page_17,
                    'total_amount_cheque' => $total_amount_cheque_page_17,
                    'cheque_date' => $cheque_date_page_17,
                    'cheque_no' => $cheque_no_page_17,
                    'bank_name' => $bank_name_page_17,
                    'reason_remarks' => $reason_remarks_page_17,
                ]);    
            }
            
        }

        
    }
}
