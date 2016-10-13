<?php
namespace CoasterCmsDatabase\Seeds\Version_5_3_0;

use Carbon\Carbon;
use CoasterCms\Models\Page;
use CoasterCms\Models\PageGroupPage;
use Illuminate\Database\Seeder;

class PageGroupPagesSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;

        $addRows = [];
        foreach (Page::all() as $page) {
            if ($page->in_group) {
                $addRows[] = [
                    'page_id' => $page->id,
                    'group_id' => $page->in_group,
                    'created_at' => $date,
                    'updated_at' => $date
                ];
            }
        }
        PageGroupPage::insert($addRows);
    }

}