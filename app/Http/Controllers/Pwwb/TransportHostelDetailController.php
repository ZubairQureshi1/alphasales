<?php

namespace App\Http\Controllers\Pwwb;

use Illuminate\Routing\Controller;
use App\Fields\TransportHostelDetailFields;
use App\Models\Pwwb\TransportHostelDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
class TransportHostelDetailController extends Controller
{
    public function post(Request $request){
        $params = $request->all();

        $indexTableId = Arr::get($params,'index_id');
        $transport_facility = Arr::get($params,TransportHostelDetailFields::TRANSPORT_FACILITY);
        $bus_stop = Arr::get($params,TransportHostelDetailFields::BUS_STOP);
        $hostel_facility = Arr::get($params,TransportHostelDetailFields::HOSTEL_FACILITY);
        $hostel_name = Arr::get($params,TransportHostelDetailFields::HOSTEL_NAME);
        $address = Arr::get($params,TransportHostelDetailFields::ADDRESS);
        $manager_name = Arr::get($params,TransportHostelDetailFields::MANAGER_NAME);
        $manager_contact = Arr::get($params,TransportHostelDetailFields::MANAGER_CONTACT);

        if(!$indexTableId) {
            return response()->json([
                'message' => 'Index Table Id Not Found'
            ],500);
        }
        else{
            $object = TransportHostelDetail::where(TransportHostelDetailFields::INDEX_TABLE_ID,$indexTableId)->first();
            if(!$object){
                $object = new TransportHostelDetail();
            }
        }

        $object->index_table_id = $indexTableId;
        $object->transport_facility = $transport_facility;
        $object->bus_stop = $bus_stop;
        $object->hostel_facility = $hostel_facility;
        $object->hostel_name = $hostel_name;
        $object->address = $address;
        $object->manager_name = $manager_name;
        $object->manager_contact = $manager_contact;
        $object->save();


        return response()->json([
            'message' => 'Saved Successfully',
            'object' => $object
        ],200);
    }
}
