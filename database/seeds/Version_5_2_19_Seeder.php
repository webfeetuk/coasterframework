<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_2_19_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(BaseSeeder::class);
        $this->call(Version_5_2_19\AdminActionsSeeder::class);
        $this->call(Version_5_2_19\UserRolesActionsSeeder::class);
    }

}