<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\FactoryDeathManagerFields;
use App\Fields\FactoryDeathManagerDetailContactFields;
use App\Models\Pwwb\FactoryDeathManagerDetail;
use App\Models\Pwwb\FactoryDeathManagerDetailContact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class FactoryDeathManagerDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');

        $worker_death_date_explode = explode('/',Arr::get($params,FactoryDeathManagerFields::DEATH_DATE_OF_WORKER));
        if(count($worker_death_date_explode) == 3)
            $deathDateOfWorker = Carbon::createFromDate($worker_death_date_explode[2],$worker_death_date_explode[1],$worker_death_date_explode[0])->format('Y-m-d');
        else
            $deathDateOfWorker = Arr::get($params,FactoryDeathManagerFields::DEATH_DATE_OF_WORKER);

        $deathGrantClaimed = Arr::get($params,FactoryDeathManagerFields::DEATH_GRANT_CLAIMED);

        $worker_retirement_date_explode = explode('/',Arr::get($params,FactoryDeathManagerFields::RETIREMENT_DATE_OF_WORKER));
        if(count($worker_retirement_date_explode) == 3)
            $retirementDateOfWorker = Carbon::createFromDate($worker_retirement_date_explode[2],$worker_retirement_date_explode[1],$worker_retirement_date_explode[0])->format('Y-m-d');
        else
            $retirementDateOfWorker = Arr::get($params,FactoryDeathManagerFields::RETIREMENT_DATE_OF_WORKER);

        $factoryManagerName = Arr::get($params,FactoryDeathManagerFields::FACTORY_MANAGER_NAME);
        $factoryManagerDesignation = Arr::get($params,FactoryDeathManagerFields::FACTORY_MANAGER_DESIGNATION);
        $factoryManagerContactNo = Arr::get($params,FactoryDeathManagerFields::FACTORY_MANAGER_CONTACT_NO);
        $factoryManagerEmail = Arr::get($params,FactoryDeathManagerFields::FACTORY_MANAGER_EMAIL);
        $formAttestedByManagerSign = Arr::get($params,FactoryDeathManagerFields::FORM_ATTESTED_BY_MANAGER_SIGN);
        $formAttestedByManagerStamp = Arr::get($params,FactoryDeathManagerFields::FORM_ATTESTED_BY_MANAGER_STAMP);
        $formAttestedByDOLSign = Arr::get($params,FactoryDeathManagerFields::FORM_ATTESTED_BY_DOL_SIGN);
        $formAttestedByDOLStamp = Arr::get($params,FactoryDeathManagerFields::FORM_ATTESTED_BY_DOL_STAMP);

        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = FactoryDeathManagerDetail::where(FactoryDeathManagerFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new FactoryDeathManagerDetail();
            }
        }
                $object->index_table_id = $indexTableId;
                $object->death_date_of_worker = $deathDateOfWorker;
                $object->death_grant_claimed = $deathGrantClaimed;
                $object->retirement_date_of_worker = $retirementDateOfWorker;
                $object->factory_manager_name = $factoryManagerName;
                $object->factory_manager_designation = $factoryManagerDesignation;
                $object->factory_manager_contact_no = $factoryManagerContactNo;
                $object->factory_manager_email = $factoryManagerEmail;
                $object->form_attested_by_manager_sign = $formAttestedByManagerSign;
                $object->form_attested_by_manager_stamp = $formAttestedByManagerStamp;
                $object->form_attested_by_dol_sign = $formAttestedByDOLSign;
                $object->form_attested_by_dol_stamp = $formAttestedByDOLStamp;
                $object->save();
                // if($request->factory_manager_contact_nos[0] != null)
                // {
                //     foreach($request->factory_manager_contact_nos as $factory_manager_contact)
                //     {
                //         $factory_death_manager_detail_contacts = new FactoryDeathManagerDetailContact();
                //         $factory_death_manager_detail_contacts->f_d_m_d_contact_id = $object->id;
                //         $factory_death_manager_detail_contacts->contact_number = $factory_manager_contact;
                //         $factory_death_manager_detail_contacts->save();
                //     }
                // }
            //manager Contact Number
        $serialNo = Arr::get($params, FactoryDeathManagerDetailContactFields::SERIAL_NO);
        $managerContactRelationship = Arr::get($params, FactoryDeathManagerDetailContactFields::MANAGER_CONTACT_RELATIONSHIP);
        $managerSpecifyRelationship = Arr::get($params, FactoryDeathManagerDetailContactFields::MANAGER_SPECIFY_RELATIONSHIP);
        $contactNumber = Arr::get($params, FactoryDeathManagerDetailContactFields::CONTACT_NO);


        if (!$indexTableId) {
            for ($i = 0; $i < count($serialNo); $i++) {
                $FactoryDeathManagerDetailContact = new FactoryDeathManagerDetailContact();
                $this->fillFactoryDeathManagerDetailContactData($i, $FactoryDeathManagerDetailContact, $indexTableId,$serialNo, $managerContactRelationship, $managerSpecifyRelationship, $contactNumber);
            }
        } else {
            $j = 0;
            foreach (FactoryDeathManagerDetailContact::where('index_table_id', $indexTableId)->get() as $FactoryDeathManagerDetailContact) {
                $FactoryDeathManagerDetailContactSingle = FactoryDeathManagerDetailContact::find($FactoryDeathManagerDetailContact->id);
                $this->fillFactoryDeathManagerDetailContactData($j, $FactoryDeathManagerDetailContactSingle, $indexTableId,$serialNo, $managerContactRelationship, $managerSpecifyRelationship, $contactNumber);
                $j++;
            }
            if ($j < count($serialNo)) {
                for ($k = $j; $k < count($serialNo); $k++) {
                    $FactoryDeathManagerDetailContact = new FactoryDeathManagerDetailContact();
                    $this->fillFactoryDeathManagerDetailContactData($k, $FactoryDeathManagerDetailContact, $indexTableId, $serialNo, $managerContactRelationship, $managerSpecifyRelationship, $contactNumber);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }

private function fillFactoryDeathManagerDetailContactData($index,$FactoryDeathManagerDetailContactObject,$indexTableId, $serialNo, $managerContactRelationship, $managerSpecifyRelationship, $contactNumber){
        $FactoryDeathManagerDetailContactObject->index_table_id = $indexTableId;
        $FactoryDeathManagerDetailContactObject->serial_no = isset($serialNo[$index]) ? $serialNo[$index] : null;
        $FactoryDeathManagerDetailContactObject->manager_contact_relationship = isset($managerContactRelationship[$index]) ? $managerContactRelationship[$index] : null;
        $FactoryDeathManagerDetailContactObject->manager_specify_relationship = isset($managerSpecifyRelationship[$index]) ? $managerSpecifyRelationship[$index] : null;
        $FactoryDeathManagerDetailContactObject->contact_number = isset($contactNumber[$index]) ? $contactNumber[$index] : null;
        $FactoryDeathManagerDetailContactObject->save();
    }

    public function deleteFactoryDeathManagerDetailContact(Request $request){
        $params = $request->all();
        $id = Arr::get($params,FactoryDeathManagerDetailContactFields::SERIAL_NO);
        $indexId = Arr::get($params,'index_id');
        $object = FactoryDeathManagerDetailContact::where('serial_no',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }
}

