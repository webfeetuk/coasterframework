<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_35;

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
        $controllerActionIds = AdminAction::idsByControllerAction();

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'version-schedule',
                'inherit' => $controllerActionIds['pages']['version-publish'],
                'edit_based' => 0,
                'name' => 'Schedule Versions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}