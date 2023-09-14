<?php

namespace App\Http\Controllers;

use App\Models\Wing;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\OrganizationCampus;
use App\Models\AffiliatedBody;

class WingController extends Controller
{
    public function index()
    {
        $wings = Wing::get();
        // print_r($wings);exit;
        $organizations = Organization::get()->toArray();
        $offices = OrganizationCampus::get()->toArray();
        $affiliatedBodies = AffiliatedBody::get()->toArray();
        return view('organizationManagement.wings.index')
        ->with('wings', $wings)
        ->with('offices', $offices)
        ->with('organizations', $organizations)
        ->with('affiliatedBodies', $affiliatedBodies);
    }
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $wing = new Wing();
            $wing->name = $request->name;
            $wing->short_name = $request->short_name;
            $wing->description = $request->description;
            $wing->organization_id = $request->organization_id;
            $wing->organization_campus_id = $request->office_id;
            $wing->wing_type_id = $request->dev_id;
            $wing->save();
            \DB::commit();
            // $wing = Wing::create($request->all());
            // \DB::commit();
            alertify()->success('Added record successfully');
            return redirect()->back();
        } catch (\Exception $e) {
            \DB::rollback();
            $exception_message = $e->getMessage();
            $exception_message_semi_col_split = explode(":", $exception_message);
            $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
            alertify()->error($message);
            return redirect()->back();
        }
    }
    public function update(Request $request, Wing $wing)
    {

        try {
            \DB::beginTransaction();
            if ($wing) {
                $wing->name = $request->name;
                $wing->short_name = $request->short_name;
                $wing->description = $request->description;
                // $wing->wing_type_id = $request->wing_type_id;
                $wing->organization_id = $request->organization_id;
                $wing->organization_campus_id = $request->office_id;
                $wing->wing_type_id = $request->dev_id;
                $wing->update();
                \DB::commit();
                alertify()->success('Updated record successfully.');
                return redirect()->back();
            } else {

                alertify()->success('Record not found.');
                return redirect()->back();
            }
        } catch (\ErrorException $e) {
            \DB::rollback();
            $exception_message = $e->getMessage();
            $exception_message_semi_col_split = explode(":", $exception_message);
            $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
            alertify()->error($message);
            return;
        }
    }
    public function Destroy(Wing $wing)
    {
        if (!empty($wing)) {
            $wing->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
