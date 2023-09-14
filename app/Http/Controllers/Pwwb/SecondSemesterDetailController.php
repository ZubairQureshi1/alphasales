<?php

namespace App\Http\Controllers\Pwwb;

use App\Fields\FirstSemesterDetailFields;
use Illuminate\Routing\Controller;
use App\Fields\SecondSemesterDetailFields;
use App\Fields\SecondSemesterResultStatusDetailFields;
use App\Models\Pwwb\SecondSemesterDetail;
use App\Models\Pwwb\SecondSemesterResultStatusDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pwwb\Claim;

class SecondSemesterDetailController extends Controller
{
    public function post(Request $request)
    {
        $params = $request->all();

        $cell_status = Arr::get($params, SecondSemesterDetailFields::CELL_STATUS);

        $cell_date_explode = explode('/',Arr::get($params,SecondSemesterDetailFields::CELL_DATE));
        if(count($cell_date_explode) == 3)
            $cell_date = Carbon::createFromDate($cell_date_explode[2],$cell_date_explode[1],$cell_date_explode[0])->format('Y-m-d');
        else
            $cell_date = Arr::get($params, SecondSemesterDetailFields::CELL_DATE);

        $pwwb_status = Arr::get($params, SecondSemesterDetailFields::PWWB_STATUS);

        $pwwb_date_explode = explode('/',Arr::get($params,SecondSemesterDetailFields::PWWB_DATE));
        if(count($pwwb_date_explode) == 3)
            $pwwb_date = Carbon::createFromDate($pwwb_date_explode[2],$pwwb_date_explode[1],$pwwb_date_explode[0])->format('Y-m-d');
        else
            $pwwb_date = Arr::get($params, SecondSemesterDetailFields::PWWB_DATE);

        $diary_pwwb = Arr::get($params, SecondSemesterDetailFields::DIARY_PWWB);
        $amount_claim_due = Arr::get($params, SecondSemesterDetailFields::AMOUNT_CLAIM_DUE);
        $amount_received = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED);
        $exam_status = Arr::get($params, SecondSemesterDetailFields::EXAM_STATUS);

        $claim_date_explode = explode('/',Arr::get($params,SecondSemesterDetailFields::CLAIM_DATE));
        if(count($claim_date_explode) == 3)
            $claim_date = Carbon::createFromDate($claim_date_explode[2],$claim_date_explode[1],$claim_date_explode[0])->format('Y-m-d');
        else
            $claim_date = Arr::get($params, SecondSemesterDetailFields::CLAIM_DATE);

        $claim_status = Arr::get($params, SecondSemesterDetailFields::CLAIM_STATUS);
        $roll_no = Arr::get($params, SecondSemesterDetailFields::ROLL_NO);

        $exam_date_explode = explode('/',Arr::get($params,SecondSemesterDetailFields::EXAM_DATE));
        if(count($exam_date_explode) == 3)
            $exam_date = Carbon::createFromDate($exam_date_explode[2],$exam_date_explode[1],$exam_date_explode[0])->format('Y-m-d');
        else
            $exam_date = Arr::get($params, SecondSemesterDetailFields::EXAM_DATE);

        $amount = Arr::get($params, SecondSemesterDetailFields::AMOUNT);
        $readmissionsecond = Arr::get($params, SecondSemesterDetailFields::READMISSIONSECOND);
        $same_course = Arr::get($params, SecondSemesterDetailFields::SAME_COURSE);
        $changed_course = Arr::get($params, SecondSemesterDetailFields::CHANGED_COURSE);


        //Result Status Details
        $result = Arr::get($params,SecondSemesterResultStatusDetailFields::RESULT);
        $fail = Arr::get($params,SecondSemesterResultStatusDetailFields::FAIL);
        $next_appearance = Arr::get($params,SecondSemesterResultStatusDetailFields::NEXT_APPEARANCE);
        $next_appearance_date = Arr::get($params,SecondSemesterResultStatusDetailFields::NEXT_APPEARANCE_DATE);
        $last_chance_date = Arr::get($params,SecondSemesterResultStatusDetailFields::LAST_CHANCE_DATE);
        $passing_date = Arr::get($params,SecondSemesterResultStatusDetailFields::PASSING_DATE);

