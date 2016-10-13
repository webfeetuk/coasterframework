<?php
namespace CoasterCmsDatabase\Seeds\Base;

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
                'label' => 'Site Name',
                'name' => 'site.name',
                'value' => 'Coaster CMS',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Site Email',
                'name' => 'site.email',
                'value' => 'info@example.com',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Site Page Limit',
                'name' => 'site.pages',
                'value' => '0',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Admin Path',
                'name' => 'admin.url',
                'value' => 'admin',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Admin Publishing',
                'name' => 'admin.publishing',
                'value' => '0',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Admin Per Page Permissions',
                'name' => 'admin.advanced_permissions',
                'value' => '0',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Default Template',
                'name' => 'admin.default_template',
                'value' => '2',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Pre-fill Title Block',
                'name' => 'admin.title_block',
                'value' => 'title',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Language',
                'name' => 'frontend.language',
                'value' => '1',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Theme',
                'name' => 'frontend.theme',
                'value' => '1',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'WP Blog Url (relative ie. /blog/)',
                'name' => 'blog.url',
                'value' => '',
                'editable' => 1,
                'hidden' => 0,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Kontakt API Key for Beacons',
                'name' => 'key.kontakt',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Bitly Access Token',
                'name' => 'key.bitly',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Youtube Server API Key',
                'name' => 'key.yt_server',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'label' => 'Youtube Browser API Key',
                'name' => 'key.yt_browser',
                'value' => '',
                'editable' => 1,
                'hidden' => 1,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}