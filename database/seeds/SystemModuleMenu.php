<?php

use Harimayco\Menu\Models\Menus;
use Illuminate\Database\Seeder;

class SystemModuleMenu extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $menu = new Menus();
        $menu->name = "Analogy Menu";
        $menu->is_selected = true;
        $menu->save();
    }
}
