<?php

namespace App\Providers;

use Harimayco\Menu\Models\Menus;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class MenuServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $menu = Menus::where('is_selected', true)->first();
        $public_menu = $menu->items;

        View::share('public_menu', $public_menu);
        View::share('menu', $menu);
    }
}
