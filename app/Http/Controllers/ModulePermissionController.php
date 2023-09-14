<?php

namespace App\Http\Controllers;

use Harimayco\Menu\Models\MenuItems;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class ModulePermissionController extends Controller
{
    public function index()
    {
        $permissions = Permission::get()->where('system_menu_id', '!=', null)->groupBy('system_menu_id');
        return view('permissions.index', compact('permissions'));
    }

    public function store(Request $request)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $request->validate([
            'permissions',
        ]);
        $menuItem = MenuItems::where('id', $request->systemMenu)->firstOrFail();
        foreach ($request->permissions as $key => $perm) {
            Permission::create([
                'name'           => Str::snake($perm . $menuItem->label),
                'action_name'    => ucfirst($perm),
                'module_name'    => Str::snake($menuItem->label),
                'system_menu_id' => $menuItem->id,
            ]);
        }
        return redirect()->back();
    }

    public function edit($id)
    {
        $permission = Permission::where('system_menu_id', $id)->get();

        return view('permissions.edit', compact('permission'));
    }

    public function update(Request $request, $id)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $menuItem = MenuItems::where('id', $id)->firstOrFail();
        // update permission
        foreach ($request->permission_ids as $key => $perm) {
            if (isset($perm)) {
                Permission::where('id', $perm)->update([
                    'name'        => Str::snake($request->permissions[$key] . $menuItem->label),
                    'action_name' => ucfirst($request->permissions[$key]),
                ]);
            } else {
                Permission::create([
                    'name'           => Str::snake($request->permissions[$key] . $menuItem->label),
                    'action_name'    => ucfirst($request->permissions[$key]),
                    'module_name'    => Str::snake($menuItem->label),
                    'system_menu_id' => $menuItem->id,
                ]);
            }
        }
        return redirect()->route('permissions.index');
    }

    public function delete($id)
    {
        app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
        $permission = Permission::where('system_menu_id', $id)->delete();
        return redirect()->back();
    }

    public function removePermission(Permission $permission)
    {
        try {
            \DB::beginTransaction();
            app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
            $permission->delete();
            \DB::commit();
            return response()->json(['success' => true], 200);
        } catch (\Exception $e) {
            \DB::rollback();
            if ($e->getCode() != 0) {
                if (in_array(1062, $e->errorInfo)) {
                    $exception_message = str_replace('admissions_', '', $e->errorInfo[2]);
                    $replaced_message  = str_replace('_unique', '', $exception_message);
                    $message           = str_replace('key', '', $replaced_message);
                    return response()->json(['success' => false, 'error' => $message], 500);
                } else {
                    return response()->json(['success' => false, 'error' => 'Something went wrong.'], 500);
                }
            } else {
                $exception_message                = $e->getMessage();
                $exception_message_semi_col_split = explode(":", $exception_message);
                $message                          = 'Something went wrong at ' . '"' . str_replace(' ', '', str_replace('_', '-', $exception_message_semi_col_split[1])) . '"';
                return response()->json(['success' => false, 'error' => $message], 500);
            }

        }
    }
}
