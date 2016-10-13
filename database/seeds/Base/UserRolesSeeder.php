<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\UserRole;
use Illuminate\Database\Seeder;

class UserRolesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;

        UserRole::insert([
            [
                'name' => 'Coaster Superuser',
                'admin' => 2,
                'description' => 'Unrestricted Account (can only be removed by superusers)',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Coaster Admin',
                'admin' => 1,
                'description' => 'Default Admin Account',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Coaster Editor',
                'admin' => 1,
                'description' => 'Default Editor Account',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Coaster Account (Login Access Only)',
                'admin' => 1,
                'description' => 'Base Account With Login Access',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'name' => 'Frontend Guest Account',
                'admin' => 0,
                'description' => 'Default Guest Account (no admin access)',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}