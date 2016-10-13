<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_36;

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
                'controller' => 'search',
                'role_name' => 'Search log',
                'role_order' => 4,
                'role_section' => 3,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}