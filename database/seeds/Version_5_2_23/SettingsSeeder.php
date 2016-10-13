<?php
namespace CoasterCmsDatabase\Seeds\Version_5_2_23;

use Carbon\Carbon;
use CoasterCms\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;

        Setting::insert([
            [
                'label' => 'Secure Upload Folders',
                'name' => 'site.secure_folders',
                'value' => 'secure',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}