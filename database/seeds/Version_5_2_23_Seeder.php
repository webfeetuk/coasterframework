<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class Version_5_2_23_Seeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Version_5_2_22_Seeder::class);
        $this->call(Version_5_2_23\SettingsSeeder::class);
    }

}