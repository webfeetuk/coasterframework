<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_26;

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
                'controller_id' => $controllerIds['themes'],
                'action' => 'list',
                'inherit' => $controllerActionIds['themes']['index'],
                'edit_based' => 0,
                'name' => 'View Uploaded Themes',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['themes'],
                'action' => 'export',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Export Uploaded Themes',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}