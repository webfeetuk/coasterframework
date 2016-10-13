<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\AdminAction;
use CoasterCms\Models\UserRole;
use CoasterCms\Models\UserRoleAction;
use Illuminate\Database\Seeder;

class UserRolesActionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;
        $userRoleIds = UserRole::idsByName();
        $controllerActionsIds = AdminAction::idsByControllerAction();

        UserRoleAction::insert([
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['pages']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['pages']['sort'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['pages']['add'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['pages']['edit'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['pages']['delete'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['pages']['version-publish'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['menus']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['menus']['add'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['menus']['delete'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['menus']['sort'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['menus']['rename'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['blocks']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['filemanager']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['filemanager']['edit'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['redirects']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['redirects']['edit'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['account']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['account']['password'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['account']['blog'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['system']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['system']['update'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['users']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['users']['edit'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['roles']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['backups']['restore'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['themes']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['themes']['beacons'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Admin'],
                'action_id' => $controllerActionsIds['themes']['beacons-update'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['pages']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['pages']['sort'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['pages']['add'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['menus']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['menus']['sort'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['menus']['rename'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['blocks']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['filemanager']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['filemanager']['edit'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['redirects']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['filemanager']['edit'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['account']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['account']['password'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['account']['blog'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['system']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Editor'],
                'action_id' => $controllerActionsIds['users']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Account (Login Access Only)'],
                'action_id' => $controllerActionsIds['account']['index'],
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'role_id' => $userRoleIds['Coaster Account (Login Access Only)'],
                'action_id' => $controllerActionsIds['account']['password'],
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}