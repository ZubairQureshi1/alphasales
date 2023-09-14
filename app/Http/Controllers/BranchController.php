<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use App\Models\Company;
use App\Models\Location;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    public function index(Request $resquest)
    {
        $branches = Branch::get();
        $companies = Company::get();
        $locations = Location::get();
        return view('organization.branches')->with('branches', $branches)->with('companies', $companies)->with('locations', $locations);

    }

    public function store(Request $request)
    {
        $input = $request->all();
        $branches = new Branch();
        $companies = Company::all()->pluck('id');
        $branches->branch_code = $request->input('branch_code');
        $branches->company_id = $request->input('select_company');
        $branches->country = $request->input('country');
        $branches->city = $request->input('city');
        $branches->descripton = $request->input('descripton');

        $branches->save();
        return redirect('/indexBranch')->with('companies', $companies)->with('branches', $branches);

    }

    public function update(Request $request, $id)
    {
        $branches = Branch::find($id);
        $branches->branch_code = $request->get('branch_code');
        $branches->company_id = $request->input('select_company');
        $branches->country = $request->get('country');
        $branches->city = $request->get('city');
        $branches->descripton = $request->get('descripton');
        $branches->company_id = $request->get('select_company');
        $branches->update();
        return redirect('/indexBranch');

    }

    public function delete($id)
    {
        $branch = Branch::find($id);
        $branch->jobtitles()->delete();
        $branch->location()->delete();
        $branch->delete();
        return redirect()->back();

    }

}
