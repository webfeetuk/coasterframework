<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_22;

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
                'controller_id' => $controllerIds['themes'],
                'action' => 'manage',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Add/Remove Themes',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}