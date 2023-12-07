<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class MenuItemsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('menu_items')->delete();
        
        \DB::table('menu_items')->insert(array (
            0 => 
            array (
                'id' => 1,
                'menu_id' => 1,
                'title' => 'Inicio',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-home',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 1,
                'created_at' => '2021-06-02 13:55:32',
                'updated_at' => '2021-06-02 10:51:15',
                'route' => 'voyager.profile',
                'parameters' => 'null',
            ),
            1 => 
            array (
                'id' => 2,
                'menu_id' => 1,
                'title' => 'Media',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-images',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 3,
                'created_at' => '2021-06-02 13:55:32',
                'updated_at' => '2021-06-02 10:07:22',
                'route' => 'voyager.media.index',
                'parameters' => NULL,
            ),
            2 => 
            array (
                'id' => 3,
                'menu_id' => 1,
                'title' => 'Usuarios',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-person',
                'color' => '#000000',
                'parent_id' => 11,
                'order' => 1,
                'created_at' => '2021-06-02 13:55:32',
                'updated_at' => '2022-05-24 11:06:46',
                'route' => 'voyager.users.index',
                'parameters' => 'null',
            ),
            3 => 
            array (
                'id' => 4,
                'menu_id' => 1,
                'title' => 'Roles',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => NULL,
                'parent_id' => 11,
                'order' => 2,
                'created_at' => '2021-06-02 13:55:32',
                'updated_at' => '2021-06-02 10:08:05',
                'route' => 'voyager.roles.index',
                'parameters' => NULL,
            ),
            4 => 
            array (
                'id' => 5,
                'menu_id' => 1,
                'title' => 'Herramientas',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-tools',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 6,
                'created_at' => '2021-06-02 13:55:32',
                'updated_at' => '2023-12-06 14:31:40',
                'route' => NULL,
                'parameters' => '',
            ),
            5 => 
            array (
                'id' => 6,
                'menu_id' => 1,
                'title' => 'Menu Builder',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 1,
                'created_at' => '2021-06-02 13:55:33',
                'updated_at' => '2021-06-02 10:07:22',
                'route' => 'voyager.menus.index',
                'parameters' => NULL,
            ),
            6 => 
            array (
                'id' => 7,
                'menu_id' => 1,
                'title' => 'Database',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-data',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 2,
                'created_at' => '2021-06-02 13:55:33',
                'updated_at' => '2021-06-02 10:07:22',
                'route' => 'voyager.database.index',
                'parameters' => NULL,
            ),
            7 => 
            array (
                'id' => 8,
                'menu_id' => 1,
                'title' => 'Compass',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-compass',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 4,
                'created_at' => '2021-06-02 13:55:33',
                'updated_at' => '2021-06-02 10:07:22',
                'route' => 'voyager.compass.index',
                'parameters' => NULL,
            ),
            8 => 
            array (
                'id' => 9,
                'menu_id' => 1,
                'title' => 'BREAD',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bread',
                'color' => NULL,
                'parent_id' => 5,
                'order' => 5,
                'created_at' => '2021-06-02 13:55:33',
                'updated_at' => '2021-06-02 10:07:23',
                'route' => 'voyager.bread.index',
                'parameters' => NULL,
            ),
            9 => 
            array (
                'id' => 10,
                'menu_id' => 1,
                'title' => 'Configuraciones',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-settings',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 5,
                'created_at' => '2021-06-02 13:55:33',
                'updated_at' => '2023-12-06 14:31:40',
                'route' => 'voyager.settings.index',
                'parameters' => 'null',
            ),
            10 => 
            array (
                'id' => 11,
                'menu_id' => 1,
                'title' => 'Seguridad',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-lock',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 3,
                'created_at' => '2021-06-02 10:07:53',
                'updated_at' => '2023-11-15 10:28:13',
                'route' => NULL,
                'parameters' => '',
            ),
            11 => 
            array (
                'id' => 12,
                'menu_id' => 1,
                'title' => 'Limpiar cache',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-refresh',
                'color' => '#000000',
                'parent_id' => 5,
                'order' => 6,
                'created_at' => '2021-06-25 14:03:59',
                'updated_at' => '2022-05-24 11:06:32',
                'route' => 'clear.cache',
                'parameters' => NULL,
            ),
            12 => 
            array (
                'id' => 13,
                'menu_id' => 1,
                'title' => 'Permisos',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-list',
                'color' => NULL,
                'parent_id' => 11,
                'order' => 3,
                'created_at' => '2022-05-24 11:21:21',
                'updated_at' => '2022-05-24 11:21:31',
                'route' => 'voyager.permissions.index',
                'parameters' => NULL,
            ),
            13 => 
            array (
                'id' => 14,
                'menu_id' => 1,
                'title' => 'Militantes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => NULL,
                'parent_id' => NULL,
                'order' => 2,
                'created_at' => '2023-11-15 10:25:30',
                'updated_at' => '2023-11-15 10:28:13',
                'route' => 'voyager.people.index',
                'parameters' => NULL,
            ),
            14 => 
            array (
                'id' => 15,
                'menu_id' => 1,
                'title' => 'Reportes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-bar-chart',
                'color' => '#000000',
                'parent_id' => NULL,
                'order' => 4,
                'created_at' => '2023-12-06 14:31:04',
                'updated_at' => '2023-12-06 14:31:40',
                'route' => NULL,
                'parameters' => '',
            ),
            15 => 
            array (
                'id' => 16,
                'menu_id' => 1,
                'title' => 'Militantes',
                'url' => '',
                'target' => '_self',
                'icon_class' => 'voyager-people',
                'color' => '#000000',
                'parent_id' => 15,
                'order' => 1,
                'created_at' => '2023-12-06 14:31:27',
                'updated_at' => '2023-12-06 14:31:30',
                'route' => 'reports.people',
                'parameters' => NULL,
            ),
        ));
        
        
    }
}