<?php

namespace App\Http\Controllers;

use App\Models\Location;

use App\Models\Company;
use App\Models\Branch;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $resquest){
    	$companies= Company::get();
    	$branches= Branch::get();
      $locations= Location::get();
      return view('organization.locations')->with('locations', $locations)->with('companies', $companies)->with('branches', $branches);
    	}


     public function store(Request $request){
      $input=$request->all();
    	$locations= new Location();
    	$locations->company_id= $request->input('selected_company');
    	$locations->branch_id=$request->input('select_branch');
    	$locations->address = $request->input('address');
      $locations->branch_code= Branch::find($input['select_branch'])->branch_code;
    	$locations->save();
    	return redirect('/indexLocation')->with('locations', $locations);


}

  public function update(Request $request, $id){
         $locations = Location::find($id);
         $locations->address= $request->get('address');
         $locations->update();
       return redirect('/indexLocation');
         


}
public function delete($id){
        $location = Location::find($id);
        $location->company()->delete();
        $location->branch()->delete();
        $location->delete();
       return redirect()->back();
}
 






}
