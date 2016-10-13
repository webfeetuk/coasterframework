<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_36;

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
                'controller_id' => $controllerIds['search'],
                'action' => 'index',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'View Search Log',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}