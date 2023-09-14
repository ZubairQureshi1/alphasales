<?php

namespace App\Http\Controllers;

use App\Models\Designation;
use Flash;
use Illuminate\Http\Request;

class DesignationController extends Controller
{
    public function index(Request $request)
    {
        // $designation = Designation::find(47);
        // return $designation;

        return view('designations.index', [
            'designations' => Designation::get(),
        ])->with(['is_edit_mode' => false]);
    }

    public function create()
    {
        return view('designations.create');
    }

    public function store(Request $request)
    {
        $designation = Designation::create([
            'name' => $request->name,
            'code' => $request->code,
            'organization_id' => $request->organization_id,
        ]);
        if ($request->has('designation_details')) {
            // insert new
            foreach ($request->designation_details as $key => $detail) {
                foreach ($detail['department_ids'] as $department_id) {
                    $designation->campuses()->create([
                        'organization_campus_id' => $detail['organization_campus_id'],
                        'department_id' => $department_id,
                    ]);
                }
            }

        }

        if ($designation) {
            Flash::success('designation added successfully.');
        } else {
            Flash::error('Something went wrong while adding subect.');
        }

        return redirect(route('designations.index'));
    }

    public function edit(Designation $designation)
    {
        return view('designations.edit', [
            'designation' => $designation,
        ]);
    }

    public function update(Designation $designation, Request $request)
    {
        $designation->update([
            'name' => $request->name,
            'code' => $request->code,
            'organization_id' => $request->organization_id,
        ]);

        // update department if exists
        if ($request->has('designation_details')) {
            // delete previous
            $designation->campuses()->delete();
            // insert new
            foreach ($request->designation_details as $key => $detail) {
                foreach ($detail['department_ids'] as $department_id) {
                    $designation->campuses()->create([
                        'organization_campus_id' => $detail['organization_campus_id'],
                        'department_id' => $department_id,
                    ]);
                }
            }

        }

        if ($designation) {
            Flash::success('designation details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding designation.');
        }

        return redirect(route('designations.index'));
    }

    public function destroy(Designation $designation)
    {

        if (empty($designation)) {
            Flash::error('designation not found');
            return redirect(route('designations.index'));
        }

        $designation->delete();
        $designation->campuses()->delete();

        Flash::success('Subjects deleted successfully.');

        return redirect(route('designations.index'));
    }

    public function campusDepartmentsFields(Request $request)
    {
        return response()->json(view('designations.campus_departments_fields', ['count' => $request->count])->render(), 200);
    }
}
