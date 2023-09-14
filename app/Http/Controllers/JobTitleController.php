<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\JobTitle;
use App\Models\Organization;
use Illuminate\Http\Request;

class JobTitleController extends Controller
{
   public function index(Request $resquest){
        return view('organizationManagement.jobtitles', [
            'jobtitles'     => JobTitle::get()
        ]);
   }


   public function store(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'serial_no' => 'required|unique:job_titles',
            'description' => 'max:255',
            'organization_id' => 'required|exists:organizations,id'
        ]);
        JobTitle::create($validate);
        alertify()->success('Job Title created successfully!');     
        return redirect()->back();


   }

   public function update(Request $request, JobTitle $job)
   {
       $job->update($request->all());
       alertify()->success('Job Updated Successfully!');
       return redirect()->back();
   }


   public function delete(JobTitle $job)
   {
       $job->delete();
       alertify()->success('Job Deleted Successfully!');
       return redirect()->back();
   }

}
