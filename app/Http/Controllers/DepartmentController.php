<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Designation;
use Flash;
use Globals;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{

    public function index(Request $request)
    {
        $departments = Department::get()->toArray();
        $department_keys = [];
        if (count($departments) != 0) {
            for ($i = 0; $i < sizeof($departments); $i++) {
                $departments[$i]['replaced_name'] = Globals::replaceSpecialChar($departments[$i]['name']);
            };
            $department_keys = array_keys($departments[0]);
        }
        // dd($department_keys);
        return view('departments.index')
            ->with('departments', $departments)->with(['department_keys' => $department_keys, 'is_edit_mode' => false]);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        try {
            \DB::beginTransaction();
            //dd($input);
            foreach ($request->organization_campus_ids as $key => $organization_campus_id) {
                $department = Department::create([
                    'organization_id'        => $request->organization_id,
                    'organization_campus_id' => $organization_campus_id,
                    'name'                   => $request->name,
                    'code'                   => $request->code
                ]);
            }
            if ($department) {
                Flash::success('department added successfully.');
            } else {
                Flash::error('Something went wrong while adding subect.');
            }

            \DB::commit();
            return redirect(route('departments.index'));
        } catch (Exception $e) {
            \DB::rollback();
            dd($e);
        }
    }

    public function update(Department $department, Request $request)
    {
        $department->update($request->all());
        // $input = $request->all();
        //dd($input);
        // $department = Department::find($id);
        // $department->organization_id = $input['organization_id'];
        // $department->organization_campus_id = $input['organization_campus_id'];
        // $department->name = $input['name'];
        // $department->code = $input['code'];
        // $department->update();
        if ($department) {
            Flash::success('department details updated successfully.');
        } else {
            Flash::error('Something went wrong while adding department.');
        }

        return redirect(route('departments.index'));
    }

    public function destroy($id)
    {
        $department = Department::find($id);

        if (empty($department)) {
            Flash::error('department not found');

            return redirect(route('departments.index'));
        }

        $department->delete();

        Flash::success('Subjects deleted successfully.');

        return redirect(route('departments.index'));
    }

    public function deActivateDepartment($id)
    {
        $department = Department::find($id);
        $department->is_active = 0;
        $department->update();
        return redirect(route('departments.index'));
    }
    public function activateDepartment($id)
    {
        $department = Department::find($id);
        $department->is_active = 1;
        $department->update();
        return redirect(route('departments.index'));
    }

    public function getDepartmentDesignations($department_id)
    {
        $designations = Designation::where('department_id', $department_id)->get();
        return response()->json(['success' => 'true', 'message' => 'Designations retrieved successfully.', 'data' => ['designations' => $designations]]);
    }

    public function getDesignationDepartments(Designation $designation, $campus_id)
    {
        $departments = $designation->departments()->where('organization_campus_id', $campus_id)->get()->pluck('department_name', 'department_id');
        // $data = [];
        // foreach ($designation->departments as $value) {
        //     $data[] = [
        //         'id' => $value->department->id,
        //         'name' => $value->department->name,
        //     ];
        // }
        return response()->json($departments);
    }

}
