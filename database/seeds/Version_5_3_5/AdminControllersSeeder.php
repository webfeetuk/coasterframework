<?php
namespace CoasterCmsDatabase\Seeds\Version_5_3_5;

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
                'controller' => 'adminsearch',
                'role_name' => 'Admin Search',
                'role_order' => 0,
                'role_section' => 2,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}