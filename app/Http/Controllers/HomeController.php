<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd(\Auth::user()->campusDetails()->get()->pluck('organization_campus_name', 'organization_campus_id'));
        $user_campuses = \Auth::user()->campusDetails()->get()->pluck('organization_campus_name', 'organization_campus_id');
        $user_sessions = \Auth::user()->userAllowedSessions()->get()->pluck('session_name', 'session_id');
        if (is_null(Session::get('organization_campus_id'))) {
            $session = Session::put(['organization_campus_id' => array_key_first($user_campuses->toArray())]);
        }
        if (is_null(Session::get('selected_session_id'))) {
            $session = Session::put(['selected_session_id' => array_key_first($user_sessions->toArray())]);
        }

        $userAgents = DB::select("
                                SELECT `u`.`name` , `u`.`id` , COUNT(e.id) as tot 
                                FROM `users` AS `u` 
                                LEFT JOIN `enquiries` AS `e` ON `e`.`user_id` = `u`.`id` 
                                where u.id != 1
                                GROUP BY `u`.`id`
                                ");
        $rankwiseEnq = DB::select("
                        SELECT
                            COUNT(`id`) AS `tot`,
                            `follow_up_interested_level_id` AS `interst`
                        FROM
                            `enquiries`
                        GROUP BY
                            `follow_up_interested_level_id`
                        order by `interst` asc
                        ");
        $statuswiseEnq = DB::select("
                    SELECT
                        COUNT(fol.id) AS `tot`,
                        e.status
                    FROM
                        enquiries e
                    JOIN enquiry_followups fol ON
                        fol.enquiry_id = e.id
                    WHERE
                        fol.next_date = '".date("Y-m-d")."'
                    GROUP BY
                        e.status
                        ");
        // dd($statuswiseEnq);
        $status = array( 
                        array("interst" => "A" , "tot" => 0),
                        array("interst" => "B" , "tot" => 0),
                        array("interst" => "C" , "tot" => 0),
                        array("interst" => "D" , "tot" => 0),
                    );
        if(count($rankwiseEnq) > 0){
            $rankwiseEnq = json_decode(json_encode($rankwiseEnq),true);
        }else{
            $rankwiseEnq = array();
        }
 
        for($i=0;$i<count($rankwiseEnq);$i++){

            if(isset($rankwiseEnq[$i])){

                if($rankwiseEnq[$i]['interst'] == 0){
                    $status[0]['tot'] = $rankwiseEnq[$i]['tot'];
                }
                if($rankwiseEnq[$i]['interst'] == 2){
                    $status[1]['tot'] = $rankwiseEnq[$i]['tot'];
                }
                if($rankwiseEnq[$i]['interst'] == 4){
                    $status[2]['tot'] = $rankwiseEnq[$i]['tot'];
                }
                if($rankwiseEnq[$i]['interst'] == 6){
                    $status[6]['tot'] = $rankwiseEnq[$i]['tot'];
                }

            }

        }
        $statuswiseenq = array( 
                        array("status" => "Follow Up Required" , "tot" => 0),
                        array("status" => "Dropped" , "tot" => 0),
                        array("status" => "Sales Matured" , "tot" => 0)
                    );
 
        if(count($statuswiseEnq) > 0){
            $statuswiseEnq = json_decode(json_encode($statuswiseEnq),true);
        }else{
            $statuswiseEnq = array();
        }
 
        for($i=0;$i<count($statuswiseEnq);$i++){

            if(isset($statuswiseEnq[$i])){

                if($statuswiseEnq[$i]['status'] == 'Follow Up Required'){
                    $statuswiseenq[0]['tot'] = $statuswiseEnq[$i]['tot'];
                }
                if($statuswiseEnq[$i]['status'] == 'Dropped'){
                    $statuswiseenq[1]['tot'] = $statuswiseEnq[$i]['tot'];
                }
                if($statuswiseEnq[$i]['status'] == 'Sales Matured'){
                    $statuswiseenq[2]['tot'] = $statuswiseEnq[$i]['tot'];
                }
            }

        }
        $followuprequired_d = DB::table("enquiries")
                                                ->whereDate('created_at','=',date("Y-m-d"))
                                                ->count();
       //dd($followuprequired_d);                                         
        $followuprequired_w = DB::table("enquiries")
                                            ->whereDate('created_at','>=',date("Y-m-d" ,strtotime("-1 week")) )
                                            ->whereDate('created_at','<=',date("Y-m-d") )
                                            ->count();

        $followuprequired_m = DB::table("enquiries")
                                        ->whereDate('created_at','>=',date("Y-m-d" ,strtotime("-1 month")) )
                                        ->whereDate('created_at','<=',date("Y-m-d") )
                                                    ->count();
        $followups = array(
            array(
            "tot" =>$followuprequired_d,
            "dur" =>"Daily"
            ) ,
            array(
            "tot" =>$followuprequired_w,
            "dur" =>"Weekly"
            ),
            array(
            "tot" =>$followuprequired_m,
            "dur" =>"Monthly"
            )
        );
        $overDue = DB::table("enquiries")->where('enquiry_date','<',date('Y-m-d'))->count();
        $unassigned = DB::select("
                        SELECT
                        COUNT(`e`.`id`) AS `tot`
                    FROM
                        `enquiries` `e`
                    left JOIN `enquiry_followups` `ef` on `ef`.`enquiry_id` = `e`.`id`
                    where `ef`.`created_at` is null
                        ");
                            // dd($userAgents);
        if(count($unassigned)>0){
            $unassigned = $unassigned[0]->tot;
        }else{
            $unassigned = 0;
        }
        return view('home')
                ->with('followuprequired',$followups)
                ->with('overDue',$overDue)
                ->with('userAgents',$userAgents)
                ->with('rankwiseEnq',$status)
                ->with('unassigned',$unassigned)
                ->with('statuswiseEnq',$statuswiseenq);
    }
    
    public function updateSystemSession(Request $request)
    {

        $is_session_updated = false;
        $is_campus_updated = false;

        if (Session::get('organization_campus_id') != $request->organization_campus_id) {
            $is_campus_updated = true;
        }
        if (Session::get('organization_campus_id') != null && $request->organization_campus_id == null) {
            $is_campus_updated = true;
        }

        if (Session::get('selected_session_id') != $request->session_id) {
            $is_session_updated = true;
        }
        if (Session::get('selected_session_id') != null && $request->session_id == null) {
            $is_session_updated = true;
        }

        $session = Session::put(['organization_campus_id' => $request->organization_campus_id == null ? '' : $request->organization_campus_id]);
        $session = Session::put(['selected_session_id' => $request->session_id == null ? '' : $request->session_id]);
        return response()->json(['success' => true, 'message' => ($is_campus_updated && $is_session_updated) ? 'Campus and session changed successfully.' : (($is_campus_updated) ? 'Campus changed successfully.' : 'Session updated successfully.')]);
    }

    public function histories($model_name, $id)
    {
        $audits = [];
        $model_audits = $model_name::with('audits', 'audits.user')->find($id);
        return view('history')->with(['model_audits' => $model_audits]);
    }

    public function activityLogs(User $user)
    {
        $model_audits = \DB::table('audits')->where('user_id', $user->id)->get();
        return view('activity_logs')->with(['model_audits' => $model_audits, 'user' => $user]);
    }
}
