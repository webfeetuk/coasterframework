<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_3_5_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Version_5_3_0_Seeder::class);
        $this->call(Version_5_3_5\AdminActionsSeeder::class);
        $this->call(Version_5_3_5\AdminControllersSeeder::class);
    }

}