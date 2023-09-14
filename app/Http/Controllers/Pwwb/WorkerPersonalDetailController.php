<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\WorkerContactNumberFields;
use App\Fields\WorkerPersonalDetailFields;
use App\Models\Pwwb\WorkerContactNumber;
use App\Models\Pwwb\WorkerPersonalDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
class WorkerPersonalDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');
        $photographUploaded = Arr::get($params,WorkerPersonalDetailFields::PHOTOGRAPH_UPLOADED);
        $photographAttested = Arr::get($params,WorkerPersonalDetailFields::PHOTOGRAPH_ATTESTED);
        $photographQuantity = Arr::get($params,WorkerPersonalDetailFields::PHOTOGRAPH_QUANTITY);
        $workerName = Arr::get($params,WorkerPersonalDetailFields::WORKER_NAME);
        $applicantName = Arr::get($params,WorkerPersonalDetailFields::APPLICANT_NAME);
        $workerCNIC = Arr::get($params,WorkerPersonalDetailFields::WORKER_CNIC);
        $workerCNICAttested = Arr::get($params,WorkerPersonalDetailFields::WORKER_CNIC_ATTESTED);
        $workerCurrentStatus = Arr::get($params,WorkerPersonalDetailFields::WORKER_CURRENT_STATUS);
        $workerJobNature = Arr::get($params,WorkerPersonalDetailFields::WORKER_JOB_NATURE);
        $factoryStatus = Arr::get($params,WorkerPersonalDetailFields::FACTORY_STATUS);
        $workerRelationship = Arr::get($params,WorkerPersonalDetailFields::WORKER_RELATIONSHIP);
        $specifyRelationship = Arr::get($params,WorkerPersonalDetailFields::SPECIFY_RELATIONSHIP);

        $birth_date_explode = explode('/',Arr::get($params,WorkerPersonalDetailFields::DATE_OF_BIRTH));
        if(count($birth_date_explode) == 3)
            $dateOfBirth = Carbon::createFromDate($birth_date_explode[2],$birth_date_explode[1],$birth_date_explode[0])->format('Y-m-d');
        else
            $dateOfBirth = Arr::get($params,WorkerPersonalDetailFields::DATE_OF_BIRTH);
        $pwwbScholarshipForm = Arr::get($params,WorkerPersonalDetailFields::PWWB_SCHOLARSHIP_FORM);
        $factoryCard = Arr::get($params,WorkerPersonalDetailFields::FACTORY_CARD);
        $serviceLetter = Arr::get($params,WorkerPersonalDetailFields::SERVICE_LETTER);

        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = WorkerPersonalDetail::where(WorkerPersonalDetailFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new WorkerPersonalDetail();
            }
        }

        $object->index_table_id = $indexTableId;
        $object->photograph_uploaded = $photographUploaded;
        $object->photograph_attested = $photographAttested;
        $object->photograph_quantity = $photographQuantity;
        $object->worker_name = $workerName;
        $object->applicant_name = $applicantName;
        $object->worker_cnic = $workerCNIC;
        $object->worker_cnic_attested = $workerCNICAttested;
        $object->worker_current_status = $workerCurrentStatus;
        $object->worker_job_nature = $workerJobNature;
        $object->factory_status = $factoryStatus;
        $object->worker_relationship = $workerRelationship;
        $object->specify_relationship = $specifyRelationship;
        $object->date_of_birth = $dateOfBirth;
        $object->pwwb_scholarship_form = $pwwbScholarshipForm;
        $object->factory_card = $factoryCard;
        $object->service_letter = $serviceLetter;
        $object->save();

        //Worker Contact Number
        $serialNo = Arr::get($params, WorkerContactNumberFields::SERIAL_NO);
        $workerContactRelationship = Arr::get($params, WorkerContactNumberFields::WORKER_CONTACT_RELATIONSHIP);
        $workerSpecifyRelationship = Arr::get($params, WorkerContactNumberFields::WORKER_SPECIFY_RELATIONSHIP);
        $contactNo = Arr::get($params, WorkerContactNumberFields::CONTACT_NO);


        if (!$indexTableId) {
            for ($i = 0; $i < count($serialNo); $i++) {
                $workerContactNumber = new WorkerContactNumber();
                $this->fillWorkerContactNumberData($i, $workerContactNumber, $indexTableId,$serialNo, $workerContactRelationship, $workerSpecifyRelationship, $contactNo);
            }
        } else {
            $j = 0;
            foreach (WorkerContactNumber::where('index_table_id', $indexTableId)->get() as $workerContactNumber) {
                $workerContactNumberSingle = WorkerContactNumber::find($workerContactNumber->id);
                $this->fillWorkerContactNumberData($j, $workerContactNumberSingle, $indexTableId,$serialNo, $workerContactRelationship, $workerSpecifyRelationship, $contactNo);
                $j++;
            }
            if ($j < count($serialNo)) {
                for ($k = $j; $k < count($serialNo); $k++) {
                    $workerContactNumber = new WorkerContactNumber();
                    $this->fillWorkerContactNumberData($k, $workerContactNumber, $indexTableId, $serialNo, $workerContactRelationship, $workerSpecifyRelationship, $contactNo);
                }
            }
        }


        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }

    private function fillWorkerContactNumberData($index,$workerContactNumberObject,$indexTableId, $serialNo, $workerContactRelationship, $workerSpecifyRelationship, $contactNo){
        $workerContactNumberObject->index_table_id = $indexTableId;
        $workerContactNumberObject->serial_no = isset($serialNo[$index]) ? $serialNo[$index] : null;
        $workerContactNumberObject->worker_contact_relationship = isset($workerContactRelationship[$index]) ? $workerContactRelationship[$index] : null;
        $workerContactNumberObject->specify_relationship_2 = isset($workerSpecifyRelationship[$index]) ? $workerSpecifyRelationship[$index] : null;
        $workerContactNumberObject->contact_no = isset($contactNo[$index]) ? $contactNo[$index] : null;
        $workerContactNumberObject->save();
    }

    public function deleteWorkerContactNumber(Request $request){
        $params = $request->all();
        $id = Arr::get($params,WorkerContactNumberFields::SERIAL_NO);
        $indexId = Arr::get($params,'index_id');
        $object = WorkerContactNumber::where('serial_no',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }
}
