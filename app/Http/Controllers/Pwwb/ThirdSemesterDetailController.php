<?php

namespace App\Http\Controllers\Pwwb;

use App\Fields\SecondSemesterDetailFields;
use Illuminate\Routing\Controller;
use App\Fields\ThirdSemesterDetailFields;
use App\Fields\ThirdSemesterResultStatusDetailFields;
use App\Models\Pwwb\ThirdSemesterDetail;
use App\Models\Pwwb\ThirdSemesterResultStatusDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pwwb\Claim;

class ThirdSemesterDetailController extends Controller
{
    public function post(Request $request)
    {
        $params = $request->all();

        $cell_status = Arr::get($params, ThirdSemesterDetailFields::CELL_STATUS);

        $cell_date_explode = explode('/',Arr::get($params,ThirdSemesterDetailFields::CELL_DATE));
        if(count($cell_date_explode) == 3)
            $cell_date = Carbon::createFromDate($cell_date_explode[2],$cell_date_explode[1],$cell_date_explode[0])->format('Y-m-d');
        else
            $cell_date = Arr::get($params, ThirdSemesterDetailFields::CELL_DATE);
        $pwwb_status = Arr::get($params, ThirdSemesterDetailFields::PWWB_STATUS);

        $pwwb_date_explode = explode('/',Arr::get($params,ThirdSemesterDetailFields::PWWB_DATE));
        if(count($pwwb_date_explode) == 3)
            $pwwb_date = Carbon::createFromDate($pwwb_date_explode[2],$pwwb_date_explode[1],$pwwb_date_explode[0])->format('Y-m-d');
        else
            $pwwb_date = Arr::get($params, ThirdSemesterDetailFields::PWWB_DATE);
        $diary_pwwb = Arr::get($params, ThirdSemesterDetailFields::DIARY_PWWB);
        $amount_claim_due = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_CLAIM_DUE);
        $amount_received = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED);
        $exam_status = Arr::get($params, ThirdSemesterDetailFields::EXAM_STATUS);

        $claim_date_explode = explode('/',Arr::get($params,ThirdSemesterDetailFields::CLAIM_DATE));
        if(count($claim_date_explode) == 3)
            $claim_date = Carbon::createFromDate($claim_date_explode[2],$claim_date_explode[1],$claim_date_explode[0])->format('Y-m-d');
        else
            $claim_date = Arr::get($params, ThirdSemesterDetailFields::CLAIM_DATE);
        $claim_status = Arr::get($params, ThirdSemesterDetailFields::CLAIM_STATUS);
        $roll_no = Arr::get($params, ThirdSemesterDetailFields::ROLL_NO);

        $exam_date_explode = explode('/',Arr::get($params,ThirdSemesterDetailFields::EXAM_DATE));
        if(count($exam_date_explode) == 3)
            $exam_date = Carbon::createFromDate($exam_date_explode[2],$exam_date_explode[1],$exam_date_explode[0])->format('Y-m-d');
        else
            $exam_date = Arr::get($params, ThirdSemesterDetailFields::EXAM_DATE);
        $amount = Arr::get($params, ThirdSemesterDetailFields::AMOUNT);
        $readmissionthird = Arr::get($params, ThirdSemesterDetailFields::READMISSIONTHIRD);
        $same_course = Arr::get($params, ThirdSemesterDetailFields::SAME_COURSE);
        $changed_course = Arr::get($params, ThirdSemesterDetailFields::CHANGED_COURSE);

        //Result Status Details
        $result = Arr::get($params,ThirdSemesterResultStatusDetailFields::RESULT);
        $fail = Arr::get($params,ThirdSemesterResultStatusDetailFields::FAIL);
        $next_appearance = Arr::get($params,ThirdSemesterResultStatusDetailFields::NEXT_APPEARANCE);
        $next_appearance_date = Arr::get($params,ThirdSemesterResultStatusDetailFields::NEXT_APPEARANCE_DATE);
        $last_chance_date = Arr::get($params,ThirdSemesterResultStatusDetailFields::LAST_CHANCE_DATE);
        $passing_date = Arr::get($params,ThirdSemesterResultStatusDetailFields::PASSING_DATE);

        $index_id = Arr::get($params, 'index_id');
        if(!$index_id) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }

        $thirdSemesterDetail = ThirdSemesterDetail::where(ThirdSemesterDetailFields::INDEX_TABLE_ID,$index_id)->first();
        if(!$thirdSemesterDetail){
            $thirdSemesterDetail = new ThirdSemesterDetail();
        }

        $thirdSemesterDetail->index_table_id = $index_id;
        $thirdSemesterDetail->cell_status = $cell_status;
        $thirdSemesterDetail->cell_date = $cell_date;
        $thirdSemesterDetail->pwwb_status = $pwwb_status;
        $thirdSemesterDetail->pwwb_date = $pwwb_date;
        $thirdSemesterDetail->diary_pwwb = $diary_pwwb;
        $thirdSemesterDetail->amount_claim_due = $amount_claim_due;
        $thirdSemesterDetail->exam_status = $exam_status;
        $thirdSemesterDetail->amount_received = $amount_received;
        $thirdSemesterDetail->roll_no = $roll_no;
        $thirdSemesterDetail->claim_date = $claim_date;
        $thirdSemesterDetail->claim_status = $claim_status;
        $thirdSemesterDetail->exam_date = $exam_date;
        $thirdSemesterDetail->amount = $amount;
        $thirdSemesterDetail->readmissionthird = $readmissionthird;
        $thirdSemesterDetail->same_course = $same_course;
        $thirdSemesterDetail->changed_course = $changed_course;
        $thirdSemesterDetail->save();

        // Claims Fileds Start
        $page_number = '19';
        $claim_due_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_DUE_PAGE_19);
        $claim_status_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_STATUS_PAGE_19);
        $reason_page_19 = Arr::get($params, ThirdSemesterDetailFields::REASON_PAGE_19);
        $outstanding_cfe_fee_page_19 = Arr::get($params, ThirdSemesterDetailFields::OUTSTANDING_CFE_FEE_PAGE_19);
        $recovered_amount_page_19 = Arr::get($params, ThirdSemesterDetailFields::RECOVERED_AMOUNT_PAGE_19);
        $claim_head_default_1_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_1_PAGE_19);
        $claim_head_default_2_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_2_PAGE_19);
        $claim_head_default_3_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_3_PAGE_19);
        $claim_head_default_4_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_4_PAGE_19);
        $claim_head_default_5_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_5_PAGE_19);
        $claim_head_default_6_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_6_PAGE_19);
        $claim_head_default_7_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_7_PAGE_19);
        $claim_head_default_8_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_HEAD_DEFAULT_8_PAGE_19);
        $claim_amount_due_default_1_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_19);
        $claim_amount_due_default_2_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_19);
        $claim_amount_due_default_3_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_19);
        $claim_amount_due_default_4_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_19);
        $claim_amount_due_default_5_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_19);
        $claim_amount_due_default_6_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_19);
        $claim_amount_due_default_7_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_19);
        $claim_amount_due_default_8_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_19);
        $claim_amount_due_default_page_19 = Arr::get($params, ThirdSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_PAGE_19);
        $type_of_claim_1_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_1_PAGE_19);
        $type_of_claim_2_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_2_PAGE_19);
        $type_of_claim_3_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_3_PAGE_19);
        $type_of_claim_4_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_4_PAGE_19);
        $type_of_claim_5_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_5_PAGE_19);
        $type_of_claim_6_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_6_PAGE_19);
        $type_of_claim_7_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_7_PAGE_19);
        $type_of_claim_8_page_19 = Arr::get($params, ThirdSemesterDetailFields::TYPE_OF_CLAIM_8_PAGE_19);
        $amount_due_1_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_1_PAGE_19);
        $amount_received_1_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_1_PAGE_19);
        $balance_due_1_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_1_PAGE_19);
        $amount_due_2_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_2_PAGE_19);
        $amount_received_2_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_2_PAGE_19);
        $balance_due_2_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_2_PAGE_19);
        $amount_due_3_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_3_PAGE_19);
        $amount_received_3_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_3_PAGE_19);
        $balance_due_3_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_3_PAGE_19);
        $amount_due_4_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_4_PAGE_19);
        $amount_received_4_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_4_PAGE_19);
        $balance_due_4_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_4_PAGE_19);
        $amount_due_5_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_5_PAGE_19);
        $amount_received_5_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_5_PAGE_19);
        $balance_due_5_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_5_PAGE_19);
        $amount_due_6_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_6_PAGE_19);
        $amount_received_6_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_6_PAGE_19);
        $balance_due_6_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_6_PAGE_19);
        $amount_due_7_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_7_PAGE_19);
        $amount_received_7_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_7_PAGE_19);
        $balance_due_7_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_7_PAGE_19);
        $amount_due_8_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_8_PAGE_19);
        $amount_received_8_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_8_PAGE_19);
        $balance_due_8_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_8_PAGE_19);
        $amount_due_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_DUE_PAGE_19);
        $amount_received_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_PAGE_19);
        $balance_due_page_19 = Arr::get($params, ThirdSemesterDetailFields::BALANCE_DUE_PAGE_19);
        $amount_received_last_page_19 = Arr::get($params, ThirdSemesterDetailFields::AMOUNT_RECEIVED_LAST_PAGE_19);
        $total_amount_cheque_page_19 = Arr::get($params, ThirdSemesterDetailFields::TOTAL_AMOUNT_CHEQUE_PAGE_19);
        $cheque_date_page_19 = Arr::get($params, ThirdSemesterDetailFields::CHEQUE_DATE_PAGE_19);
        $cheque_no_page_19 = Arr::get($params, ThirdSemesterDetailFields::CHEQUE_NO_PAGE_19);
        $bank_name_page_19 = Arr::get($params, ThirdSemesterDetailFields::BANK_NAME_PAGE_19);
        $reason_remarks_page_19 = Arr::get($params, ThirdSemesterDetailFields::REASON_REMARKS_PAGE_19);

        


        // $reason = Arr::get($params,ThirdSemesterDetailFields::REASON);
        // $cfe_fee = Arr::get($params,ThirdSemesterDetailFields::CFE_FEE);
        // $recovery_from_student = Arr::get($params,ThirdSemesterDetailFields::RECOVERY_FROM_STUDENT);
        $checkIfClaimExists = Claim::where(ThirdSemesterDetailFields::INDEX_TABLE_ID,$index_id)->where('page_number', '=', 19)->first();
        if(!$checkIfClaimExists){
            // Claims Fields End
            $this->claimsStore(
                '1a',
                '1a',
                'claimAdd',
                $page_number,
                $index_id,
                $claim_due_page_19,
                $claim_status_page_19,
                $reason_page_19,
                $outstanding_cfe_fee_page_19,
                $recovered_amount_page_19,
                $claim_head_default_1_page_19,
                $claim_head_default_2_page_19,
                $claim_head_default_3_page_19,
                $claim_head_default_4_page_19,
                $claim_head_default_5_page_19,
                $claim_head_default_6_page_19,
                $claim_head_default_7_page_19,
                $claim_head_default_8_page_19,
                $claim_amount_due_default_1_page_19,
                $claim_amount_due_default_2_page_19,
                $claim_amount_due_default_3_page_19,
                $claim_amount_due_default_4_page_19,
                $claim_amount_due_default_5_page_19,
                $claim_amount_due_default_6_page_19,
                $claim_amount_due_default_7_page_19,
                $claim_amount_due_default_8_page_19,
                $claim_amount_due_default_page_19,
                $type_of_claim_1_page_19,
                $type_of_claim_2_page_19,
                $type_of_claim_3_page_19,
                $type_of_claim_4_page_19,
                $type_of_claim_5_page_19,
                $type_of_claim_6_page_19,
                $type_of_claim_7_page_19,
                $type_of_claim_8_page_19,
                $amount_due_1_page_19,
                $amount_received_1_page_19,
                $balance_due_1_page_19,
                $amount_due_2_page_19,
                $amount_received_2_page_19,
                $balance_due_2_page_19,
                $amount_due_3_page_19,
                $amount_received_3_page_19,
                $balance_due_3_page_19,
                $amount_due_4_page_19,
                $amount_received_4_page_19,
                $balance_due_4_page_19,
                $amount_due_5_page_19,
                $amount_received_5_page_19,
                $balance_due_5_page_19,
                $amount_due_6_page_19,
                $amount_received_6_page_19,
                $balance_due_6_page_19,
                $amount_due_7_page_19,
                $amount_received_7_page_19,
                $balance_due_7_page_19,
                $amount_due_8_page_19,
                $amount_received_8_page_19,
                $balance_due_8_page_19,
                $amount_due_page_19,
                $amount_received_page_19,
                $balance_due_page_19,
                $amount_received_last_page_19,
                $total_amount_cheque_page_19,
                $cheque_date_page_19,
                $cheque_no_page_19,
                $bank_name_page_19,
                $reason_remarks_page_19
            );
        }
        else{
            $claimindex_id = Claim::where(ThirdSemesterDetailFields::INDEX_TABLE_ID, '=', $index_id)->where('page_number', '=', 19)->get();
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
                        $claim_due_page_19,
                        $claim_status_page_19,
                        $reason_page_19,
                        $outstanding_cfe_fee_page_19,
                $recovered_amount_page_19,
                        $claim_head_default_1_page_19,
                        $claim_head_default_2_page_19,
                        $claim_head_default_3_page_19,
                        $claim_head_default_4_page_19,
                        $claim_head_default_5_page_19,
                        $claim_head_default_6_page_19,
                        $claim_head_default_7_page_19,
                        $claim_head_default_8_page_19,
                        $claim_amount_due_default_1_page_19,
                        $claim_amount_due_default_2_page_19,
                        $claim_amount_due_default_3_page_19,
                        $claim_amount_due_default_4_page_19,
                        $claim_amount_due_default_5_page_19,
                        $claim_amount_due_default_6_page_19,
                        $claim_amount_due_default_7_page_19,
                        $claim_amount_due_default_8_page_19,
                        $claim_amount_due_default_page_19,
                        $type_of_claim_1_page_19,
                        $type_of_claim_2_page_19,
                        $type_of_claim_3_page_19,
                        $type_of_claim_4_page_19,
                        $type_of_claim_5_page_19,
                        $type_of_claim_6_page_19,
                        $type_of_claim_7_page_19,
                        $type_of_claim_8_page_19,
                        $amount_due_1_page_19,
                        $amount_received_1_page_19,
                        $balance_due_1_page_19,
                        $amount_due_2_page_19,
                        $amount_received_2_page_19,
                        $balance_due_2_page_19,
                        $amount_due_3_page_19,
                        $amount_received_3_page_19,
                        $balance_due_3_page_19,
                        $amount_due_4_page_19,
                        $amount_received_4_page_19,
                        $balance_due_4_page_19,
                        $amount_due_5_page_19,
                        $amount_received_5_page_19,
                        $balance_due_5_page_19,
                        $amount_due_6_page_19,
                        $amount_received_6_page_19,
                        $balance_due_6_page_19,
                        $amount_due_7_page_19,
                        $amount_received_7_page_19,
                        $balance_due_7_page_19,
                        $amount_due_8_page_19,
                        $amount_received_8_page_19,
                        $balance_due_8_page_19,
                        $amount_due_page_19,
                        $amount_received_page_19,
                        $balance_due_page_19,
                        $amount_received_last_page_19,
                        $total_amount_cheque_page_19,
                        $cheque_date_page_19,
                        $cheque_no_page_19,
                        $bank_name_page_19,
                        $reason_remarks_page_19
                    );


             // }
            }
        }


        if (!$index_id) {
            for ($i = 0; $i < count($result); $i++) {
                $thirdSemesterResultStatusDetail = new ThirdSemesterResultStatusDetail();
                $this->fillThirdSemesterResultStatusDetailData($i, $thirdSemesterResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
            }
        } else {
            $j = 0;
            foreach (ThirdSemesterResultStatusDetail::where('index_table_id', $index_id)->get() as $thirdSemesterResultStatusDetail) {
                $thirdSemesterResultStatusDetailSingle = ThirdSemesterResultStatusDetail::find($thirdSemesterResultStatusDetail->id);
                $this->fillThirdSemesterResultStatusDetailData($j, $thirdSemesterResultStatusDetailSingle, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                $j++;
            }
            if ($j < count($result)) {
                for ($k = $j; $k < count($result); $k++) {
                    $thirdSemesterResultStatusDetail = new ThirdSemesterResultStatusDetail();
                    $this->fillThirdSemesterResultStatusDetailData($k, $thirdSemesterResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
        ], 200);
    }

    private function fillThirdSemesterResultStatusDetailData($index,$thirdSemesterResultStatusDetailObject,$index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date){
        $thirdSemesterResultStatusDetailObject->index_table_id = $index_id;
        $thirdSemesterResultStatusDetailObject->result = isset($result[$index]) ? $result[$index] : null;
        $thirdSemesterResultStatusDetailObject->fail = isset($fail[$index]) ? $fail[$index] : null;
        $thirdSemesterResultStatusDetailObject->next_appearance = isset($next_appearance[$index]) ? $next_appearance[$index] : null;

        $NextAppearance = null;
        if(isset($next_appearance_date[$index])){
            $NextAppearanceExplode = explode('/',$next_appearance_date[$index]);
            if(count($NextAppearanceExplode) == 3)
                $NextAppearance = Carbon::createFromDate($NextAppearanceExplode[2],$NextAppearanceExplode[1],$NextAppearanceExplode[0])->format('Y-m-d');
            else
                $NextAppearance = $next_appearance_date[$index];
        }
        $thirdSemesterResultStatusDetailObject->next_appearance_date = $NextAppearance;

        $LastChance = null;
        if(isset($last_chance_date[$index])){
            $LastChanceExplode = explode('/',$last_chance_date[$index]);
            if(count($LastChanceExplode) == 3)
                $LastChance = Carbon::createFromDate($LastChanceExplode[2],$LastChanceExplode[1],$LastChanceExplode[0])->format('Y-m-d');
            else
                $LastChance = $last_chance_date[$index];
        }
        $thirdSemesterResultStatusDetailObject->last_chance_date = $LastChance;

        $Passing = null;
        if(isset($passing_date[$index])){
            $PassingExplode = explode('/',$passing_date[$index]);
            if(count($PassingExplode) == 3)
                $Passing = Carbon::createFromDate($PassingExplode[2],$PassingExplode[1],$PassingExplode[0])->format('Y-m-d');
            else
                $Passing = $passing_date[$index];
        }
        $thirdSemesterResultStatusDetailObject->passing_date = $Passing;
        $thirdSemesterResultStatusDetailObject->save();
    }

    public function deleteThirdSemesterResultStatusDetail(Request $request){
        $params = $request->all();
        $id = Arr::get($params,ThirdSemesterResultStatusDetailFields::ID);
        $indexId = Arr::get($params,'index_id');
        $object = ThirdSemesterResultStatusDetail::where('id',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    public function claimsStore($j,$indexes,$claim,$page_number,
                $index_id,
                $claim_due_page_19,
                $claim_status_page_19,
                $reason_page_19,
                $outstanding_cfe_fee_page_19,
                $recovered_amount_page_19,
                $claim_head_default_1_page_19,
                $claim_head_default_2_page_19,
                $claim_head_default_3_page_19,
                $claim_head_default_4_page_19,
                $claim_head_default_5_page_19,
                $claim_head_default_6_page_19,
                $claim_head_default_7_page_19,
                $claim_head_default_8_page_19,
                $claim_amount_due_default_1_page_19,
                $claim_amount_due_default_2_page_19,
                $claim_amount_due_default_3_page_19,
                $claim_amount_due_default_4_page_19,
                $claim_amount_due_default_5_page_19,
                $claim_amount_due_default_6_page_19,
                $claim_amount_due_default_7_page_19,
                $claim_amount_due_default_8_page_19,
                $claim_amount_due_default_page_19,
                $type_of_claim_1_page_19,
                $type_of_claim_2_page_19,
                $type_of_claim_3_page_19,
                $type_of_claim_4_page_19,
                $type_of_claim_5_page_19,
                $type_of_claim_6_page_19,
                $type_of_claim_7_page_19,
                $type_of_claim_8_page_19,
                $amount_due_1_page_19,
                $amount_received_1_page_19,
                $balance_due_1_page_19,
                $amount_due_2_page_19,
                $amount_received_2_page_19,
                $balance_due_2_page_19,
                $amount_due_3_page_19,
                $amount_received_3_page_19,
                $balance_due_3_page_19,
                $amount_due_4_page_19,
                $amount_received_4_page_19,
                $balance_due_4_page_19,
                $amount_due_5_page_19,
                $amount_received_5_page_19,
                $balance_due_5_page_19,
                $amount_due_6_page_19,
                $amount_received_6_page_19,
                $balance_due_6_page_19,
                $amount_due_7_page_19,
                $amount_received_7_page_19,
                $balance_due_7_page_19,
                $amount_due_8_page_19,
                $amount_received_8_page_19,
                $balance_due_8_page_19,
                $amount_due_page_19,
                $amount_received_page_19,
                $balance_due_page_19,
                $amount_received_last_page_19,
                $total_amount_cheque_page_19,
                $cheque_date_page_19,
                $cheque_no_page_19,
                $bank_name_page_19,
                $reason_remarks_page_19){
        $index_id = request('index_id');
        if($indexes == '1a') {
            for($i = 1; $i<= 8; $i++){           
                if($i ==1){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 1;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_1_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_1_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_1_page_19;
                    $claimTable->amount_due = $amount_due_1_page_19;
                    $claimTable->amount_received = $amount_received_1_page_19;
                    $claimTable->amount_balance = $balance_due_1_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;

                    $claimTable->save();
                }
                elseif($i ==2){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 2;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_2_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_2_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_2_page_19;
                    $claimTable->amount_due = $amount_due_2_page_19;
                    $claimTable->amount_received = $amount_received_2_page_19;
                    $claimTable->amount_balance = $balance_due_2_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
                elseif($i ==3){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 3;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_3_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_3_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_3_page_19;
                    $claimTable->amount_due = $amount_due_3_page_19;
                    $claimTable->amount_received = $amount_received_3_page_19;
                    $claimTable->amount_balance = $balance_due_3_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
                elseif($i ==4){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 4;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_4_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_4_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_4_page_19;
                    $claimTable->amount_due = $amount_due_4_page_19;
                    $claimTable->amount_received = $amount_received_4_page_19;
                    $claimTable->amount_balance = $balance_due_4_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
                elseif($i ==5){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 5;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_5_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_5_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_5_page_19;
                    $claimTable->amount_due = $amount_due_5_page_19;
                    $claimTable->amount_received = $amount_received_5_page_19;
                    $claimTable->amount_balance = $balance_due_5_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
                elseif($i ==6){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 6;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_6_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_6_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_6_page_19;
                    $claimTable->amount_due = $amount_due_6_page_19;
                    $claimTable->amount_received = $amount_received_6_page_19;
                    $claimTable->amount_balance = $balance_due_6_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
                elseif($i ==7){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 7;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_7_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_7_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_7_page_19;
                    $claimTable->amount_due = $amount_due_7_page_19;
                    $claimTable->amount_received = $amount_received_7_page_19;
                    $claimTable->amount_balance = $balance_due_7_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
                elseif($i ==8){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 8;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_19;
                    $claimTable->claim_status = $claim_status_page_19;
                    $claimTable->reason = $reason_page_19;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_19;
                    $claimTable->recovered_amount = $recovered_amount_page_19;
                    $claimTable->claim_head_default = $claim_head_default_8_page_19;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_8_page_19;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_19;
                    $claimTable->claim_head = $type_of_claim_8_page_19;
                    $claimTable->amount_due = $amount_due_8_page_19;
                    $claimTable->amount_received = $amount_received_8_page_19;
                    $claimTable->amount_balance = $balance_due_8_page_19;        
                    $claimTable->total_amount_due = $amount_due_page_19;
                    $claimTable->total_amount_received = $amount_received_page_19;
                    $claimTable->total_amount_balance = $balance_due_page_19;
                    $claimTable->amount_received_last = $amount_received_last_page_19;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_19;
                    $claimTable->cheque_date = $cheque_date_page_19;
                    $claimTable->cheque_no = $cheque_no_page_19;
                    $claimTable->bank_name = $bank_name_page_19;
                    $claimTable->reason_remarks = $reason_remarks_page_19;
                    $claimTable->save();
                }
            }
        }else{           
            if($j == 1){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_1_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_1_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_1_page_19,
                    'amount_received' => $amount_received_1_page_19,
                    'amount_balance' => $balance_due_1_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }elseif($j == 2){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_2_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_2_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_2_page_19,
                    'amount_received' => $amount_received_2_page_19,
                    'amount_balance' => $balance_due_2_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }elseif($j == 3){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_3_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_3_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_3_page_19,
                    'amount_received' => $amount_received_3_page_19,
                    'amount_balance' => $balance_due_3_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }elseif($j == 4){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_4_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_4_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_4_page_19,
                    'amount_received' => $amount_received_4_page_19,
                    'amount_balance' => $balance_due_4_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }elseif($j == 5){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_5_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_5_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_5_page_19,
                    'amount_received' => $amount_received_5_page_19,
                    'amount_balance' => $balance_due_5_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }elseif($j == 6){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_6_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_6_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_6_page_19,
                    'amount_received' => $amount_received_6_page_19,
                    'amount_balance' => $balance_due_6_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }elseif($j == 7){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_7_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_7_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_7_page_19,
                    'amount_received' => $amount_received_7_page_19,
                    'amount_balance' => $balance_due_7_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }
            elseif($j == 8){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 19)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_19,
                    'claim_status' => $claim_status_page_19,
                    'reason' => $reason_page_19,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_19,
                    'recovered_amount' => $recovered_amount_page_19,
                    'claim_head_default' => $claim_head_default_8_page_19,
                    'claim_amount_due_default' => $claim_amount_due_default_8_page_19,
                    'total_amount_due_default' => $claim_amount_due_default_page_19,
                    'amount_due' => $amount_due_8_page_19,
                    'amount_received' => $amount_received_8_page_19,
                    'amount_balance' => $balance_due_8_page_19,
                    'total_amount_due' => $amount_due_page_19,
                    'total_amount_received' => $amount_received_page_19,
                    'total_amount_balance' => $balance_due_page_19,
                    'amount_received_last' => $amount_received_last_page_19,
                    'total_amount_cheque' => $total_amount_cheque_page_19,
                    'cheque_date' => $cheque_date_page_19,
                    'cheque_no' => $cheque_no_page_19,
                    'bank_name' => $bank_name_page_19,
                    'reason_remarks' => $reason_remarks_page_19
                ]);    
            }
            
            
            
        }

        
    }
}
