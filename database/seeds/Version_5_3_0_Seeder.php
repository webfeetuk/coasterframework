<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_3_0_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Version_5_2_36_Seeder::class);
        $this->call(Version_5_3_0\AdminActionsSeeder::class);
        $this->call(Version_5_3_0\PageGroupPagesSeeder::class);
        $this->call(Version_5_3_0\UserRolesActionsSeeder::class);
    }

}