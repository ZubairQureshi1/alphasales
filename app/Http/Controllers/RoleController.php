<?php

namespace App\Http\Controllers;

use App\Models\Department;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Toastr;

class RoleController extends Controller
{

    public function index(Request $request)
    {
        $roles = Role::where('name', '!=', 'mobile_user')->get();
        return view('roles.index', ['roles' => $roles]);
    }

    public function create()
    {
        $permissions = Permission::all()->groupBy('module_name');
        $departments = Department::get();
        // dd($departments);
        
        return view('roles.create', ['permissions' => $permissions, 'departments' => $departments]);
    }

    public function store(Request $request)
    {
        $input     = $request->all();
        $role_name = Str::snake(strtolower($input['name']));
        $role      = Role::create([
            'name'         => $role_name,
            'display_name' => $input['name'],
        ]);

        $role->givePermissionTo($input['permission']);
        Toastr::success('Role created successfully.', $title = null, $options = []);
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $role = Role::find($id);

        if (empty($role)) {
            Toastr::error('Role not found.', $title = null, $options = []);
            return redirect(route('roles.index'));
        }
        $role->delete();
        Toastr::error('Role deleted successfully.', $title = null, $options = []);
        return redirect(route('roles.index'));

    }

    public function show($id)
    {
        $role            = Role::find($id);
        $role_permission = $role->permissions->keyBy('name');
        $permissions     = Permission::where('system_menu_id', '!=', null)->get()->keyBy('name');

        foreach ($permissions as $key => $permission) {
            foreach ($role_permission as $permission_key => $hasPermission) {
                if (!$permission['isChecked']) {
                    if ($key == $permission_key) {
                        $permission['isChecked'] = true;
                    } else {
                        $permission['isChecked'] = false;
                    }
                }
            }
        }
        $permissions = $permissions->groupBy('module_name');
        if (empty($role)) {
            Toastr::error('Role not found.', $title = null, $options = []);
            return redirect(route('roles.index'));
        }
        return view('roles.show', ['role' => $role, 'permissions' => $permissions]);
    }

    public function edit($id)
    {
        $role = Role::find($id);
        // $assigned_permissions = $role->permissions->groupBy('module_name');
        $role_permission = $role->permissions->keyBy('name');
        $permissions     = Permission::where('system_menu_id', '!=', null)->get()->keyBy('name');

        foreach ($permissions as $key => $permission) {
            foreach ($role_permission as $permission_key => $hasPermission) {
                if (!$permission['isChecked']) {
                    if ($key == $permission_key) {
                        $permission['isChecked'] = true;
                    } else {
                        $permission['isChecked'] = false;
                    }
                }
            }
        }
        $permissions = $permissions->groupBy('module_name');
        if (empty($role)) {
            Toastr::error('Role not found.', $title = null, $options = []);
            return redirect(route('roles.index'));
        }
        return view('roles.edit', ['role' => $role, 'permissions' => $permissions]);
    }

    public function update($id, Request $request)
    {
        $role  = Role::find($id);
        $input = $request->all();
        // dd($input['permission']);
        // dd($input, $id);
        $role->syncPermissions($input['permission']);
        if (empty($role)) {
            Toastr::error('Role not found.', $title = null, $options = []);
            return redirect(route('roles.index'));
        }
        Toastr::success('Role updated successfully.', $title = null, $options = []);
        return redirect(route('roles.index'));
    }
}
