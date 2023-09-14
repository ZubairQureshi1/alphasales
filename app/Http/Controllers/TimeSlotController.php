<?php

namespace App\Http\Controllers;

use App\Exports\TimeSlots\TimeSlotsExport;
use App\Models\TimeSlot;
use Excel;
use Helmesvs\Notify\Facades\Notify;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session as SystemSession;

class TimeSlotController extends Controller
{
    public function index(Request $request)
    {
        $groupByTimeSlots = TimeSlot::get()->groupBy('slot_type_name')->toArray();
        // dd($groupByTimeSlots);
        return view('timeslot.index', ['groupByTimeSlots' => $groupByTimeSlots]);
    }

    public function store(Request $request)
    {
        $input                           = $request->all();
        $input['slot_type_name']         = config('constants.time_slot_types')[$input['slot_type_id']];
        $input['organization_campus_id'] = SystemSession::get('organization_campus_id');
        $timeslot                        = TimeSlot::create($input);
        Notify::success('Timeslot Created Successfully!', 'Success', $options = []);
        return redirect()->back();
    }

    public function export()
    {
        return Excel::download(new TimeSlotsExport, 'TimeSlotsExport.xlsx');
    }

    public function getAJAXTimeSlot()
    {
        $timeslots = TimeSlot::get()->pluck('name_with_time', 'id');
        return $timeslots;
    }

    public function destroy($id)
    {
        $timeslot = TimeSlot::find($id);
        if (empty($timeslot)) {
            Notify::error('Timeslot Not Found!', 'Not Found', $options = []);
            return redirect(route('timeslots.index'));
        }
        $timeslot->delete();
        Notify::info('Timeslot Deleted Successfully!', 'Action Status', $options = []);
        return redirect(route('timeslots.index'));
    }

    // public function edit($id)
    // {

    //     $role = Role::find($id);

    //     // $assigned_permissions = $role->permissions->groupBy('module_name');
    //     $role_permission = $role->permissions->keyBy('name');
    //     $permissions = Permission::all()->keyBy('name');

    //     foreach ($permissions as $key => $permission) {
    //         foreach ($role_permission as $permission_key => $hasPermission) {
    //             if (!$permission['isChecked']) {
    //                 if ($key == $permission_key) {
    //                     $permission['isChecked'] = true;
    //                 } else {
    //                     $permission['isChecked'] = false;
    //                 }
    //             }
    //         }
    //     }

    //     $permissions = $permissions->groupBy('module_name');
    //     // dd($permissions);

    //     if (empty($role)) {
    //         Toastr::error('Role not found.', $title = null, $options = []);

    //         return redirect(route('roles.index'));
    //     }

    //     return view('roles.edit', ['role' => $role, 'permissions' => $permissions]);
    // }

    public function update($id, Request $request)
    {
        $timeslot                    = TimeSlot::find($id);
        $input                       = $request->all();
        $input['slot_type_name']     = config('constants.time_slot_types')[$input['slot_type_id']];
        $timeslot->name              = $input['name'];
        $timeslot->start_time        = $input['start_time'];
        $timeslot->end_time          = $input['end_time'];
        $timeslot->buffer_start_time = $input['buffer_start_time'];
        $timeslot->buffer_end_time   = $input['buffer_end_time'];
        $timeslot->slot_type_id      = $input['slot_type_id'];
        $timeslot->slot_type_name    = $input['slot_type_name'];
        $timeslot->update();

        Notify::success('Timeslot Updated Successfully!', 'Success', $options = []);
        return redirect()->back();
    }
}
