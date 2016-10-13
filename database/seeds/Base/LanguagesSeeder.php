<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\Language;
use Illuminate\Database\Seeder;

class LanguagesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;

        Language::insert([
            [
                'language' => 'English',
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}