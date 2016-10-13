<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_2_36_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Version_5_2_35_Seeder::class);
        $this->call(Version_5_2_36\AdminActionsSeeder::class);
    }

}