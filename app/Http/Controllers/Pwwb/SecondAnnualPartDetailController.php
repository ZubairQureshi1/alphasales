<?php

namespace App\Http\Controllers\Pwwb;

use App\Fields\FirstAnnualDetailFields;
use Illuminate\Routing\Controller;
use App\Fields\SecondAnnualPartDetailFields;
use App\Fields\SecondAnnualPartResultStatusDetailFields;
use App\Models\Pwwb\SecondAnnualPartDetail;
use App\Models\Pwwb\SecondAnnualPartResultStatusDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use App\Models\Pwwb\Claim;

class SecondAnnualPartDetailController extends Controller
{
    public function post(Request $request)
    {
        $params = $request->all();

        $receipt_status = Arr::get($params, SecondAnnualPartDetailFields::RECEIPT_STATUS);

        $second_part_date_explode = explode('/',Arr::get($params,SecondAnnualPartDetailFields::SECOND_PART_DATE));
        if(count($second_part_date_explode) == 3)
            $second_part_date = Carbon::createFromDate($second_part_date_explode[2],$second_part_date_explode[1],$second_part_date_explode[0])->format('Y-m-d');
        else
            $second_part_date = Arr::get($params, SecondAnnualPartDetailFields::SECOND_PART_DATE);

        $pwwb_status = Arr::get($params, SecondAnnualPartDetailFields::PWWB_STATUS);

        $pwwb_date_explode = explode('/',Arr::get($params,SecondAnnualPartDetailFields::PWWB_DATE));
        if(count($pwwb_date_explode) == 3)
            $pwwb_date = Carbon::createFromDate($pwwb_date_explode[2],$pwwb_date_explode[1],$pwwb_date_explode[0])->format('Y-m-d');
        else
            $pwwb_date = Arr::get($params, SecondAnnualPartDetailFields::PWWB_DATE);

        $diary_pwwb = Arr::get($params, SecondAnnualPartDetailFields::DIARY_PWWB);
        $amount_claim_due = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_CLAIM_DUE);
        $claim_status = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_STATUS);
        $amount_received = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED);

        $claim_date_explode = explode('/',Arr::get($params,SecondAnnualPartDetailFields::CLAIM_DATE));
        if(count($claim_date_explode) == 3)
            $claim_date = Carbon::createFromDate($claim_date_explode[2],$claim_date_explode[1],$claim_date_explode[0])->format('Y-m-d');
        else
            $claim_date = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_DATE);

        $exam_status = Arr::get($params, SecondAnnualPartDetailFields::EXAM_STATUS);

        $exam_date_explode = explode('/',Arr::get($params,SecondAnnualPartDetailFields::EXAM_DATE));
        if(count($exam_date_explode) == 3)
            $exam_date = Carbon::createFromDate($exam_date_explode[2],$exam_date_explode[1],$exam_date_explode[0])->format('Y-m-d');
        else
            $exam_date = Arr::get($params, SecondAnnualPartDetailFields::EXAM_DATE);

        $exam_amount = Arr::get($params, SecondAnnualPartDetailFields::EXAM_AMOUNT);
        $roll_no = Arr::get($params, SecondAnnualPartDetailFields::ROLL_NO);
        $readmissionparttwo = Arr::get($params, SecondAnnualPartDetailFields::READMISSIONPARTTWO);
        $same_course = Arr::get($params, SecondAnnualPartDetailFields::SAME_COURSE);
        $changed_course = Arr::get($params, SecondAnnualPartDetailFields::CHANGED_COURSE);

        //Result Status Details
        $result = Arr::get($params,SecondAnnualPartResultStatusDetailFields::RESULT);
        $fail = Arr::get($params,SecondAnnualPartResultStatusDetailFields::FAIL);
        $next_appearance = Arr::get($params,SecondAnnualPartResultStatusDetailFields::NEXT_APPEARANCE);
        $next_appearance_date = Arr::get($params,SecondAnnualPartResultStatusDetailFields::NEXT_APPEARANCE_DATE);
        $last_chance_date = Arr::get($params,SecondAnnualPartResultStatusDetailFields::LAST_CHANCE_DATE);
        $passing_date = Arr::get($params,SecondAnnualPartResultStatusDetailFields::PASSING_DATE);

        $index_id = Arr::get($params, 'index_id');
        if(!$index_id) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }

        $secondAnnualPartDetail = SecondAnnualPartDetail::where(SecondAnnualPartDetailFields::INDEX_TABLE_ID,$index_id)->first();
        if(!$secondAnnualPartDetail){
            $secondAnnualPartDetail = new SecondAnnualPartDetail();
        }

        $secondAnnualPartDetail->index_table_id = $index_id;
        $secondAnnualPartDetail->receipt_status = $receipt_status;
        $secondAnnualPartDetail->second_part_date = $second_part_date;
        $secondAnnualPartDetail->pwwb_status = $pwwb_status;
        $secondAnnualPartDetail->pwwb_date = $pwwb_date;
        $secondAnnualPartDetail->diary_pwwb = $diary_pwwb;
        $secondAnnualPartDetail->amount_claim_due = $amount_claim_due;
        $secondAnnualPartDetail->claim_status = $claim_status;
        $secondAnnualPartDetail->amount_received = $amount_received;
        $secondAnnualPartDetail->claim_date = $claim_date;
        $secondAnnualPartDetail->exam_status = $exam_status;
        $secondAnnualPartDetail->exam_date = $exam_date;
        $secondAnnualPartDetail->exam_amount = $exam_amount;
        $secondAnnualPartDetail->roll_no = $roll_no;
        $secondAnnualPartDetail->readmissionparttwo = $readmissionparttwo;
        $secondAnnualPartDetail->same_course = $same_course;
        $secondAnnualPartDetail->changed_course = $changed_course;
        $secondAnnualPartDetail->save();

        // Claims Fileds Start
        $page_number = '16';
        $claim_due_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_DUE_PAGE_16);
        $claim_status_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_STATUS_PAGE_16);
        $reason_page_16 = Arr::get($params, SecondAnnualPartDetailFields::REASON_PAGE_16);
        $outstanding_cfe_fee_page_16 = Arr::get($params, SecondAnnualPartDetailFields::OUTSTANDING_CFE_FEE_PAGE_16);
        $recovered_amount_page_16 = Arr::get($params, SecondAnnualPartDetailFields::RECOVERED_AMOUNT_PAGE_16);
        $claim_head_default_1_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_1_PAGE_16);
        $claim_head_default_2_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_2_PAGE_16);
        $claim_head_default_3_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_3_PAGE_16);
        $claim_head_default_4_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_4_PAGE_16);
        $claim_head_default_5_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_5_PAGE_16);
        $claim_head_default_6_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_6_PAGE_16);
        $claim_head_default_7_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_7_PAGE_16);
        $claim_head_default_8_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_HEAD_DEFAULT_8_PAGE_16);
        $claim_amount_due_default_1_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_1_PAGE_16);
        $claim_amount_due_default_2_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_2_PAGE_16);
        $claim_amount_due_default_3_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_3_PAGE_16);
        $claim_amount_due_default_4_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_4_PAGE_16);
        $claim_amount_due_default_5_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_5_PAGE_16);
        $claim_amount_due_default_6_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_6_PAGE_16);
        $claim_amount_due_default_7_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_7_PAGE_16);
        $claim_amount_due_default_8_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_8_PAGE_16);
        $claim_amount_due_default_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CLAIM_AMOUNT_DUE_DEFAULT_PAGE_16);
        $type_of_claim_1_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_1_PAGE_16);
        $type_of_claim_2_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_2_PAGE_16);
        $type_of_claim_3_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_3_PAGE_16);
        $type_of_claim_4_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_4_PAGE_16);
        $type_of_claim_5_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_5_PAGE_16);
        $type_of_claim_6_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_6_PAGE_16);
        $type_of_claim_7_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_7_PAGE_16);
        $type_of_claim_8_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TYPE_OF_CLAIM_8_PAGE_16);
        $amount_due_1_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_1_PAGE_16);
        $amount_received_1_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_1_PAGE_16);
        $balance_due_1_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_1_PAGE_16);
        $amount_due_2_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_2_PAGE_16);
        $amount_received_2_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_2_PAGE_16);
        $balance_due_2_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_2_PAGE_16);
        $amount_due_3_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_3_PAGE_16);
        $amount_received_3_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_3_PAGE_16);
        $balance_due_3_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_3_PAGE_16);
        $amount_due_4_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_4_PAGE_16);
        $amount_received_4_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_4_PAGE_16);
        $balance_due_4_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_4_PAGE_16);
        $amount_due_5_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_5_PAGE_16);
        $amount_received_5_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_5_PAGE_16);
        $balance_due_5_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_5_PAGE_16);
        $amount_due_6_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_6_PAGE_16);
        $amount_received_6_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_6_PAGE_16);
        $balance_due_6_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_6_PAGE_16);
        $amount_due_7_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_7_PAGE_16);
        $amount_received_7_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_7_PAGE_16);
        $balance_due_7_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_7_PAGE_16);
        $amount_due_8_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_8_PAGE_16);
        $amount_received_8_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_8_PAGE_16);
        $balance_due_8_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_8_PAGE_16);
        $amount_due_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_DUE_PAGE_16);
        $amount_received_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_PAGE_16);
        $balance_due_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BALANCE_DUE_PAGE_16);
        $amount_received_last_page_16 = Arr::get($params, SecondAnnualPartDetailFields::AMOUNT_RECEIVED_LAST_PAGE_16);
        $total_amount_cheque_page_16 = Arr::get($params, SecondAnnualPartDetailFields::TOTAL_AMOUNT_CHEQUE_PAGE_16);
        $cheque_date_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CHEQUE_DATE_PAGE_16);
        $cheque_no_page_16 = Arr::get($params, SecondAnnualPartDetailFields::CHEQUE_NO_PAGE_16);
        $bank_name_page_16 = Arr::get($params, SecondAnnualPartDetailFields::BANK_NAME_PAGE_16);
        $reason_remarks_page_16 = Arr::get($params, SecondAnnualPartDetailFields::REASON_REMARKS_PAGE_16);

        


        // $reason = Arr::get($params,SecondAnnualPartDetailFields::REASON);
        // $cfe_fee = Arr::get($params,SecondAnnualPartDetailFields::CFE_FEE);
        // $recovery_from_student = Arr::get($params,SecondAnnualPartDetailFields::RECOVERY_FROM_STUDENT);
        $checkIfClaimExists = Claim::where(SecondAnnualPartDetailFields::INDEX_TABLE_ID,$index_id)->where('page_number', '=', 16)->first();
        if(!$checkIfClaimExists){
            // Claims Fields End
            $this->claimsStore(
                '1a',
                '1a',
                'claimAdd',
                $page_number,
                $index_id,
                $claim_due_page_16,
                $claim_status_page_16,
                $reason_page_16,
                $outstanding_cfe_fee_page_16,
                $recovered_amount_page_16,
                $claim_head_default_1_page_16,
                $claim_head_default_2_page_16,
                $claim_head_default_3_page_16,
                $claim_head_default_4_page_16,
                $claim_head_default_5_page_16,
                $claim_head_default_6_page_16,
                $claim_head_default_7_page_16,
                $claim_head_default_8_page_16,
                $claim_amount_due_default_1_page_16,
                $claim_amount_due_default_2_page_16,
                $claim_amount_due_default_3_page_16,
                $claim_amount_due_default_4_page_16,
                $claim_amount_due_default_5_page_16,
                $claim_amount_due_default_6_page_16,
                $claim_amount_due_default_7_page_16,
                $claim_amount_due_default_8_page_16,
                $claim_amount_due_default_page_16,
                $type_of_claim_1_page_16,
                $type_of_claim_2_page_16,
                $type_of_claim_3_page_16,
                $type_of_claim_4_page_16,
                $type_of_claim_5_page_16,
                $type_of_claim_6_page_16,
                $type_of_claim_7_page_16,
                $type_of_claim_8_page_16,
                $amount_due_1_page_16,
                $amount_received_1_page_16,
                $balance_due_1_page_16,
                $amount_due_2_page_16,
                $amount_received_2_page_16,
                $balance_due_2_page_16,
                $amount_due_3_page_16,
                $amount_received_3_page_16,
                $balance_due_3_page_16,
                $amount_due_4_page_16,
                $amount_received_4_page_16,
                $balance_due_4_page_16,
                $amount_due_5_page_16,
                $amount_received_5_page_16,
                $balance_due_5_page_16,
                $amount_due_6_page_16,
                $amount_received_6_page_16,
                $balance_due_6_page_16,
                $amount_due_7_page_16,
                $amount_received_7_page_16,
                $balance_due_7_page_16,
                $amount_due_8_page_16,
                $amount_received_8_page_16,
                $balance_due_8_page_16,
                $amount_due_page_16,
                $amount_received_page_16,
                $balance_due_page_16,
                $amount_received_last_page_16,
                $total_amount_cheque_page_16,
                $cheque_date_page_16,
                $cheque_no_page_16,
                $bank_name_page_16,
                $reason_remarks_page_16
            );
        }
        else{
            $claimindex_id = Claim::where(SecondAnnualPartDetailFields::INDEX_TABLE_ID, '=', $index_id)->where('page_number', 16)->get();
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
                        $claim_due_page_16,
                        $claim_status_page_16,
                        $reason_page_16,
                        $outstanding_cfe_fee_page_16,
                $recovered_amount_page_16,
                        $claim_head_default_1_page_16,
                        $claim_head_default_2_page_16,
                        $claim_head_default_3_page_16,
                        $claim_head_default_4_page_16,
                        $claim_head_default_5_page_16,
                        $claim_head_default_6_page_16,
                        $claim_head_default_7_page_16,
                        $claim_head_default_8_page_16,
                        $claim_amount_due_default_1_page_16,
                        $claim_amount_due_default_2_page_16,
                        $claim_amount_due_default_3_page_16,
                        $claim_amount_due_default_4_page_16,
                        $claim_amount_due_default_5_page_16,
                        $claim_amount_due_default_6_page_16,
                        $claim_amount_due_default_7_page_16,
                        $claim_amount_due_default_8_page_16,
                        $claim_amount_due_default_page_16,
                        $type_of_claim_1_page_16,
                        $type_of_claim_2_page_16,
                        $type_of_claim_3_page_16,
                        $type_of_claim_4_page_16,
                        $type_of_claim_5_page_16,
                        $type_of_claim_6_page_16,
                        $type_of_claim_7_page_16,
                        $type_of_claim_8_page_16,
                        $amount_due_1_page_16,
                        $amount_received_1_page_16,
                        $balance_due_1_page_16,
                        $amount_due_2_page_16,
                        $amount_received_2_page_16,
                        $balance_due_2_page_16,
                        $amount_due_3_page_16,
                        $amount_received_3_page_16,
                        $balance_due_3_page_16,
                        $amount_due_4_page_16,
                        $amount_received_4_page_16,
                        $balance_due_4_page_16,
                        $amount_due_5_page_16,
                        $amount_received_5_page_16,
                        $balance_due_5_page_16,
                        $amount_due_6_page_16,
                        $amount_received_6_page_16,
                        $balance_due_6_page_16,
                        $amount_due_7_page_16,
                        $amount_received_7_page_16,
                        $balance_due_7_page_16,
                        $amount_due_8_page_16,
                        $amount_received_8_page_16,
                        $balance_due_8_page_16,
                        $amount_due_page_16,
                        $amount_received_page_16,
                        $balance_due_page_16,
                        $amount_received_last_page_16,
                        $total_amount_cheque_page_16,
                        $cheque_date_page_16,
                        $cheque_no_page_16,
                        $bank_name_page_16,
                        $reason_remarks_page_16
                    );


             // }
            }
        }


        if (!$index_id) {
            for ($i = 0; $i < count($result); $i++) {
                $secondAnnualPartResultStatusDetail = new SecondAnnualPartResultStatusDetail();
                $this->fillSecondAnnualPartResultStatusDetailData($i, $secondAnnualPartResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
            }
        } else {
            $j = 0;
            foreach (SecondAnnualPartResultStatusDetail::where('index_table_id', $index_id)->get() as $secondAnnualPartResultStatusDetail) {
                $secondAnnualPartResultStatusDetailSingle = SecondAnnualPartResultStatusDetail::find($secondAnnualPartResultStatusDetail->id);
                $this->fillSecondAnnualPartResultStatusDetailData($j, $secondAnnualPartResultStatusDetailSingle, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                $j++;
            }
            if ($j < count($result)) {
                for ($k = $j; $k < count($result); $k++) {
                    $secondAnnualPartResultStatusDetail = new SecondAnnualPartResultStatusDetail();
                    $this->fillSecondAnnualPartResultStatusDetailData($k, $secondAnnualPartResultStatusDetail, $index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
        ], 200);
    }

    private function fillSecondAnnualPartResultStatusDetailData($index,$secondAnnualPartResultStatusDetailObject,$index_id, $result, $fail, $next_appearance, $next_appearance_date, $last_chance_date, $passing_date){
        $secondAnnualPartResultStatusDetailObject->index_table_id = $index_id;
        $secondAnnualPartResultStatusDetailObject->result = isset($result[$index]) ? $result[$index] : null;
        $secondAnnualPartResultStatusDetailObject->fail = isset($fail[$index]) ? $fail[$index] : null;
        $secondAnnualPartResultStatusDetailObject->next_appearance = isset($next_appearance[$index]) ? $next_appearance[$index] : null;
        $NextAppearance = null;
        if(isset($next_appearance_date[$index])){
            $NextAppearanceExplode = explode('/',$next_appearance_date[$index]);
            if(count($NextAppearanceExplode) == 3)
                $NextAppearance = Carbon::createFromDate($NextAppearanceExplode[2],$NextAppearanceExplode[1],$NextAppearanceExplode[0])->format('Y-m-d');
            else
                $NextAppearance = $next_appearance_date[$index];
        }
        $secondAnnualPartResultStatusDetailObject->next_appearance_date = $NextAppearance;

        $LastChance = null;
        if(isset($last_chance_date[$index])){
            $LastChanceExplode = explode('/',$last_chance_date[$index]);
            if(count($LastChanceExplode) == 3)
                $LastChance = Carbon::createFromDate($LastChanceExplode[2],$LastChanceExplode[1],$LastChanceExplode[0])->format('Y-m-d');
            else
                $LastChance = $last_chance_date[$index];
        }
        $secondAnnualPartResultStatusDetailObject->last_chance_date = $LastChance;

        $Passing = null;
        if(isset($passing_date[$index])){
            $PassingExplode = explode('/',$passing_date[$index]);
            if(count($PassingExplode) == 3)
                $Passing = Carbon::createFromDate($PassingExplode[2],$PassingExplode[1],$PassingExplode[0])->format('Y-m-d');
            else
                $Passing = $passing_date[$index];
        }
        $secondAnnualPartResultStatusDetailObject->passing_date = $Passing;
        $secondAnnualPartResultStatusDetailObject->save();
    }

    public function deleteSecondAnnualResultStatusDetail(Request $request){
        $params = $request->all();
        $id = Arr::get($params,SecondAnnualPartResultStatusDetailFields::ID);
        $indexId = Arr::get($params,'index_id');
        $object = SecondAnnualPartResultStatusDetail::where('id',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }

    public function claimsStore($j,$indexes,$claim,$page_number,
                $index_id,
                $claim_due_page_16,
                $claim_status_page_16,
                $reason_page_16,
                $outstanding_cfe_fee_page_16,
                $recovered_amount_page_16,
                $claim_head_default_1_page_16,
                $claim_head_default_2_page_16,
                $claim_head_default_3_page_16,
                $claim_head_default_4_page_16,
                $claim_head_default_5_page_16,
                $claim_head_default_6_page_16,
                $claim_head_default_7_page_16,
                $claim_head_default_8_page_16,
                $claim_amount_due_default_1_page_16,
                $claim_amount_due_default_2_page_16,
                $claim_amount_due_default_3_page_16,
                $claim_amount_due_default_4_page_16,
                $claim_amount_due_default_5_page_16,
                $claim_amount_due_default_6_page_16,
                $claim_amount_due_default_7_page_16,
                $claim_amount_due_default_8_page_16,
                $claim_amount_due_default_page_16,
                $type_of_claim_1_page_16,
                $type_of_claim_2_page_16,
                $type_of_claim_3_page_16,
                $type_of_claim_4_page_16,
                $type_of_claim_5_page_16,
                $type_of_claim_6_page_16,
                $type_of_claim_7_page_16,
                $type_of_claim_8_page_16,
                $amount_due_1_page_16,
                $amount_received_1_page_16,
                $balance_due_1_page_16,
                $amount_due_2_page_16,
                $amount_received_2_page_16,
                $balance_due_2_page_16,
                $amount_due_3_page_16,
                $amount_received_3_page_16,
                $balance_due_3_page_16,
                $amount_due_4_page_16,
                $amount_received_4_page_16,
                $balance_due_4_page_16,
                $amount_due_5_page_16,
                $amount_received_5_page_16,
                $balance_due_5_page_16,
                $amount_due_6_page_16,
                $amount_received_6_page_16,
                $balance_due_6_page_16,
                $amount_due_7_page_16,
                $amount_received_7_page_16,
                $balance_due_7_page_16,
                $amount_due_8_page_16,
                $amount_received_8_page_16,
                $balance_due_8_page_16,
                $amount_due_page_16,
                $amount_received_page_16,
                $balance_due_page_16,
                $amount_received_last_page_16,
                $total_amount_cheque_page_16,
                $cheque_date_page_16,
                $cheque_no_page_16,
                $bank_name_page_16,
                $reason_remarks_page_16){
        $index_id = request('index_id');
        if($indexes == '1a') {
            for($i = 1; $i<= 8; $i++){           
                if($i ==1){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 1;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_1_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_1_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_1_page_16;
                    $claimTable->amount_due = $amount_due_1_page_16;
                    $claimTable->amount_received = $amount_received_1_page_16;
                    $claimTable->amount_balance = $balance_due_1_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;

                    $claimTable->save();
                }
                elseif($i ==2){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 2;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_2_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_2_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_2_page_16;
                    $claimTable->amount_due = $amount_due_2_page_16;
                    $claimTable->amount_received = $amount_received_2_page_16;
                    $claimTable->amount_balance = $balance_due_2_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
                elseif($i ==3){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 3;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_3_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_3_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_3_page_16;
                    $claimTable->amount_due = $amount_due_3_page_16;
                    $claimTable->amount_received = $amount_received_3_page_16;
                    $claimTable->amount_balance = $balance_due_3_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
                elseif($i ==4){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 4;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_4_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_4_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_4_page_16;
                    $claimTable->amount_due = $amount_due_4_page_16;
                    $claimTable->amount_received = $amount_received_4_page_16;
                    $claimTable->amount_balance = $balance_due_4_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
                elseif($i ==5){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 5;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_5_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_5_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_5_page_16;
                    $claimTable->amount_due = $amount_due_5_page_16;
                    $claimTable->amount_received = $amount_received_5_page_16;
                    $claimTable->amount_balance = $balance_due_5_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
                elseif($i ==6){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 6;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_6_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_6_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_6_page_16;
                    $claimTable->amount_due = $amount_due_6_page_16;
                    $claimTable->amount_received = $amount_received_6_page_16;
                    $claimTable->amount_balance = $balance_due_6_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
                elseif($i ==7){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 7;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_7_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_7_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_7_page_16;
                    $claimTable->amount_due = $amount_due_7_page_16;
                    $claimTable->amount_received = $amount_received_7_page_16;
                    $claimTable->amount_balance = $balance_due_7_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
                elseif($i ==8){
                    $claimTable = new Claim();
                    $claimTable->serial_no = 8;
                    $claimTable->page_number = $page_number;
                    $claimTable->index_table_id = $index_id;
                    $claimTable->claim_due = $claim_due_page_16;
                    $claimTable->claim_status = $claim_status_page_16;
                    $claimTable->reason = $reason_page_16;
                    $claimTable->outstanding_cfe_fee = $outstanding_cfe_fee_page_16;
                    $claimTable->recovered_amount = $recovered_amount_page_16;
                    $claimTable->claim_head_default = $claim_head_default_8_page_16;
                    $claimTable->claim_amount_due_default = $claim_amount_due_default_8_page_16;
                    $claimTable->total_amount_due_default = $claim_amount_due_default_page_16;
                    $claimTable->claim_head = $type_of_claim_8_page_16;
                    $claimTable->amount_due = $amount_due_8_page_16;
                    $claimTable->amount_received = $amount_received_8_page_16;
                    $claimTable->amount_balance = $balance_due_8_page_16;        
                    $claimTable->total_amount_due = $amount_due_page_16;
                    $claimTable->total_amount_received = $amount_received_page_16;
                    $claimTable->total_amount_balance = $balance_due_page_16;
                    $claimTable->amount_received_last = $amount_received_last_page_16;
                    $claimTable->total_amount_cheque = $total_amount_cheque_page_16;
                    $claimTable->cheque_date = $cheque_date_page_16;
                    $claimTable->cheque_no = $cheque_no_page_16;
                    $claimTable->bank_name = $bank_name_page_16;
                    $claimTable->reason_remarks = $reason_remarks_page_16;
                    $claimTable->save();
                }
            }
        }else{           
            if($j == 1){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_1_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_1_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_1_page_16,
                    'amount_received' => $amount_received_1_page_16,
                    'amount_balance' => $balance_due_1_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }elseif($j == 2){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_2_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_2_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_2_page_16,
                    'amount_received' => $amount_received_2_page_16,
                    'amount_balance' => $balance_due_2_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }elseif($j == 3){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_3_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_3_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_3_page_16,
                    'amount_received' => $amount_received_3_page_16,
                    'amount_balance' => $balance_due_3_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }elseif($j == 4){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_4_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_4_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_4_page_16,
                    'amount_received' => $amount_received_4_page_16,
                    'amount_balance' => $balance_due_4_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }elseif($j == 5){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_5_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_5_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_5_page_16,
                    'amount_received' => $amount_received_5_page_16,
                    'amount_balance' => $balance_due_5_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }elseif($j == 6){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_6_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_6_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_6_page_16,
                    'amount_received' => $amount_received_6_page_16,
                    'amount_balance' => $balance_due_6_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }elseif($j == 7){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_7_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_7_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_7_page_16,
                    'amount_received' => $amount_received_7_page_16,
                    'amount_balance' => $balance_due_7_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }
            elseif($j == 8){
                $claimTableUpdate = Claim::where('id', '=', $indexes)->where('serial_no', '=', $j)->where('page_number', '=', 16)->update([
                    'page_number' => $page_number,
                    'claim_due' => $claim_due_page_16,
                    'claim_status' => $claim_status_page_16,
                    'reason' => $reason_page_16,
                    'outstanding_cfe_fee' => $outstanding_cfe_fee_page_16,
                    'recovered_amount' => $recovered_amount_page_16,
                    'claim_head_default' => $claim_head_default_8_page_16,
                    'claim_amount_due_default' => $claim_amount_due_default_8_page_16,
                    'total_amount_due_default' => $claim_amount_due_default_page_16,
                    'amount_due' => $amount_due_8_page_16,
                    'amount_received' => $amount_received_8_page_16,
                    'amount_balance' => $balance_due_8_page_16,
                    'total_amount_due' => $amount_due_page_16,
                    'total_amount_received' => $amount_received_page_16,
                    'total_amount_balance' => $balance_due_page_16,
                    'amount_received_last' => $amount_received_last_page_16,
                    'total_amount_cheque' => $total_amount_cheque_page_16,
                    'cheque_date' => $cheque_date_page_16,
                    'cheque_no' => $cheque_no_page_16,
                    'bank_name' => $bank_name_page_16,
                    'reason_remarks' => $reason_remarks_page_16
                ]);    
            }
            
            
            
        }

        
    }
}
