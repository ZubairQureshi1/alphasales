<?php

namespace App\Http\Controllers;

use App\Models\Organization;
use App\Models\OrganizationCampus;
use Illuminate\Http\Request;

class OrganizationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organizations = Organization::get();
        return view('organizationManagement.organizations.index')
            ->with('organizations', $organizations);
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
            $organization = Organization::create($request->all());
            \DB::commit();
            alertify()->success('Updated record successfully');
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
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function show(Organization $organization)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function edit(Organization $organization)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Organization $organization)
    {
        try {
            \DB::beginTransaction();
            if ($organization) {
                $organization->name = $request->name;
                $organization->short_name = $request->short_name;
                $organization->description = $request->description;
                $organization->update();
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
     * @param  \App\Organization  $organization
     * @return \Illuminate\Http\Response
     */
    public function destroy(Organization $organization)
    {
        if (!empty($organization)) {
            OrganizationCampus::where('organization_id', '=', $organization->id)->update(['old_organization_id' => $organization->id]);
            $organization->delete();
            return redirect()->back();
        } else {
            return redirect()->back();
        }
    }
}
