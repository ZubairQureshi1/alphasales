<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\FirstAnnualDetailFields;
use App\Fields\FirstAnnualResultStatusDetailFields;
use App\Models\Pwwb\FirstAnnualDetail;
use App\Models\Pwwb\FirstAnnualResultStatusDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pwwb\Claim;

class FirstAnnualDetailController extends Controller
{
    public function post(Request $request)
    {
        $params = $request->all();

        $fee_deposit_status = Arr::get($params, FirstAnnualDetailFields::FEE_DEPOSIT_STATUS);

        $exam_fee_date_explode = explode('/',Arr::get($params,FirstAnnualDetailFields::EXAM_FEE_DATE));
        if(count($exam_fee_date_explode) == 3)
            $exam_fee_date = Carbon::createFromDate($exam_fee_date_explode[2],$exam_fee_date_explode[1],$exam_fee_date_explode[0])->format('Y-m-d');
        else
            $exam_fee_date = Arr::get($params, FirstAnnualDetailFields::EXAM_FEE_DATE);

        $amount = Arr::get($params, FirstAnnualDetailFields::AMOUNT);
        $roll_no = Arr::get($params, FirstAnnualDetailFields::ROLL_NO);
        $readmission = Arr::get($params, FirstAnnualDetailFields::READMISSION);
        $same_course = Arr::get($params, FirstAnnualDetailFields::SAME_COURSE);
        $changed_course = Arr::get($params, FirstAnnualDetailFields::CHANGED_COURSE);

        //Result Status Details
        $result = Arr::get($params,FirstAnnualResultStatusDetailFields::RESULT);
        $fail = Arr::get($params,FirstAnnualResultStatusDetailFields::FAIL);
        $next_appearance = Arr::get($params,FirstAnnualResultStatusDetailFields::NEXT_APPEARANCE);
        $next_appearance_date = Arr::get($params,FirstAnnualResultStatusDetailFields::NEXT_APPEARANCE_DATE);
        $last_chance_date = Arr::get($params,FirstAnnualResultStatusDetailFields::LAST_CHANCE_DATE);
        $passing_date = Arr::get($params,FirstAnnualResultStatusDetailFields::PASSING_DATE);

        $index_id = Arr::get($params, 'index_id');
        if(!$index_id) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }

        $firstAnnualDetail = FirstAnnualDetail::where(FirstAnnualDetailFields::INDEX_TABLE_ID,$index_id)->first();
        if(!$firstAnnualDetail){
            $firstAnnualDetail = new FirstAnnualDetail();
        }

        $firstAnnualDetail->index_table_id = $index_id;
        $firstAnnualDetail->fee_deposit_status = $fee_deposit_status;
        $firstAnnualDetail->exam_fee_date = $exam_fee_date;
        $firstAnnualDetail->amount = $amount;
        $firstAnnualDetail->roll_no = $roll_no;
        $firstAnnualDetail->readmission = $readmission;
        $firstAnnualDetail->same_course = $same_course;
        $firstAnnualDetail->changed_course = $changed_course;
        $firstAnnualDetail->save();


