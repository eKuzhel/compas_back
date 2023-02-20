<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Encore\Admin\Auth\Database\Menu;

/**
 * Class MenuSeeder
 */
class MenuSeeder extends Seeder
{
    const MENU_ITEMS = [
        [
            'order' => 1,
            'title' => 'Регионы',
            'icon' => 'fa-tasks',
            'uri' => 'regions',
        ],
        [

            'order' => 2,
            'title' => 'Больницы',
            'icon' => 'fa-hospital-o',
            'uri' => 'hospital',
        ],
        [

            'order' => 3,
            'title' => 'Врачи',
            'icon' => 'fa-medkit',
            'uri' => 'doctor',
        ],

    ];

    public function run()
    {
        foreach (self::MENU_ITEMS as $item) {
            $uri = $item['uri'];
            $exist = Menu::query()->where('uri', '=', $uri)->exists();
            if ($exist) {
                continue;
            }

            $model = new Menu();
            $model->fill($item);
            if (!empty($parentId)) {
                $model->parent_id = $parentId;
            }
            $model->save();

        }
    }
}
