<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\WorkerBankSecurityDetailFields;
use App\Models\Pwwb\WorkerBankSecurityDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class WorkerBankSecurityDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');
        $socialSecurity = Arr::get($params,WorkerBankSecurityDetailFields::SOCIAL_SECURITY);
        $socialSecurityAttested = Arr::get($params,WorkerBankSecurityDetailFields::SOCIAL_SECURITY_ATTESTED);
        $socialSecurityOfficeName = Arr::get($params,WorkerBankSecurityDetailFields::SOCIAL_SECURITY_OFFICE_NAME);
        $eobiNumber = Arr::get($params,WorkerBankSecurityDetailFields::EOBI_NUMBER);
        $eobiCardAttested = Arr::get($params,WorkerBankSecurityDetailFields::EOBI_CARD_ATTESTED);
        $nameOfBank = Arr::get($params,WorkerBankSecurityDetailFields::NAME_OF_BANK);
        $bankBranchAddress = Arr::get($params,WorkerBankSecurityDetailFields::BANK_BRANCH_ADDRESS);
        $bankBranchCode = Arr::get($params,WorkerBankSecurityDetailFields::BANK_BRANCH_CODE);
        $bankIBAN = Arr::get($params,WorkerBankSecurityDetailFields::BANK_IBAN);
        $permanentAddress = Arr::get($params,WorkerBankSecurityDetailFields::PERMANENT_ADDRESS);
        $temporaryAddress = Arr::get($params,WorkerBankSecurityDetailFields::TEMPORARY_ADDRESS);

        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = WorkerBankSecurityDetail::where(WorkerBankSecurityDetailFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new WorkerBankSecurityDetail();
            }
        }

        $object->index_table_id = $indexTableId;
        $object->social_security = $socialSecurity;
        $object->social_security_attested = $socialSecurityAttested;
        $object->social_security_office_name = $socialSecurityOfficeName;
        $object->eobi_number = $eobiNumber;
        $object->eobi_card_attested = $eobiCardAttested;
        $object->name_of_bank = $nameOfBank;
        $object->bank_branch_address = $bankBranchAddress;
        $object->bank_branch_code = $bankBranchCode;
        $object->bank_iban = $bankIBAN;
        $object->permanent_address = $permanentAddress;
        $object->temporary_address = $temporaryAddress;
        $object->save();

        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }
}