        // Claims Fileds Start
        $page_number = '15';
        $claim_due_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_DUE_PAGE_15);
        $claim_status_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_STATUS_PAGE_15);
        $reason_page_15 = Arr::get($params, FirstAnnualDetailFields::REASON_PAGE_15);
        $outstanding_cfe_fee_page_15 = Arr::get($params, FirstAnnualDetailFields::OUTSTANDING_CFE_FEE_PAGE_15);
        $recovered_amount_page_15 = Arr::get($params, FirstAnnualDetailFields::RECOVERED_AMOUNT_PAGE_15);
        $claim_head_default_1_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_1_PAGE_15);
        $claim_head_default_2_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_2_PAGE_15);
        $claim_head_default_3_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_3_PAGE_15);
        $claim_head_default_4_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_4_PAGE_15);
        $claim_head_default_5_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_5_PAGE_15);
        $claim_head_default_6_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_6_PAGE_15);
        $claim_head_default_7_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_7_PAGE_15);
        $claim_head_default_8_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_HEAD_DEFAULT_8_PAGE_15);
        $claim_amount_due_default_1_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_15);
        $claim_amount_due_default_2_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_15);
        $claim_amount_due_default_3_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_15);
        $claim_amount_due_default_4_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_15);
        $claim_amount_due_default_5_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_15);
        $claim_amount_due_default_6_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_15);
        $claim_amount_due_default_7_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_15);
        $claim_amount_due_default_8_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_15);
        $claim_amount_due_default_page_15 = Arr::get($params, FirstAnnualDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_PAGE_15);
        $type_of_claim_1_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_1_PAGE_15);
        $type_of_claim_2_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_2_PAGE_15);
        $type_of_claim_3_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_3_PAGE_15);
        $type_of_claim_4_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_4_PAGE_15);
        $type_of_claim_5_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_5_PAGE_15);
        $type_of_claim_6_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_6_PAGE_15);
        $type_of_claim_7_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_7_PAGE_15);
        $type_of_claim_8_page_15 = Arr::get($params, FirstAnnualDetailFields::TYPE_OF_CLAIM_8_PAGE_15);
        $amount_due_1_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_1_PAGE_15);
        $amount_received_1_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_1_PAGE_15);
        $balance_due_1_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_1_PAGE_15);
        $amount_due_2_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_2_PAGE_15);
        $amount_received_2_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_2_PAGE_15);
        $balance_due_2_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_2_PAGE_15);
        $amount_due_3_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_3_PAGE_15);
        $amount_received_3_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_3_PAGE_15);
        $balance_due_3_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_3_PAGE_15);
        $amount_due_4_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_4_PAGE_15);
        $amount_received_4_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_4_PAGE_15);
        $balance_due_4_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_4_PAGE_15);
        $amount_due_5_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_5_PAGE_15);
        $amount_received_5_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_5_PAGE_15);
        $balance_due_5_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_5_PAGE_15);
        $amount_due_6_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_6_PAGE_15);
        $amount_received_6_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_6_PAGE_15);
        $balance_due_6_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_6_PAGE_15);
        $amount_due_7_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_7_PAGE_15);
        $amount_received_7_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_7_PAGE_15);
        $balance_due_7_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_7_PAGE_15);
        $amount_due_8_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_8_PAGE_15);
        $amount_received_8_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_8_PAGE_15);
        $balance_due_8_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_8_PAGE_15);
        $amount_due_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_DUE_PAGE_15);
        $amount_received_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_PAGE_15);
        $balance_due_page_15 = Arr::get($params, FirstAnnualDetailFields::BALANCE_DUE_PAGE_15);
        $amount_received_last_page_15 = Arr::get($params, FirstAnnualDetailFields::AMOUNT_RECEIVED_LAST_PAGE_15);
        $total_amount_cheque_page_15 = Arr::get($params, FirstAnnualDetailFields::TOTAL_AMOUNT_CHEQUE_PAGE_15);
        $cheque_date_page_15 = Arr::get($params, FirstAnnualDetailFields::CHEQUE_DATE_PAGE_15);
        $cheque_no_page_15 = Arr::get($params, FirstAnnualDetailFields::CHEQUE_NO_PAGE_15);
        $bank_name_page_15 = Arr::get($params, FirstAnnualDetailFields::BANK_NAME_PAGE_15);
        $reason_remarks_page_15 = Arr::get($params, FirstAnnualDetailFields::REASON_REMARKS_PAGE_15);

        


        // $reason = Arr::get($params,FirstAnnualDetailFields::REASON);
        // $cfe_fee = Arr::get($params,FirstAnnualDetailFields::CFE_FEE);
        // $recovery_from_student = Arr::get($params,FirstAnnualDetailFields::RECOVERY_FROM_STUDENT);
        $checkIfClaimExists = Claim::where(FirstAnnualDetailFields::INDEX_TABLE_ID,$index_id)->where('page_number', '=', 15)->first();
        if(!$checkIfClaimExists){
            // Claims Fields End
            $this->claimsStore(
                '1a',
                '1a',
                'claimAdd',
                $page_number,
                $index_id,
                $claim_due_page_15,
                $claim_status_page_15,
                $reason_page_15,
                $outstanding_cfe_fee_page_15,
                $recovered_amount_page_15,
                $claim_head_default_1_page_15,
                $claim_head_default_2_page_15,
                $claim_head_default_3_page_15,
                $claim_head_default_4_page_15,
                $claim_head_default_5_page_15,
                $claim_head_default_6_page_15,
                $claim_head_default_7_page_15,
                $claim_head_default_8_page_15,
                $claim_amount_due_default_1_page_15,
                $claim_amount_due_default_2_page_15,
                $claim_amount_due_default_3_page_15,
                $claim_amount_due_default_4_page_15,
                $claim_amount_due_default_5_page_15,
                $claim_amount_due_default_6_page_15,
                $claim_amount_due_default_7_page_15,
                $claim_amount_due_default_8_page_15,
                $claim_amount_due_default_page_15,
                $type_of_claim_1_page_15,
                $type_of_claim_2_page_15,
                $type_of_claim_3_page_15,
                $type_of_claim_4_page_15,
                $type_of_claim_5_page_15,
                $type_of_claim_6_page_15,
                $type_of_claim_7_page_15,
                $type_of_claim_8_page_15,
                $amount_due_1_page_15,
                $amount_received_1_page_15,
                $balance_due_1_page_15,
                $amount_due_2_page_15,
                $amount_received_2_page_15,
                $balance_due_2_page_15,
                $amount_due_3_page_15,
                $amount_received_3_page_15,
                $balance_due_3_page_15,
                $amount_due_4_page_15,
                $amount_received_4_page_15,
                $balance_due_4_page_15,
                $amount_due_5_page_15,
                $amount_received_5_page_15,
                $balance_due_5_page_15,
                $amount_due_6_page_15,
                $amount_received_6_page_15,
                $balance_due_6_page_15,
                $amount_due_7_page_15,
                $amount_received_7_page_15,
                $balance_due_7_page_15,
                $amount_due_8_page_15,
                $amount_received_8_page_15,
                $balance_due_8_page_15,
                $amount_due_page_15,
                $amount_received_page_15,
                $balance_due_page_15,
                $amount_received_last_page_15,
                $total_amount_cheque_page_15,
                $cheque_date_page_15,
                $cheque_no_page_15,
                $bank_name_page_15,
                $reason_remarks_page_15
            );
        }
        else{
            $claimindex_id = Claim::where(FirstAnnualDetailFields::INDEX_TABLE_ID, '=', $index_id)->where('page_number', 15)->get();
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
                        $claim_due_page_15,
                        $claim_status_page_15,
                        $reason_page_15,
                        $outstanding_cfe_fee_page_15,
                $recovered_amount_page_15,
                        $claim_head_default_1_page_15,
                        $claim_head_default_2_page_15,
                        $claim_head_default_3_page_15,
                        $claim_head_default_4_page_15,
                        $claim_head_default_5_page_15,
                        $claim_head_default_6_page_15,
                        $claim_head_default_7_page_15,
                        $claim_head_default_8_page_15,
                        $claim_amount_due_default_1_page_15,
                        $claim_amount_due_default_2_page_15,
                        $claim_amount_due_default_3_page_15,
                        $claim_amount_due_default_4_page_15,
                        $claim_amount_due_default_5_page_15,
                        $claim_amount_due_default_6_page_15,
                        $claim_amount_due_default_7_page_15,
                        $claim_amount_due_default_8_page_15,
                        $claim_amount_due_default_page_15,
                        $type_of_claim_1_page_15,
                        $type_of_claim_2_page_15,
                        $type_of_claim_3_page_15,
                        $type_of_claim_4_page_15,
                        $type_of_claim_5_page_15,
                        $type_of_claim_6_page_15,
                        $type_of_claim_7_page_15,
                        $type_of_claim_8_page_15,
                        $amount_due_1_page_15,
                        $amount_received_1_page_15,
                        $balance_due_1_page_15,
                        $amount_due_2_page_15,
                        $amount_received_2_page_15,
                        $balance_due_2_page_15,
                        $amount_due_3_page_15,
                        $amount_received_3_page_15,
                        $balance_due_3_page_15,
                        $amount_due_4_page_15,
                        $amount_received_4_page_15,
                        $balance_due_4_page_15,
                        $amount_due_5_page_15,
                        $amount_received_5_page_15,
                        $balance_due_5_page_15,
                        $amount_due_6_page_15,
                        $amount_received_6_page_15,
                        $balance_due_6_page_15,
                        $amount_due_7_page_15,
                        $amount_received_7_page_15,
                        $balance_due_7_page_15,
                        $amount_due_8_page_15,
                        $amount_received_8_page_15,
                        $balance_due_8_page_15,
                        $amount_due_page_15,
                        $amount_received_page_15,
                        $balance_due_page_15,
                        $amount_received_last_page_15,
                        $total_amount_cheque_page_15,
                        $cheque_date_page_15,
                        $cheque_no_page_15,
                        $bank_name_page_15,
                        $reason_remarks_page_15
                    );


             // }
            }
        }

        if (!$index_id) {
            for ($i = 0; $i < count($result); $i++) {
                $firstAnnualResultStatusDetail = new FirstAnnualResultStatusDetail();
                $this->fillFirstAnnualResultStatusDetailData($i, $firstAnnualResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
            }
        } else {
            $j = 0;
            foreach (FirstAnnualResultStatusDetail::where('index_table_id', $index_id)->get() as $firstAnnualResultStatusDetail) {
                $firstAnnualResultStatusDetailSingle = FirstAnnualResultStatusDetail::find($firstAnnualResultStatusDetail->id);
                $this->fillFirstAnnualResultStatusDetailData($j, $firstAnnualResultStatusDetailSingle, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                $j++;
            }
            if ($result != null && $j < count($result)) {
                for ($k = $j; $k < count($result); $k++) {
                    $firstAnnualResultStatusDetail = new FirstAnnualResultStatusDetail();
                    $this->fillFirstAnnualResultStatusDetailData($k, $firstAnnualResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
        ], 200);
    }

    private function fillFirstAnnualResultStatusDetailData($index,$firstAnnualResultStatusDetailObject,$index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date){
        $firstAnnualResultStatusDetailObject->index_table_id = $index_id;
        $firstAnnualResultStatusDetailObject->result = isset($result[$index]) ? $result[$index] : null;
        $firstAnnualResultStatusDetailObject->fail = isset($fail[$index]) ? $fail[$index] : null;
        $firstAnnualResultStatusDetailObject->next_appearance = isset($next_appearance[$index]) ? $next_appearance[$index] : null;

        $NextAppearance = null;
        if(isset($next_appearance_date[$index])){
            $NextAppearanceExplode = explode('/',$next_appearance_date[$index]);
            if(count($NextAppearanceExplode) == 3)
                $NextAppearance = Carbon::createFromDate($NextAppearanceExplode[2],$NextAppearanceExplode[1],$NextAppearanceExplode[0])->format('Y-m-d');
            else
                $NextAppearance = $next_appearance_date[$index];
        }
        $firstAnnualResultStatusDetailObject->next_appearance_date = $NextAppearance;

        $LastChance = null;
        if(isset($last_chance_date[$index])){
            $LastChanceExplode = explode('/',$last_chance_date[$index]);
            if(count($LastChanceExplode) == 3)
                $LastChance = Carbon::createFromDate($LastChanceExplode[2],$LastChanceExplode[1],$LastChanceExplode[0])->format('Y-m-d');
            else
                $LastChance = $last_chance_date[$index];
        }
        $firstAnnualResultStatusDetailObject->last_chance_date = $LastChance;

         $Passing = null;
        if(isset($passing_date[$index])){
            $PassingExplode = explode('/',$passing_date[$index]);
            if(count($PassingExplode) == 3)
                $Passing = Carbon::createFromDate($PassingExplode[2],$PassingExplode[1],$PassingExplode[0])->format('Y-m-d');
            else
                $Passing = $passing_date[$index];
        }
        $firstAnnualResultStatusDetailObject->passing_date = $Passing;
        $firstAnnualResultStatusDetailObject->save();
    }

    public function deleteFirstAnnualResultStatusDetail(Request $request){
        $params = $request->all();
        $id = Arr::get($params,FirstAnnualResultStatusDetailFields::ID);
        $indexId = Arr::get($params,'index_id');
        $object = FirstAnnualResultStatusDetail::where('id',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    public function claimsStore($j,$indexes,$claim,$page_number,
                        $index_id,
                        $claim_due_page_15,
                        $claim_status_page_15,
                        $reason_page_15,
                        $outstanding_cfe_fee_page_15,
                $recovered_amount_page_15,
                        $claim_head_default_1_page_15,
                        $claim_head_default_2_page_15,
                        $claim_head_default_3_page_15,
                        $claim_head_default_4_page_15,
                        $claim_head_default_5_page_15,
                        $claim_head_default_6_page_15,
                        $claim_head_default_7_page_15,
                        $claim_head_default_8_page_15,
                        $claim_amount_due_default_1_page_15,
                        $claim_amount_due_default_2_page_15,
                        $claim_amount_due_default_3_page_15,
                        $claim_amount_due_default_4_page_15,
                        $claim_amount_due_default_5_page_15,
                        $claim_amount_due_default_6_page_15,
                        $claim_amount_due_default_7_page_15,
                        $claim_amount_due_default_8_page_15,
                        $claim_amount_due_default_page_15,
                        $type_of_claim_1_page_15,
                        $type_of_claim_2_page_15,
                        $type_of_claim_3_page_15,
                        $type_of_claim_4_page_15,
                        $type_of_claim_5_page_15,
                        $type_of_claim_6_page_15,
                        $type_of_claim_7_page_15,
                        $type_of_claim_8_page_15,
                        $amount_due_1_page_15,
                        $amount_received_1_page_15,
                        $balance_due_1_page_15,
                        $amount_due_2_page_15,
                        $amount_received_2_page_15,
                        $balance_due_2_page_15,
                        $amount_due_3_page_15,
                        $amount_received_3_page_15,
                        $balance_due_3_page_15,
                        $amount_due_4_page_15,
                        $amount_received_4_page_15,
                        $balance_due_4_page_15,
                        $amount_due_5_page_15,
                        $amount_received_5_page_15,
                        $balance_due_5_page_15,
                        $amount_due_6_page_15,
                        $amount_received_6_page_15,
                        $balance_due_6_page_15,
                        $amount_due_7_page_15,
                        $amount_received_7_page_15,
                        $balance_due_7_page_15,
                        $amount_due_8_page_15,
                        $amount_received_8_page_15,
                        $balance_due_8_page_15,
                        $amount_due_page_15,
                        $amount_received_page_15,
                        $balance_due_page_15,
                        $amount_received_last_page_15,
                        $total_amount_cheque_page_15,
                        $cheque_date_page_15,
                        $cheque_no_page_15,
                        $bank_name_page_15,
                        $reason_remarks_page_15){
        $index_id = request('index_id');
        if($indexes == '1a') {
            for($i = 1; $i<= 8; $i++){           
                if($i == 1){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 1;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_1_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_1_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_1_page_15;
                    $claimTable->amount_due = $amount_due_1_page_15;
                    $claimTable->amount_received = $amount_received_1_page_15;
                    $claimTable->amount_balance = $balance_due_1_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;

                    $claimTable->save();
                }
                elseif($i ==2){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 2;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_2_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_2_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_2_page_15;
                    $claimTable->amount_due = $amount_due_2_page_15;
                    $claimTable->amount_received = $amount_received_2_page_15;
                    $claimTable->amount_balance = $balance_due_2_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
                elseif($i ==3){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 3;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_3_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_3_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_3_page_15;
                    $claimTable->amount_due = $amount_due_3_page_15;
                    $claimTable->amount_received = $amount_received_3_page_15;
                    $claimTable->amount_balance = $balance_due_3_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
                elseif($i ==4){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 4;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_4_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_4_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_4_page_15;
                    $claimTable->amount_due = $amount_due_4_page_15;
                    $claimTable->amount_received = $amount_received_4_page_15;
                    $claimTable->amount_balance = $balance_due_4_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
                elseif($i ==5){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 5;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_5_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_5_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_5_page_15;
                    $claimTable->amount_due = $amount_due_5_page_15;
                    $claimTable->amount_received = $amount_received_5_page_15;
                    $claimTable->amount_balance = $balance_due_5_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
                elseif($i ==6){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 6;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_6_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_6_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_6_page_15;
                    $claimTable->amount_due = $amount_due_6_page_15;
                    $claimTable->amount_received = $amount_received_6_page_15;
                    $claimTable->amount_balance = $balance_due_6_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
                elseif($i ==7){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 7;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_7_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_7_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_7_page_15;
                    $claimTable->amount_due = $amount_due_7_page_15;
                    $claimTable->amount_received = $amount_received_7_page_15;
                    $claimTable->amount_balance = $balance_due_7_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
                elseif($i ==8){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 8;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_15;
                    $claimTable->claim_status = $claim_status_page_15;
                    $claimTable->reason = $reason_page_15;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_15;
                    $claimTable->recovered_amount = $recovered_amount_page_15;
                    $claimTable->claim_head_default = $claim_head_default_8_page_15;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_8_page_15;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_15;
                    $claimTable->claim_head = $type_of_claim_8_page_15;
                    $claimTable->amount_due = $amount_due_8_page_15;
                    $claimTable->amount_received = $amount_received_8_page_15;
                    $claimTable->amount_balance = $balance_due_8_page_15;        
                    $claimTable->total_amount_due = $amount_due_page_15;
                    $claimTable->total_amount_received = $amount_received_page_15;
                    $claimTable->total_amount_balance = $balance_due_page_15;
                    $claimTable->amount_received_last = $amount_received_last_page_15;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_15;
                    $claimTable->cheque_date = $cheque_date_page_15;
                    $claimTable->cheque_no = $cheque_no_page_15;
                    $claimTable->bank_name = $bank_name_page_15;
                    $claimTable->reason_remarks = $reason_remarks_page_15;
                    $claimTable->save();
                }
            }
        }else{           
            if($j == 1){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_1_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_1_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_1_page_15,
                    'amount_received' => $amount_received_1_page_15,
                    'amount_balance' => $balance_due_1_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }elseif($j == 2){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_2_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_2_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_2_page_15,
                    'amount_received' => $amount_received_2_page_15,
                    'amount_balance' => $balance_due_2_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }elseif($j == 3){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_3_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_3_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_3_page_15,
                    'amount_received' => $amount_received_3_page_15,
                    'amount_balance' => $balance_due_3_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }elseif($j == 4){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_4_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_4_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_4_page_15,
                    'amount_received' => $amount_received_4_page_15,
                    'amount_balance' => $balance_due_4_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }elseif($j == 5){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_5_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_5_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_5_page_15,
                    'amount_received' => $amount_received_5_page_15,
                    'amount_balance' => $balance_due_5_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }elseif($j == 6){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_6_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_6_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_6_page_15,
                    'amount_received' => $amount_received_6_page_15,
                    'amount_balance' => $balance_due_6_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }elseif($j == 7){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_7_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_7_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_7_page_15,
                    'amount_received' => $amount_received_7_page_15,
                    'amount_balance' => $balance_due_7_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }
            elseif($j == 8){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 15)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_15,
                    'claim_status' => $claim_status_page_15,
                    'reason' => $reason_page_15,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_15,
                    'recovered_amount' => $recovered_amount_page_15,
                    'claim_head_default' => $claim_head_default_8_page_15,
                    'claim_amount_due_default' => $claim_amount_due_default_8_page_15,
                    'total_amount_due_default' => $claim_amount_due_default_page_15,
                    'amount_due' => $amount_due_8_page_15,
                    'amount_received' => $amount_received_8_page_15,
                    'amount_balance' => $balance_due_8_page_15,
                    'total_amount_due' => $amount_due_page_15,
                    'total_amount_received' => $amount_received_page_15,
                    'total_amount_balance' => $balance_due_page_15,
                    'amount_received_last' => $amount_received_last_page_15,
                    'total_amount_cheque' => $total_amount_cheque_page_15,
                    'cheque_date' => $cheque_date_page_15,
                    'cheque_no' => $cheque_no_page_15,
                    'bank_name' => $bank_name_page_15,
                    'reason_remarks' => $reason_remarks_page_15
                ]);    
            }
            
            
            
        }

        
    }
}
