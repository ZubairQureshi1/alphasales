<?php

namespace App\Observers;

use Harimayco\Menu\Models\MenuItems;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Permission;

class SystemMenuObserver
{
    /**
     * Handle the menu items "created" event.
     *
     * @param  \App\MenuItems  $menuItems
     * @return void
     */
    public function created(MenuItems $menuItems)
    {
        //
    }

    /**
     * Handle the menu items "updated" event.

     * @param  \App\MenuItems  $menuItems
     * @return void
     */
    public function updated(MenuItems $menuItems)
    {
        // $permissions = Permission::where('system_menu_id', $menuItems->parent)->get();
        // \Log::info($permissions);
    }

    /**
     * Handle the menu items "updating" event.

     * @param  \App\MenuItems  $menuItems
     * @return void
     */
    public function updating(MenuItems $menuItems)
    {
        if($menuItems->isDirty('label')){
            // email has changed
            $new_name    = $menuItems->label; 
            $old_name    = $menuItems->getOriginal('label');
            $permissions = Permission::where('module_name', Str::snake($old_name))->get();

            if (count($permissions) > 0) {
                 foreach ($permissions as $key => $permission) {
                    $permission->module_name = Str::snake($menuItems->label);
                    $permission->name        = Str::snake($permission->action_name. ' '.$new_name);
                    $permission->update();
                }
                \Log::info($permissions);
            } else {
                \Log::info(Str::snake($old_name));
            }
        }
    }

    /**
     * Handle the menu items "deleted" event.
     *
     * @param  \App\MenuItems  $menuItems
     * @return void
     */
    public function deleted(MenuItems $menuItems)
    {
        //
    }

    /**
     * Handle the menu items "restored" event.
     *
     * @param  \App\MenuItems  $menuItems
     * @return void
     */
    public function restored(MenuItems $menuItems)
    {
        //
    }

    /**
     * Handle the menu items "force deleted" event.
     *
     * @param  \App\MenuItems  $menuItems
     * @return void
     */
    public function forceDeleted(MenuItems $menuItems)
    {
        //
    }
}
