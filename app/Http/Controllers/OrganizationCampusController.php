<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Organization;
use App\Models\OrganizationCampus;
use App\Models\OrganizationCampusWing;
use App\Models\Wing;
use Illuminate\Http\Request;
use DB;

class OrganizationCampusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizationOfficeLocation = OrganizationCampus::get();
        $wings = Wing::get();
        return view('organizationManagement.campuses.index')->with('organizationOfficeLocation', $organizationOfficeLocation)
            ->with('wings', $wings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            \DB::beginTransaction();
            $organizationCampus = OrganizationCampus::create($request->all());
            if ($request->wing_ids != null) {
                foreach ($request->wing_ids as $wing_id) {
                    $organization_campus_wing = new OrganizationCampusWing();
                    $organization_campus_wing->wing_id = $wing_id;
                    $organization_campus_wing->organization_campus_id = $organizationCampus->id;
                    $organization_campus_wing->save();
                }
            }
            \DB::commit();
            alertify()->success('Added record successfully');
            return redirect()->back();
        } catch (\ErrorException $e) {
            \DB::rollback();
            $exception_message = $e->getMessage();
            $exception_message_semi_col_split = explode(":", $exception_message);
            $message = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
            alertify()->error($message);
            return;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\OrganizationCampus  $organizationCampus
     * @return \Illuminate\Http\Response
     */
    public function show(OrganizationCampus $organizationCampus)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\OrganizationCampus  $organizationCampus
     * @return \Illuminate\Http\Response
     */
    public function edit(OrganizationCampus $organizationCampus)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\OrganizationCampus  $organizationCampus
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$organizationCampus)
    {
        $organizationCampus=OrganizationCampus::where('id',$organizationCampus)->first();
        try {
            \DB::beginTransaction();
            if ($organizationCampus) {
                $organizationCampus->name = $request->name;
                $organizationCampus->organization_id = $request->organization_id;
                $organizationCampus->code = $request->code;
                $organizationCampus->city_id = $request->city_id;
                $organizationCampus->address = $request->address;
                $organizationCampus->update();
                $organizationCampus->organizationCampusWings()->delete();
                foreach ($request->wing_ids as $wing_id) {
                    $organization_campus_wing = new OrganizationCampusWing();
                    $organization_campus_wing->wing_id = $wing_id;
                    $organization_campus_wing->organization_campus_id = $organizationCampus->id;
                    $organization_campus_wing->save();
                }

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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\OrganizationCampus  $organizationCampus
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, OrganizationCampus $organizationCampus)
    {
        //dd($request->org_id);
        if (!empty($request->org_id)) {
            DB::table('organization_campuses')->delete($request->org_id);
            // $organizationCampus->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }

    public function campusDepartments($organization_campus_id)
    {
        $departments = Department::where('organization_campus_id', '=', $organization_campus_id)->where('is_active', 1)->get();
        return response()->json(['success' => 'true', 'message' => 'Departments retrieved successfully.', 'data' => ['departments' => $departments]]);
    }
}
