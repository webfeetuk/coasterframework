<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\AdminController;
use Illuminate\Database\Seeder;

class AdminControllersSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;

        AdminController::insert([
            [
                'controller' => 'home',
                'role_name' => 'Dashboard',
                'role_order' => 1,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'pages',
                'role_name' => 'Pages',
                'role_order' => 1,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'groups',
                'role_name' => 'Groups',
                'role_order' => 1,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'menus',
                'role_name' => 'Menus',
                'role_order' => 2,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'blocks',
                'role_name' => 'Site-wide Content',
                'role_order' => 3,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'filemanager',
                'role_name' => 'Filemanager',
                'role_order' => 4,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'redirects',
                'role_name' => 'Redirects',
                'role_order' => 5,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'account',
                'role_name' => 'User Account',
                'role_order' => 1,
                'role_section' => 2,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'system',
                'role_name' => 'System Settings',
                'role_order' => 2,
                'role_section' => 2,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'users',
                'role_name' => 'Users',
                'role_order' => 1,
                'role_section' => 3,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'roles',
                'role_name' => 'Roles',
                'role_order' => 2,
                'role_section' => 3,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'backups',
                'role_name' => 'Backups',
                'role_order' => 3,
                'role_section' => 3,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'repeaters',
                'role_name' => 'Repeaters',
                'role_order' => 1,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'gallery',
                'role_name' => 'Galleries',
                'role_order' => 1,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'forms',
                'role_name' => 'Forms',
                'role_order' => 1,
                'role_section' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller' => 'themes',
                'role_name' => 'Themes',
                'role_order' => 3,
                'role_section' => 2,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}