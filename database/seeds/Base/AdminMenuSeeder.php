<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\AdminAction;
use CoasterCms\Models\AdminController;
use CoasterCms\Models\AdminMenu;
use Illuminate\Database\Seeder;

class AdminMenuSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;
        $controllerActionsIds = AdminAction::idsByControllerAction();

        AdminMenu::insert([
            [
                'action_id' => $controllerActionsIds['home']['index'],
                'parent' => 0,
                'order' => 1,
                'icon' => 'fa fa-home',
                'item_name' => 'Dashboard',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['pages']['index'],
                'parent' => 0,
                'order' => 2,
                'icon' => 'fa fa-file-text-o',
                'item_name' => 'Pages',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['menus']['index'],
                'parent' => 0,
                'order' => 3,
                'icon' => 'fa fa-bars',
                'item_name' => 'Menus',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['blocks']['index'],
                'parent' => 0,
                'order' => 4,
                'icon' => 'fa fa-globe',
                'item_name' => 'Site-wide Content',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['redirects']['index'],
                'parent' => 0,
                'order' => 5,
                'icon' => 'fa fa-exchange',
                'item_name' => 'Redirects',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['filemanager']['index'],
                'parent' => 0,
                'order' => 6,
                'icon' => 'fa fa-folder-open',
                'item_name' => 'File Manager',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['users']['index'],
                'parent' => 0,
                'order' => 7,
                'icon' => 'fa fa-user',
                'item_name' => 'Users',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['roles']['index'],
                'parent' => 0,
                'order' => 8,
                'icon' => 'fa fa-bullhorn',
                'item_name' => 'Roles',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['themes']['index'],
                'parent' => 0,
                'order' => 9,
                'icon' => 'fa fa-tint',
                'item_name' => 'Theme',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'action_id' => $controllerActionsIds['themes']['beacons'],
                'parent' => 0,
                'order' => 9,
                'icon' => 'fa fa-bluetooth-b',
                'item_name' => 'Beacons',
                'item_desc' => '',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}