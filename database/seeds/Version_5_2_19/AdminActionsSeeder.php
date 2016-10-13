<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_19;

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
                'action' => 'forms',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Change Form Rules',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        AdminAction::where('controller_id', '=', $controllerIds['themes'])->where('action', '=', 'update')->update([
            'name' => 'Theme Block Updater',
            'inherit' => 0
        ]);

        AdminAction::where('controller_id', '=', $controllerIds['themes'])->where('action', '=', 'index')->update([
            'name' => 'Show Theme Management'
        ]);
    }

}