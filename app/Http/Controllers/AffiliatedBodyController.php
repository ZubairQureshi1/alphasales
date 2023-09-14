<?php

namespace App\Http\Controllers;

use App\Models\AffiliatedBody;
use Flash;
use Globals;
use Illuminate\Http\Request;
use App\Models\Organization;
use App\Models\OrganizationCampus;

class AffiliatedBodyController extends Controller
{

    public function index(Request $request)
    {
        $organizations = Organization::get()->toArray();
        $offices = OrganizationCampus::get()->toArray();
            
        return view('affiliatedBody.index')
        ->with('affiliatedBodies', AffiliatedBody::get())
        ->with('offices', $offices)
        ->with('organizations', $organizations);
    }

    public function create()
    {
        return view('affiliatedBody.create');
    }
    public function store(Request $request)
    {
        $affiliatedBody = AffiliatedBody::create([
            'name' => $request->name,
            'code' => $request->code,
            'organization_id' => $request->organization_id,
            'organization_campus_id' => $request->office_id
        ]);

        // add checklists
        if ($request->exists('checklists')) {
            foreach ($request->checklists as $checklist) {
                $affiliatedBody->checklists()->create([
                    'description' => $checklist
                ]);
            }
        }

        if ($affiliatedBody) {
            Flash::success('affiliatedBody added successfully.');
        } else {
            Flash::error('Something went wrong while adding subect.');
        }

        return redirect(route('affiliatedBody.index'));
    }
    public function edit($id)
    {
        $affiliatedBody = AffiliatedBody::find($id)->first();
        if ($affiliatedBody) {
            return view('affiliatedBody.index')->with('affiliatedBody', $affiliatedBody)->with('is_edit_mode', true);
        } else {
            Flash::error('Something went wrong while adding affiliatedBody.');
        }

        return redirect(route('affiliatedBody.index'));
    }
    public function update(AffiliatedBody $affiliatedBody, Request $request)
    {
        $affiliatedBody->update([
            'name' => $request->name,
            'code' => $request->code,
            'organization_id' => $request->organization_id,
            'organization_campus_id' => $request->office_id
        ]);
        // delete previous check lists
        $affiliatedBody->checklists()->delete();
        // update check lists
        if ($request->exists('checklists')) {
            foreach ($request->checklists as $checklist) {
                $affiliatedBody->checklists()->create([
                    'description' => $checklist
                ]);
            }
        }
        // return
        if ($affiliatedBody) {
            Flash::success('affiliatedBody details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding affiliatedBody.');
        }
        return redirect(route('affiliatedBody.index'));
    }
    public function destroy($id)
    {
        $affiliatedBody = AffiliatedBody::find($id);

        if (empty($affiliatedBody)) {
            Flash::error('affiliatedBody not found');

            return redirect(route('affiliatedBody.index'));
        }

        $affiliatedBody->delete();

        Flash::success('affiliatedBody deleted successfully.');

        return redirect(route('affiliatedBody.index'));
    }

}
