<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\AdminLog;
use CoasterCms\Models\User;
use Illuminate\Database\Seeder;

class AdminLogsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;
        $user = User::orderBy('id', 'DESC')->first();
        $userId = $user ? $user->id : 0;

        AdminLog::insert([
            [
                'user_id' => $userId,
                'log' => 'Setup CMS',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}