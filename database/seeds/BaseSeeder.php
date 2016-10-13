<?php
namespace CoasterCmsDatabase\Seeds;

use Illuminate\Database\Seeder;

class BaseSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Base\SettingsSeeder::class);
        $this->call(Base\LanguagesSeeder::class);
        $this->call(Base\AdminControllersSeeder::class);
        $this->call(Base\AdminActionsSeeder::class);
        $this->call(Base\AdminMenuSeeder::class);
        $this->call(Base\UserRolesSeeder::class);
        $this->call(Base\UserRolesActionsSeeder::class);
        $this->call(Base\AdminLogsSeeder::class);
    }

}