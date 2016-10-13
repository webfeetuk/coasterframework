<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_2_26_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Version_5_2_23_Seeder::class);
        $this->call(Version_5_2_26\AdminActionsSeeder::class);
        $this->call(Version_5_2_26\UserRolesActionsSeeder::class);
    }

}