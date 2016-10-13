<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_2_20_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Version_5_2_19_Seeder::class);
        $this->call(Version_5_2_20\AdminActionsSeeder::class);
        $this->call(Version_5_2_20\UserRolesActionsSeeder::class);
    }

}