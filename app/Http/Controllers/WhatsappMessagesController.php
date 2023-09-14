<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WpContacts;
use App\Models\WhatsappMessageLog;
use App\Models\ContactUS;
use App\Models\MessageTemplates;
use App\Models\WhatsappGroups;
use App\Models\GroupContacts;
use Illuminate\Support\Facades\URL;
use Globals;
class WhatsappMessagesController extends Controller
{
    public function index(){
        $contact = WpContacts::get()->toArray();
        $templates = MessageTemplates::get()->toArray();
        $groups = WhatsappGroups::get()->toArray();
        return view('whatsapp.index')->with('contact',$contact)->with("templates",$templates)->with('groups',$groups);
    }
    public function store(Request $request){
        $contact = new WpContacts();
        $contact->name = $request->name;
        $contact->phone_number = $request->phone_number;
        $contact->save();
        \DB::commit();
        alertify()->success('Added record successfully');
        return redirect()->back();
    }
    public function update(Request $request , $id)
    {
        $contact = WpContacts::find($id);
        $contact->name = $request->name;
        $contact->phone_number = $request->phone_number;
        $contact->update();
        \DB::commit();
        alertify()->success('Updated record successfully.');
        return redirect()->back();
    }
    public function sendMessage(){

        $request = request()->all();
        if(!empty($request['selectedIds']) || $request['singleMessage'] == 1){
            $message = $request['message_text'];
            $type = 'text';
            $imageUrl = "";
            if(!empty($_FILES)){
                $target_dir = public_path()."/assets/images/";
                $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
                if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                    $imageUrl = URL::asset('assets/images/'.$_FILES["attachment"]["name"]);
                    $type = 'document';
                }
            }
            if($request['singleMessage'] == 1){
                $numbers = array(
                  array(
                    'id'=>$request['mobileNumber']
                  )
                );
            }else{
                $numbers = WpContacts::whereRaw("id in (".$request['selectedIds'].")")->get("phone_number as id")->toArray();
            }
            $result = Globals::sendWAPPMessage($numbers , array('message'=>$message,'file'=>$imageUrl) , $type);
            $message = "Something went wrong";
            if($result){
                $message = "Message sent please check your phone for tracking"; 
            }

            alertify()->success($message);
        }else{
            alertify()->success("No contact was selected for sending message.");
        }
            return redirect()->back();
    }
    public function messageLogs(){
        $logs = WhatsappMessageLog::get();
        if($logs){
            $logs = $logs->toArray();
        }else{
            $logs = [];
        }
        return view('whatsapp.logs')->with('logs',$logs);
    }

    public function Enquiry(Request $request){

        if(!empty($request->name)){
            $contact = array(
                'name'=>$request->name,
                'phone_number'=>$contact = $request->phone_number,
                'email'=>$contact = $request->email
            );
            $response = ContactUS::create($contact);
            // MessageTemplates
            if($response){
                alertify()->success("Thanks!!!, You Information Has been Submitted successfully, our representative will contact you soon.");
            }else{
                alertify()->error("Something went wrong, please retry later.");
            }
            return redirect()->back();           
        }else{    
                
            return view('whatsapp.contact-form');   
        }
    }

    public function Contacts(){
        $contacts = ContactUS::get()->toArray();
        return view('whatsapp.enquiries')->with('contacts',$contacts);
    }

    public function MessageTemplates(){
        $templates = MessageTemplates::get()->toArray();
        return view('whatsapp.message-templates')->with('templates',$templates);
    }
    public function addTemplate(Request $request){
        $temp = new MessageTemplates();
        $temp->title = $request->title;
        $temp->message = $request->message;
        $temp->save();
        \DB::commit();
        alertify()->success('Added record successfully');
        return redirect()->back();
    }
    public function editTemplate()
    {   
        $request = request()->all();
        $temp = MessageTemplates::find($request['id']);
        $temp->title = $request['title'];
        $temp->message = $request['message'];
        $temp->update();
        \DB::commit();
        alertify()->success('Updated record successfully.');
        return redirect()->back();
    }
    public function WaGroups(){
        $groups = WhatsappGroups::get()->toArray();
        $templates = MessageTemplates::get()->toArray();
        for($i=0;$i<count($groups); $i++){
            $groupContacts = GroupContacts::whereRaw("group_id =".$groups[$i]['id'])->get()->toArray();
            $contactIds = array();
            if(count($groupContacts)>0){
                foreach($groupContacts as $cont){
                    array_push($contactIds , $cont['contact_id']);
                }
            }

            if(count($contactIds)>0){
                
                $groups[$i]['contacts'] = WpContacts::whereRaw(" id in(".implode("," ,$contactIds).")")->get()->toArray();

            }else{
                $groups[$i]['contacts'] = array();
            }
        }
        return view('whatsapp.groups')->with('groups',$groups)->with('templates',$templates);   
    }
    public function addGroup(Request $request){
        $temp = new WhatsappGroups();
        $temp->name = $request->name;
        $temp->description = $request->description;
        $temp->save();
        \DB::commit();
        alertify()->success('Added record successfully');
        return redirect()->back();
    }
    
    public function editGroup()
    {   
        $request = request()->all();
        // dd($request); die;
        $temp = WhatsappGroups::find($request['id']);
        $temp->name = $request['name'];
        $temp->description = $request['description'];
        $temp->update();
        \DB::commit();
        alertify()->success('Updated record successfully.');
        return redirect()->back();
    }
    public function addToGroup(){
        $request = request()->all();
        if(!empty($request['selectContacts'])){
            $selectedContacts = explode(',',$request['selectContacts']);
            $data = array();
            foreach($selectedContacts as $contact){
                $groupCon = GroupContacts::whereRaw("group_id = ".$request['group_id']." and contact_id =".$contact)->get()->toArray();
                if(empty($groupCon)){
                    array_push($data , array(
                        'group_id' => $request['group_id'],
                        'contact_id' => $contact,
                    ));
                }
            }
            GroupContacts::insert($data);
            \DB::commit();
        }
        alertify()->success('Record Updated successfully.');
        return redirect()->back();   
    }
    public function removeContactFromGroup(){
        $request = request()->all();
        $status = GroupContacts::whereRaw('group_id = '.$request['group_id']." and contact_id = ".$request['contact_id'])->delete();
        \DB::commit();
        echo $status;
    }

    public function sendMessageGroup(){
        $request = request()->all();
        
        if(!empty($request['selectedIds'])){
            $message = $request['message_text'];
            $groupContacts = GroupContacts::whereRaw('group_id in('.$request['selectedIds'].")")->get()->toArray();
            $contactIDs = array();
            if(count($groupContacts) >0){
                foreach($groupContacts as $contact){
                    array_push($contactIDs , $contact['contact_id']);
                }
                if(count($contactIDs) >0){
                    $type = 'text';
                    $imageUrl = "";
                    if(!empty($_FILES)){
                        $target_dir = public_path() ."/assets/images/";
                        $target_file = $target_dir . basename($_FILES["attachment"]["name"]);
                        if (move_uploaded_file($_FILES["attachment"]["tmp_name"], $target_file)) {
                            $imageUrl = URL::asset('assets/images/'.$_FILES["attachment"]["name"]);
                            $type = 'document';
                        }
                    }
                    $numbers = WpContacts::whereRaw("id in (".implode( "," , $contactIDs ).")")->get("phone_number as id")->toArray();
                    $result = Globals::sendWAPPMessage($numbers , array('message'=>$message,'file'=>$imageUrl) , $type);
                    $message = "Something went wrong";
                    if($result){
                        $message = "Message sent please check your phone for tracking"; 
                    }
                }
            }
            alertify()->success($message);
        }else{
            alertify()->success("No contact was selected for sending message.");
        }
        return redirect()->back();
    }

    public function ImportContact()
    {

        if(!empty($_FILES['csv-contacts'])){
            
            $tmpName = $_FILES['csv-contacts']['tmp_name'];
            $csvAsArray = array_map('str_getcsv', file($tmpName));
            $headers = $csvAsArray[0]; 
            
            if(count($headers)<2){
                alertify()->success('Columns does not match.');
                return redirect()->back();
                exit;
            }
            $body = array();
            foreach($csvAsArray as $key => $value){
                if($key == 0){
                    continue;
                }
                $contact = WpContacts::create([
                    'name' => $value[0],
                    'phone_number' => $value[1]
                ]);
            }
            alertify()->success('Imported successfully.');
            return redirect()->back();
        }
    }


}
