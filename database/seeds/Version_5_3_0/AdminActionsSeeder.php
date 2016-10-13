<?php
namespace CoasterCmsDatabase\Seeds\Version_5_3_0;

use Carbon\Carbon;
use CoasterCms\Models\AdminAction;
use CoasterCms\Models\AdminController;
use Illuminate\Database\Seeder;

class AdminActionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;
        $controllerIds = AdminController::idsByController();

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['theme'],
                'action' => 'edit',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Edit Theme',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'name',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Set Alias',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['groups'],
                'action' => 'edit',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Edit Group Settings',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}