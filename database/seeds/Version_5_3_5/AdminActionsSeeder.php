<?php
namespace CoasterCmsDatabase\Seeds\Version_5_3_5;

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
                'controller_id' => $controllerIds['adminsearch'],
                'action' => 'index',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Ajax Search',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}