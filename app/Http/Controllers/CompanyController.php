<?php

namespace App\Http\Controllers;
use App\Models\Company; 
use App\Models\Branch; 
use App\Models\Location;
use App\Models\JobTitle;

use Illuminate\Http\Request;

class CompanyController extends Controller
{
    
	public function index(Request $resquest){
		$companies= Company::get();
        return view('organization.companies')->with('companies', $companies);


    }
    public function store(Request $request){
    	$companies= new Company();
    	$companies->company_code= $request->input('company_code');
        $companies->company_name= $request->input('company_name');
    	$companies->company_year_start= $request->input('start_date');
    	$companies->company_year_end = $request->input('end_date');
    	$companies->address= $request->input('address');
    	$companies->description= $request->input('description');
    	$companies->save();
    	return redirect('/indexCompany');


    }
     public function edit($id)
    {

        $companies = Company::find($id);
        return redirect()->back();
    }


     public function update(Request $request, $id){
         $companies = Company::find($id);
         $companies->company_code = $request->get('company_code');
         $companies->company_name = $request->get('company_name');
         $companies->company_year_start = $request->get('start_date');
         $companies->address = $request->get('address');
         $companies->description= $request->get('description');
         $companies->update();
         return redirect('/indexCompany');
         


}

       public function delete($id){
       $company =Company::find($id);
       $company->branches()->delete();
       $company->jobtitles()->delete();
       $company->location()->delete();
       $company->delete();
        return redirect()->back();


 }
}