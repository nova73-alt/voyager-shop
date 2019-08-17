<?php

namespace Tjventurini\VoyagerShop\Seeds;

use TCG\Voyager\Models\Menu;
use Illuminate\Database\Seeder;
use TCG\Voyager\Models\MenuItem;
use Illuminate\Support\Facades\DB;

class VoyagerShopMenuItemsSeeder extends Seeder
{
    /**
     * Run the voyager tags package database seeders.
     *
     * @return void
     */
    public function run()
    {
        DB::transaction(function () {
            // get the admin menu
            $menu = Menu::where('name', 'admin')->firstOrFail();

            // create shop menu item
            $parentItem = MenuItem::updateOrCreate([
                'title' => trans('shop::shop.label'),
            ], [
                'url' => '',
                'menu_id' => $menu->id,
                'target' => '_self',
                'icon_class' => 'voyager-shop',
                'color' => null,
                'parent_id' => null,
                'order' => 99,
            ]);

            // add menu item to menu
            $menu->items->add($parentItem);
            
            // orders

            // products
            $route = 'voyager.shop.products.index';
            $menuItem = MenuItem::updateOrCreate([
                'route' => $route,
            ], [
                'url' => '',
                'menu_id' => $menu->id,
                'parent_id' => $parentItem->id,
                'target' => '_self',
                'icon_class' => 'voyager-star',
                'color' => null,
                'order' => 2,
                'title' => trans('shop::products.label_plural'),
            ]);

            // product variants

            // country

            // currency

            // taxes

            // cards
        });
    }
}
