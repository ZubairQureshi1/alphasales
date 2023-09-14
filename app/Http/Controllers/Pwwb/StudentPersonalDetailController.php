<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\StudentPersonalDetailFields;
use App\Fields\StudentContactNumberFields;
use App\Models\Pwwb\StudentPersonalDetail;
use App\Models\Pwwb\StudentContactNumber;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class StudentPersonalDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');
        $name = Arr::get($params,StudentPersonalDetailFields::NAME);
        $fatherName = Arr::get($params,StudentPersonalDetailFields::FATHER_NAME);
        $CNICNo = Arr::get($params,StudentPersonalDetailFields::CNIC_NO);
        $quantity = Arr::get($params,StudentPersonalDetailFields::QUANTITY);
        $studentCNICAttested = Arr::get($params,StudentPersonalDetailFields::STUDENT_CNIC_ATTESTED);

        $birth_date_explode = explode('/',Arr::get($params,StudentPersonalDetailFields::DATE_OF_BIRTH));
        if(count($birth_date_explode) == 3)
            $dateOfBirth = Carbon::createFromDate($birth_date_explode[2],$birth_date_explode[1],$birth_date_explode[0])->format('Y-m-d');
        else
            $dateOfBirth = Arr::get($params,StudentPersonalDetailFields::DATE_OF_BIRTH);

        $presentAddress = Arr::get($params,StudentPersonalDetailFields::PRESENT_ADDRESS);
        $maritalStatus = Arr::get($params,StudentPersonalDetailFields::MARITAL_STATUS);
        // $contactNo1 = Arr::get($params,StudentPersonalDetailFields::CONTACT_NO_1);
        // $contactNo2 = Arr::get($params,StudentPersonalDetailFields::CONTACT_NO_2);
        $postalAddress = Arr::get($params,StudentPersonalDetailFields::POSTAL_ADDRESS);
        $email = Arr::get($params,StudentPersonalDetailFields::EMAIL);
        $signature = Arr::get($params,StudentPersonalDetailFields::SIGNATURE);

        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = StudentPersonalDetail::where(StudentPersonalDetailFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new StudentPersonalDetail();
            }
        }

        $object->index_table_id = $indexTableId;
        $object->name = $name;
        $object->father_name = $fatherName;
        $object->cnic_no = $CNICNo;
        $object->quantity = $quantity;
        $object->student_cnic_attested = $studentCNICAttested;
        $object->date_of_birth = $dateOfBirth;
        $object->present_address = $presentAddress;
        $object->marital_status = $maritalStatus;
        // $object->contact_no_1 = $contactNo1;
        // $object->contact_no_2 = $contactNo2;
        $object->postal_address = $postalAddress;
        $object->email = $email;
        $object->signature = $signature;
        $object->save();

        //Student Contact Number
        $serialNo = Arr::get($params, StudentContactNumberFields::SERIAL_NO);
        $studentContactRelationship = Arr::get($params, StudentContactNumberFields::STUDENT_CONTACT_RELATIONSHIP);
        $studentSpecifyRelationship = Arr::get($params, StudentContactNumberFields::STUDENT_SPECIFY_RELATIONSHIP);
        $contactNo = Arr::get($params, StudentContactNumberFields::CONTACT_NO);


        if (!$indexTableId) {
            for ($i = 0; $i < count($serialNo); $i++) {
                $StudentContactNumber = new StudentContactNumber();
                $this->fillStudentContactNumberData($i, $StudentContactNumber, $indexTableId,$serialNo, $studentContactRelationship, $studentSpecifyRelationship, $contactNo);
            }
        } else {
            $j = 0;
            foreach (StudentContactNumber::where('index_table_id', $indexTableId)->get() as $StudentContactNumber) {
                $StudentContactNumberSingle = StudentContactNumber::find($StudentContactNumber->id);
                $this->fillStudentContactNumberData($j, $StudentContactNumberSingle, $indexTableId,$serialNo, $studentContactRelationship, $studentSpecifyRelationship, $contactNo);
                $j++;
            }
            if ($j < count($serialNo)) {
                for ($k = $j; $k < count($serialNo); $k++) {
                    $StudentContactNumber = new StudentContactNumber();
                    $this->fillStudentContactNumberData($k, $StudentContactNumber, $indexTableId, $serialNo, $studentContactRelationship, $studentSpecifyRelationship, $contactNo);
                }
            }
        }

        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }

    private function fillStudentContactNumberData($index,$studentContactNumberObject,$indexTableId, $serialNo, $studentContactRelationship, $studentSpecifyRelationship, $contactNo){
        $studentContactNumberObject->index_table_id = $indexTableId;
        $studentContactNumberObject->serial_no = isset($serialNo[$index]) ? $serialNo[$index] : null;
        $studentContactNumberObject->student_contact_relationship = isset($studentContactRelationship[$index]) ? $studentContactRelationship[$index] : null;
        $studentContactNumberObject->specify_relationship = isset($studentSpecifyRelationship[$index]) ? $studentSpecifyRelationship[$index] : null;
        $studentContactNumberObject->contact_no = isset($contactNo[$index]) ? $contactNo[$index] : null;
        $studentContactNumberObject->save();
    }

    public function deleteStudentContactNumber(Request $request){
        $params = $request->all();
        $id = Arr::get($params,StudentContactNumberFields::SERIAL_NO);
        $indexId = Arr::get($params,'index_id');
        $object = StudentContactNumber::where('serial_no',$id)->where('index_table_id',$indexId);
        if($object->first()){
            $object->delete();
        }
        return response()->json([
            'message' => 'deleted'
        ],200);
    }
}