        $index_id = Arr::get($params, 'index_id');
        if(!$index_id) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }

        $secondSemesterDetail = SecondSemesterDetail::where(SecondSemesterDetailFields::INDEX_TABLE_ID,$index_id)->first();
        if(!$secondSemesterDetail){
            $secondSemesterDetail = new SecondSemesterDetail();
        }

        $secondSemesterDetail->index_table_id = $index_id;
        $secondSemesterDetail->cell_status = $cell_status;
        $secondSemesterDetail->cell_date = $cell_date;
        $secondSemesterDetail->pwwb_status = $pwwb_status;
        $secondSemesterDetail->pwwb_date = $pwwb_date;
        $secondSemesterDetail->diary_pwwb = $diary_pwwb;
        $secondSemesterDetail->amount_claim_due = $amount_claim_due;
        $secondSemesterDetail->exam_status = $exam_status;
        $secondSemesterDetail->amount_received = $amount_received;
        $secondSemesterDetail->roll_no = $roll_no;
        $secondSemesterDetail->claim_date = $claim_date;
        $secondSemesterDetail->claim_status = $claim_status;
        $secondSemesterDetail->exam_date = $exam_date;
        $secondSemesterDetail->amount = $amount;
        $secondSemesterDetail->readmissionsecond = $readmissionsecond;
        $secondSemesterDetail->same_course = $same_course;
        $secondSemesterDetail->changed_course = $changed_course;
        $secondSemesterDetail->save();

        // Claims Fileds Start
        $page_number = '18';
        $claim_due_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_DUE_PAGE_18);
        $claim_status_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_STATUS_PAGE_18);
        $reason_page_18 = Arr::get($params, SecondSemesterDetailFields::REASON_PAGE_18);
        $outstanding_cfe_fee_page_18 = Arr::get($params, SecondSemesterDetailFields::OUTSTANDING_CFE_FEE_PAGE_18);
        $recovered_amount_page_18 = Arr::get($params, SecondSemesterDetailFields::RECOVERED_AMOUNT_PAGE_18);
        $claim_head_default_1_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_1_PAGE_18);
        $claim_head_default_2_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_2_PAGE_18);
        $claim_head_default_3_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_3_PAGE_18);
        $claim_head_default_4_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_4_PAGE_18);
        $claim_head_default_5_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_5_PAGE_18);
        $claim_head_default_6_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_6_PAGE_18);
        $claim_head_default_7_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_7_PAGE_18);
        $claim_head_default_8_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_HEAD_DEFAULT_8_PAGE_18);
        $claim_amount_due_default_1_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_18);
        $claim_amount_due_default_2_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_18);
        $claim_amount_due_default_3_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_18);
        $claim_amount_due_default_4_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_18);
        $claim_amount_due_default_5_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_18);
        $claim_amount_due_default_6_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_18);
        $claim_amount_due_default_7_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_18);
        $claim_amount_due_default_8_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_18);
        $claim_amount_due_default_page_18 = Arr::get($params, SecondSemesterDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_PAGE_18);
        $type_of_claim_1_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_1_PAGE_18);
        $type_of_claim_2_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_2_PAGE_18);
        $type_of_claim_3_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_3_PAGE_18);
        $type_of_claim_4_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_4_PAGE_18);
        $type_of_claim_5_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_5_PAGE_18);
        $type_of_claim_6_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_6_PAGE_18);
        $type_of_claim_7_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_7_PAGE_18);
        $type_of_claim_8_page_18 = Arr::get($params, SecondSemesterDetailFields::TYPE_OF_CLAIM_8_PAGE_18);
        $amount_due_1_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_1_PAGE_18);
        $amount_received_1_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_1_PAGE_18);
        $balance_due_1_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_1_PAGE_18);
        $amount_due_2_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_2_PAGE_18);
        $amount_received_2_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_2_PAGE_18);
        $balance_due_2_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_2_PAGE_18);
        $amount_due_3_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_3_PAGE_18);
        $amount_received_3_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_3_PAGE_18);
        $balance_due_3_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_3_PAGE_18);
        $amount_due_4_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_4_PAGE_18);
        $amount_received_4_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_4_PAGE_18);
        $balance_due_4_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_4_PAGE_18);
        $amount_due_5_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_5_PAGE_18);
        $amount_received_5_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_5_PAGE_18);
        $balance_due_5_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_5_PAGE_18);
        $amount_due_6_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_6_PAGE_18);
        $amount_received_6_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_6_PAGE_18);
        $balance_due_6_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_6_PAGE_18);
        $amount_due_7_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_7_PAGE_18);
        $amount_received_7_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_7_PAGE_18);
        $balance_due_7_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_7_PAGE_18);
        $amount_due_8_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_8_PAGE_18);
        $amount_received_8_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_8_PAGE_18);
        $balance_due_8_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_8_PAGE_18);
        $amount_due_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_DUE_PAGE_18);
        $amount_received_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_PAGE_18);
        $balance_due_page_18 = Arr::get($params, SecondSemesterDetailFields::BALANCE_DUE_PAGE_18);
        $amount_received_last_page_18 = Arr::get($params, SecondSemesterDetailFields::AMOUNT_RECEIVED_LAST_PAGE_18);
        $total_amount_cheque_page_18 = Arr::get($params, SecondSemesterDetailFields::TOTAL_AMOUNT_CHEQUE_PAGE_18);
        $cheque_date_page_18 = Arr::get($params, SecondSemesterDetailFields::CHEQUE_DATE_PAGE_18);
        $cheque_no_page_18 = Arr::get($params, SecondSemesterDetailFields::CHEQUE_NO_PAGE_18);
        $bank_name_page_18 = Arr::get($params, SecondSemesterDetailFields::BANK_NAME_PAGE_18);
        $reason_remarks_page_18 = Arr::get($params, SecondSemesterDetailFields::REASON_REMARKS_PAGE_18);

        


        // $reason = Arr::get($params,SecondSemesterDetailFields::REASON);
        // $cfe_fee = Arr::get($params,SecondSemesterDetailFields::CFE_FEE);
        // $recovery_from_student = Arr::get($params,SecondSemesterDetailFields::RECOVERY_FROM_STUDENT);
        $checkIfClaimExists = Claim::where(SecondSemesterDetailFields::INDEX_TABLE_ID,$index_id)->where('page_number', '=', 18)->first();
        if(!$checkIfClaimExists){
            // Claims Fields End
            $this->claimsStore(
                '1a',
                '1a',
                'claimAdd',
                $page_number,
                $index_id,
                $claim_due_page_18,
                $claim_status_page_18,
                $reason_page_18,
                $outstanding_cfe_fee_page_18,
                $recovered_amount_page_18,
                $claim_head_default_1_page_18,
                $claim_head_default_2_page_18,
                $claim_head_default_3_page_18,
                $claim_head_default_4_page_18,
                $claim_head_default_5_page_18,
                $claim_head_default_6_page_18,
                $claim_head_default_7_page_18,
                $claim_head_default_8_page_18,
                $claim_amount_due_default_1_page_18,
                $claim_amount_due_default_2_page_18,
                $claim_amount_due_default_3_page_18,
                $claim_amount_due_default_4_page_18,
                $claim_amount_due_default_5_page_18,
                $claim_amount_due_default_6_page_18,
                $claim_amount_due_default_7_page_18,
                $claim_amount_due_default_8_page_18,
                $claim_amount_due_default_page_18,
                $type_of_claim_1_page_18,
                $type_of_claim_2_page_18,
                $type_of_claim_3_page_18,
                $type_of_claim_4_page_18,
                $type_of_claim_5_page_18,
                $type_of_claim_6_page_18,
                $type_of_claim_7_page_18,
                $type_of_claim_8_page_18,
                $amount_due_1_page_18,
                $amount_received_1_page_18,
                $balance_due_1_page_18,
                $amount_due_2_page_18,
                $amount_received_2_page_18,
                $balance_due_2_page_18,
                $amount_due_3_page_18,
                $amount_received_3_page_18,
                $balance_due_3_page_18,
                $amount_due_4_page_18,
                $amount_received_4_page_18,
                $balance_due_4_page_18,
                $amount_due_5_page_18,
                $amount_received_5_page_18,
                $balance_due_5_page_18,
                $amount_due_6_page_18,
                $amount_received_6_page_18,
                $balance_due_6_page_18,
                $amount_due_7_page_18,
                $amount_received_7_page_18,
                $balance_due_7_page_18,
                $amount_due_8_page_18,
                $amount_received_8_page_18,
                $balance_due_8_page_18,
                $amount_due_page_18,
                $amount_received_page_18,
                $balance_due_page_18,
                $amount_received_last_page_18,
                $total_amount_cheque_page_18,
                $cheque_date_page_18,
                $cheque_no_page_18,
                $bank_name_page_18,
                $reason_remarks_page_18
            );
        }
        else{
            $claimindex_id = Claim::where(SecondSemesterDetailFields::INDEX_TABLE_ID, '=', $index_id)->where('page_number', '=', 18)->get();
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
                        $claim_due_page_18,
                        $claim_status_page_18,
                        $reason_page_18,
                        $outstanding_cfe_fee_page_18,
                $recovered_amount_page_18,
                        $claim_head_default_1_page_18,
                        $claim_head_default_2_page_18,
                        $claim_head_default_3_page_18,
                        $claim_head_default_4_page_18,
                        $claim_head_default_5_page_18,
                        $claim_head_default_6_page_18,
                        $claim_head_default_7_page_18,
                        $claim_head_default_8_page_18,
                        $claim_amount_due_default_1_page_18,
                        $claim_amount_due_default_2_page_18,
                        $claim_amount_due_default_3_page_18,
                        $claim_amount_due_default_4_page_18,
                        $claim_amount_due_default_5_page_18,
                        $claim_amount_due_default_6_page_18,
                        $claim_amount_due_default_7_page_18,
                        $claim_amount_due_default_8_page_18,
                        $claim_amount_due_default_page_18,
                        $type_of_claim_1_page_18,
                        $type_of_claim_2_page_18,
                        $type_of_claim_3_page_18,
                        $type_of_claim_4_page_18,
                        $type_of_claim_5_page_18,
                        $type_of_claim_6_page_18,
                        $type_of_claim_7_page_18,
                        $type_of_claim_8_page_18,
                        $amount_due_1_page_18,
                        $amount_received_1_page_18,
                        $balance_due_1_page_18,
                        $amount_due_2_page_18,
                        $amount_received_2_page_18,
                        $balance_due_2_page_18,
                        $amount_due_3_page_18,
                        $amount_received_3_page_18,
                        $balance_due_3_page_18,
                        $amount_due_4_page_18,
                        $amount_received_4_page_18,
                        $balance_due_4_page_18,
                        $amount_due_5_page_18,
                        $amount_received_5_page_18,
                        $balance_due_5_page_18,
                        $amount_due_6_page_18,
                        $amount_received_6_page_18,
                        $balance_due_6_page_18,
                        $amount_due_7_page_18,
                        $amount_received_7_page_18,
                        $balance_due_7_page_18,
                        $amount_due_8_page_18,
                        $amount_received_8_page_18,
                        $balance_due_8_page_18,
                        $amount_due_page_18,
                        $amount_received_page_18,
                        $balance_due_page_18,
                        $amount_received_last_page_18,
                        $total_amount_cheque_page_18,
                        $cheque_date_page_18,
                        $cheque_no_page_18,
                        $bank_name_page_18,
                        $reason_remarks_page_18
                    );


             // }
            }
        }


        if (!$index_id) {
            for ($i = 0; $i < count($result); $i++) {
                $secondSemesterResultStatusDetail = new SecondSemesterResultStatusDetail();
                $this->fillSecondSemesterResultStatusDetailData($i, $secondSemesterResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
            }
        } else {
            $j = 0;
            foreach (SecondSemesterResultStatusDetail::where('index_table_id', $index_id)->get() as $secondSemesterResultStatusDetail) {
                $secondSemesterResultStatusDetailSingle = SecondSemesterResultStatusDetail::find($secondSemesterResultStatusDetail->id);
                $this->fillSecondSemesterResultStatusDetailData($j, $secondSemesterResultStatusDetailSingle, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                $j++;
            }
            if ($j < count($result)) {
                for ($k = $j; $k < count($result); $k++) {
                    $secondSemesterResultStatusDetail = new SecondSemesterResultStatusDetail();
                    $this->fillSecondSemesterResultStatusDetailData($k, $secondSemesterResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
        ], 200);
    }

    private function fillSecondSemesterResultStatusDetailData($index,$secondSemesterResultStatusDetailObject,$index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date){
        $secondSemesterResultStatusDetailObject->index_table_id = $index_id;
        $secondSemesterResultStatusDetailObject->result = isset($result[$index]) ? $result[$index] : null;
        $secondSemesterResultStatusDetailObject->fail = isset($fail[$index]) ? $fail[$index] : null;
        $secondSemesterResultStatusDetailObject->next_appearance = isset($next_appearance[$index]) ? $next_appearance[$index] : null;
        $NextAppearance = null;
        if(isset($next_appearance_date[$index])){
            $NextAppearanceExplode = explode('/',$next_appearance_date[$index]);
            if(count($NextAppearanceExplode) == 3)
                $NextAppearance = Carbon::createFromDate($NextAppearanceExplode[2],$NextAppearanceExplode[1],$NextAppearanceExplode[0])->format('Y-m-d');
            else
                $NextAppearance = $next_appearance_date[$index];
        }
        $secondSemesterResultStatusDetailObject->next_appearance_date = $NextAppearance;

        $LastChance = null;
        if(isset($last_chance_date[$index])){
            $LastChanceExplode = explode('/',$last_chance_date[$index]);
            if(count($LastChanceExplode) == 3)
                $LastChance = Carbon::createFromDate($LastChanceExplode[2],$LastChanceExplode[1],$LastChanceExplode[0])->format('Y-m-d');
            else
                $LastChance = $last_chance_date[$index];
        }
        $secondSemesterResultStatusDetailObject->last_chance_date = $LastChance;

        $Passing = null;
        if(isset($passing_date[$index])){
            $PassingExplode = explode('/',$passing_date[$index]);
            if(count($PassingExplode) == 3)
                $Passing = Carbon::createFromDate($PassingExplode[2],$PassingExplode[1],$PassingExplode[0])->format('Y-m-d');
            else
                $Passing = $passing_date[$index];
        }
        $secondSemesterResultStatusDetailObject->passing_date = $Passing;
        $secondSemesterResultStatusDetailObject->save();
    }

    public function deleteSecondSemesterResultStatusDetail(Request $request){
        $params = $request->all();
        $id = Arr::get($params,SecondSemesterResultStatusDetailFields::ID);
        $indexId = Arr::get($params,'index_id');
        $object = SecondSemesterResultStatusDetail::where('id',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    public function claimsStore($j,$indexes,$claim,$page_number,
                        $index_id,
                        $claim_due_page_18,
                        $claim_status_page_18,
                        $reason_page_18,
                        $outstanding_cfe_fee_page_18,
                $recovered_amount_page_18,
                        $claim_head_default_1_page_18,
                        $claim_head_default_2_page_18,
                        $claim_head_default_3_page_18,
                        $claim_head_default_4_page_18,
                        $claim_head_default_5_page_18,
                        $claim_head_default_6_page_18,
                        $claim_head_default_7_page_18,
                        $claim_head_default_8_page_18,
                        $claim_amount_due_default_1_page_18,
                        $claim_amount_due_default_2_page_18,
                        $claim_amount_due_default_3_page_18,
                        $claim_amount_due_default_4_page_18,
                        $claim_amount_due_default_5_page_18,
                        $claim_amount_due_default_6_page_18,
                        $claim_amount_due_default_7_page_18,
                        $claim_amount_due_default_8_page_18,
                        $claim_amount_due_default_page_18,
                        $type_of_claim_1_page_18,
                        $type_of_claim_2_page_18,
                        $type_of_claim_3_page_18,
                        $type_of_claim_4_page_18,
                        $type_of_claim_5_page_18,
                        $type_of_claim_6_page_18,
                        $type_of_claim_7_page_18,
                        $type_of_claim_8_page_18,
                        $amount_due_1_page_18,
                        $amount_received_1_page_18,
                        $balance_due_1_page_18,
                        $amount_due_2_page_18,
                        $amount_received_2_page_18,
                        $balance_due_2_page_18,
                        $amount_due_3_page_18,
                        $amount_received_3_page_18,
                        $balance_due_3_page_18,
                        $amount_due_4_page_18,
                        $amount_received_4_page_18,
                        $balance_due_4_page_18,
                        $amount_due_5_page_18,
                        $amount_received_5_page_18,
                        $balance_due_5_page_18,
                        $amount_due_6_page_18,
                        $amount_received_6_page_18,
                        $balance_due_6_page_18,
                        $amount_due_7_page_18,
                        $amount_received_7_page_18,
                        $balance_due_7_page_18,
                        $amount_due_8_page_18,
                        $amount_received_8_page_18,
                        $balance_due_8_page_18,
                        $amount_due_page_18,
                        $amount_received_page_18,
                        $balance_due_page_18,
                        $amount_received_last_page_18,
                        $total_amount_cheque_page_18,
                        $cheque_date_page_18,
                        $cheque_no_page_18,
                        $bank_name_page_18,
                        $reason_remarks_page_18){
        $index_id = request('index_id');
        if($indexes == '1a') {
            for($i = 1; $i<= 8; $i++){           
                if($i ==1){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 1;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_1_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_1_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_1_page_18;
                    $claimTable->amount_due = $amount_due_1_page_18;
                    $claimTable->amount_received = $amount_received_1_page_18;
                    $claimTable->amount_balance = $balance_due_1_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;

                    $claimTable->save();
                }
                elseif($i ==2){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 2;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_2_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_2_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_2_page_18;
                    $claimTable->amount_due = $amount_due_2_page_18;
                    $claimTable->amount_received = $amount_received_2_page_18;
                    $claimTable->amount_balance = $balance_due_2_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
                elseif($i ==3){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 3;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_3_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_3_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_3_page_18;
                    $claimTable->amount_due = $amount_due_3_page_18;
                    $claimTable->amount_received = $amount_received_3_page_18;
                    $claimTable->amount_balance = $balance_due_3_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
                elseif($i ==4){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 4;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_4_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_4_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_4_page_18;
                    $claimTable->amount_due = $amount_due_4_page_18;
                    $claimTable->amount_received = $amount_received_4_page_18;
                    $claimTable->amount_balance = $balance_due_4_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
                elseif($i ==5){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 5;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_5_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_5_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_5_page_18;
                    $claimTable->amount_due = $amount_due_5_page_18;
                    $claimTable->amount_received = $amount_received_5_page_18;
                    $claimTable->amount_balance = $balance_due_5_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
                elseif($i ==6){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 6;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_6_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_6_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_6_page_18;
                    $claimTable->amount_due = $amount_due_6_page_18;
                    $claimTable->amount_received = $amount_received_6_page_18;
                    $claimTable->amount_balance = $balance_due_6_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
                elseif($i ==7){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 7;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_7_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_7_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_7_page_18;
                    $claimTable->amount_due = $amount_due_7_page_18;
                    $claimTable->amount_received = $amount_received_7_page_18;
                    $claimTable->amount_balance = $balance_due_7_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
                elseif($i ==8){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 8;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_18;
                    $claimTable->claim_status = $claim_status_page_18;
                    $claimTable->reason = $reason_page_18;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_18;
                    $claimTable->recovered_amount = $recovered_amount_page_18;
                    $claimTable->claim_head_default = $claim_head_default_8_page_18;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_8_page_18;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_18;
                    $claimTable->claim_head = $type_of_claim_8_page_18;
                    $claimTable->amount_due = $amount_due_8_page_18;
                    $claimTable->amount_received = $amount_received_8_page_18;
                    $claimTable->amount_balance = $balance_due_8_page_18;        
                    $claimTable->total_amount_due = $amount_due_page_18;
                    $claimTable->total_amount_received = $amount_received_page_18;
                    $claimTable->total_amount_balance = $balance_due_page_18;
                    $claimTable->amount_received_last = $amount_received_last_page_18;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_18;
                    $claimTable->cheque_date = $cheque_date_page_18;
                    $claimTable->cheque_no = $cheque_no_page_18;
                    $claimTable->bank_name = $bank_name_page_18;
                    $claimTable->reason_remarks = $reason_remarks_page_18;
                    $claimTable->save();
                }
            }
        }else{           
            if($j == 1){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_1_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_1_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_1_page_18,
                    'amount_received' => $amount_received_1_page_18,
                    'amount_balance' => $balance_due_1_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }elseif($j == 2){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_2_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_2_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_2_page_18,
                    'amount_received' => $amount_received_2_page_18,
                    'amount_balance' => $balance_due_2_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }elseif($j == 3){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_3_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_3_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_3_page_18,
                    'amount_received' => $amount_received_3_page_18,
                    'amount_balance' => $balance_due_3_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }elseif($j == 4){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_4_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_4_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_4_page_18,
                    'amount_received' => $amount_received_4_page_18,
                    'amount_balance' => $balance_due_4_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }elseif($j == 5){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_5_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_5_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_5_page_18,
                    'amount_received' => $amount_received_5_page_18,
                    'amount_balance' => $balance_due_5_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }elseif($j == 6){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_6_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_6_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_6_page_18,
                    'amount_received' => $amount_received_6_page_18,
                    'amount_balance' => $balance_due_6_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }elseif($j == 7){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_7_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_7_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_7_page_18,
                    'amount_received' => $amount_received_7_page_18,
                    'amount_balance' => $balance_due_7_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }
            elseif($j == 8){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 18)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_18,
                    'claim_status' => $claim_status_page_18,
                    'reason' => $reason_page_18,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_18,
                    'recovered_amount' => $recovered_amount_page_18,
                    'claim_head_default' => $claim_head_default_8_page_18,
                    'claim_amount_due_default' => $claim_amount_due_default_8_page_18,
                    'total_amount_due_default' => $claim_amount_due_default_page_18,
                    'amount_due' => $amount_due_8_page_18,
                    'amount_received' => $amount_received_8_page_18,
                    'amount_balance' => $balance_due_8_page_18,
                    'total_amount_due' => $amount_due_page_18,
                    'total_amount_received' => $amount_received_page_18,
                    'total_amount_balance' => $balance_due_page_18,
                    'amount_received_last' => $amount_received_last_page_18,
                    'total_amount_cheque' => $total_amount_cheque_page_18,
                    'cheque_date' => $cheque_date_page_18,
                    'cheque_no' => $cheque_no_page_18,
                    'bank_name' => $bank_name_page_18,
                    'reason_remarks' => $reason_remarks_page_18
                ]);    
            }
            
            
            
        }

        
    }
}
