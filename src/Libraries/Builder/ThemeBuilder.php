<?php namespace CoasterCms\Libraries\Builder;

use CoasterCms\Models\Block;
use CoasterCms\Models\BlockCategory;
use CoasterCms\Models\BlockRepeater;
use CoasterCms\Models\BlockSelectOption;
use CoasterCms\Models\Template;
use CoasterCms\Models\TemplateBlock;
use CoasterCms\Models\Theme;
use CoasterCms\Models\ThemeBlock;
use Illuminate\Support\Facades\View;

class ThemeBuilder
{

    // default properties from PageBuilder class
    public static $theme;
    public static $page_info;
    public static $preview = false;

    // current settings
    private static $_theme;
    private static $_template;
    private static $_repeater;

    // all blocks in blocks table
    private static $_allBlocks;

    // used repeater blocks in theme files
    private static $_repeaterBlocks;
    private static $_repeaterTemplates;

    // block options
    private static $_selectBlocks;
    private static $_formRules;

    // block overwrite guesses
    private static $_blockSettings;

    // all blocks in theme files
    private static $_fileBlocks;
    private static $_fileGlobalBlocks;
    private static $_fileTemplateBlocks;
    private static $_fileBlockTemplates; // only available after saving templates

    // all blocks/templates used in selected theme
    private static $_databaseBlocks;
    private static $_databaseGlobalBlocks;
    private static $_databaseTemplateBlocks;
    private static $_databaseRepeaterBlocks;
    private static $_databaseTemplates;
    private static $_databaseTemplateIds;
    private static $_databaseBlockTemplates;

    // load block category ids for use in category guess
    private static $_categoryIds;
    private static $_guessedCategoryIds;

    public static function processFiles($themeId)
    {
        self::$_theme = Theme::find($themeId);
        if (!empty(self::$_theme)) {
            $themePath = base_path('resources/views/themes/' . self::$_theme->theme . '/templates');

            self::_checkRepeaterTemplates();
            self::_checkSelectBlocks();

            self::_getBlockOverwriteFile();

            self::$theme = self::$_theme->theme;
            self::$page_info = new \stdClass;
            self::$page_info->name = '';
            self::$page_info->url = '';

            \CoasterCms\Libraries\Builder\PageBuilder::$theme = self::$theme;

            if (is_dir($themePath)) {
                foreach (scandir($themePath) as $templateFile) {
                    if (self::$_template = explode('.', $templateFile)[0]) {
                        self::$page_info->template_name = self::$_template;
                        View::make('themes.' . self::$_theme->theme . '.templates.' . self::$_template)->render();
                    }
                }
                self::_processDatabaseBlocks();
                self::_processFileBlocks();
            }
        }
    }

    private static function _checkRepeaterTemplates()
    {
        self::$_repeater = null;
        self::$_repeaterBlocks = [];
        self::$_repeaterTemplates = [];

        $repeaterPath = base_path('resources/views/themes/' . self::$_theme->theme . '/blocks/repeaters');
        if (is_dir($repeaterPath)) {
            foreach (scandir($repeaterPath) as $repeaterFile) {
                if ($repeaterTemplate = explode('.', $repeaterFile)[0]) {
                    self::$_repeaterTemplates[] = $repeaterTemplate;
                }
            }
        }
    }

    private static function _checkSelectBlocks()
    {
        self::$_selectBlocks = [];

        $selectOptions = base_path('resources/views/themes/' . self::$_theme->theme . '/import/blocks/select_options.csv');
        if (file_exists($selectOptions) && ($fileHandle = fopen($selectOptions, 'r')) !== false) {
            $row = 0;
            while (($data = fgetcsv($fileHandle)) !== false) {
                if (count($data) == 3) {
                    if ($row++ == 0 && $data[0] == 'Block Name') {
                        continue;
                    }
                    if (!isset(self::$_selectBlocks[$data[0]])) {
                        self::$_selectBlocks[$data[0]] = [];
                    }
                    self::$_selectBlocks[$data[0]][$data[2]] = $data[1];
                }
            }
            fclose($fileHandle);
        }
    }

    private static function _getBlockOverwriteFile()
    {
        self::$_blockSettings = [];

        $selectOptions = base_path('resources/views/themes/' . self::$_theme->theme . '/import/blocks.csv');
        if (file_exists($selectOptions) && ($fileHandle = fopen($selectOptions, 'r')) !== false) {
            $row = 0;
            while (($data = fgetcsv($fileHandle)) !== false) {
                if ($row++ == 0 && $data[0] == 'Block Name') continue;
                if (!empty($data[0])) {
                    $fields = ['name', 'label', 'category_id', 'type', 'global_site', 'global_pages', 'order'];
                    foreach ($fields as $fieldId => $field) {
                        if (isset($data[$fieldId])) {
                            $setting = trim($data[$fieldId]);
                            if ($setting != '') {
                                if (in_array($field, ['global_site', 'global_pages'])) {
                                    if (empty($setting) || strtolower($setting) == 'false' || strtolower($setting) == 'no' || strtolower($setting) == 'n') {
                                        $setting = false;
                                    } else {
                                        $setting = true;
                                    }
                                }
                                if ($field == 'category_id') {
                                    $setting = self::_getBlockCategoryId($setting);
                                }
                                self::$_blockSettings[$data[0]][$field] = $setting;
                            }
                        }
                    }
                }
            }
            fclose($fileHandle);
        }
    }

    private static function _getBlockCategoryId($categoryName)
    {
        if (!isset(self::$_categoryIds)) {
            foreach (BlockCategory::all() as $category) {
                self::$_categoryIds[trim(strtolower($category->name))] = $category->id;
            }
        }

        if (empty(self::$_categoryIds[trim(strtolower($categoryName))])) {
            $newBlockCategory = new BlockCategory;
            $newBlockCategory->name = trim($categoryName);
            $newBlockCategory->save();
            self::$_categoryIds[trim(strtolower($categoryName))] = $newBlockCategory->id;
        }

        return self::$_categoryIds[trim(strtolower($categoryName))];
    }

    private static function _processFileBlocks()
    {
        self::$_fileBlocks = [];
        self::$_fileGlobalBlocks = [];

        // move non template specific blocks to end of array
        if (!empty(self::$_fileTemplateBlocks[0])) {
            $nonTemplateBlocks = self::$_fileTemplateBlocks[0];
            unset(self::$_fileTemplateBlocks[0]);
            self::$_fileTemplateBlocks[0] = $nonTemplateBlocks;
        }

        $blockCounter = [];
        $templateCount = count(self::$_fileTemplateBlocks);

        $blockOrders = [];
        foreach (self::$_allBlocks as $block => $details) {
            $blockOrders[$block] = $details->order;
        }

        // get full block list and details in one array
        foreach (self::$_fileTemplateBlocks as $template => $blocks) {
            $order = 10;
            foreach ($blocks as $k => $block) {
                if (!isset(self::$_fileBlocks[$block])) {
                    if (isset($blocks[$k - 1]) && !empty($blockOrders[$blocks[$k - 1]])) {
                        $order = $blockOrders[$blocks[$k - 1]] + 10;
                    } else {
                        $order += 10;
                    }
                    $blockOrders[$block] = $order;
                    $blockCounter[$block] = 0;
                    self::$_fileBlocks[$block] = ['order' => $blockOrders[$block]];
                    if (in_array($block, self::$_repeaterTemplates)) {
                        self::$_fileBlocks[$block]['type'] = 'repeater';
                    }
                }
                $blockCounter[$block]++;
            }
        }

        foreach ($blockCounter as $block => $count) {
            if (($count / $templateCount) >= 0.7) {
                self::$_fileGlobalBlocks[$block] = 1;
            }
        }

        if (!empty(self::$_blockSettings)) {
            foreach (self::$_blockSettings as $block => $field) {
                if (empty(self::$_fileBlocks[$block])) {
                    if (empty(self::$_blockSettings[$block]['order'])) {
                        self::$_blockSettings[$block]['order'] = 50;
                    }
                    self::$_fileBlocks[$block] = self::$_blockSettings[$block];
                }
            }
        }

    }

    private static function _processDatabaseBlocks()
    {
        self::$_allBlocks = [];
        self::$_databaseBlocks = [];
        self::$_databaseGlobalBlocks = [];
        self::$_databaseTemplateBlocks = [];
        self::$_databaseTemplates = [];
        self::$_databaseTemplateIds = [];
        self::$_databaseBlockTemplates = [];

        $blocksById = [];
        $allBlocks = Block::all();
        foreach ($allBlocks as $block) {
            $blocksById[$block->id] = $block;
            self::$_allBlocks[$block->name] = $block;
        }

        $globalBlocks = ThemeBlock::where('theme_id', '=', self::$_theme->id)->get();
        foreach ($globalBlocks as $globalBlock) {
            if (!isset($blocksById[$globalBlock->block_id])) {
                $globalBlock->delete();
            } else {
                self::$_databaseBlocks[$blocksById[$globalBlock->block_id]->name] = $blocksById[$globalBlock->block_id];
                self::$_databaseGlobalBlocks[$blocksById[$globalBlock->block_id]->name] = $globalBlock;
            }
        }

        $templates = Template::where('theme_id', '=', self::$_theme->id)->get();
        if (!$templates->isEmpty()) {
            $templateIds = [];
            $templatesById = [];
            foreach ($templates as $template) {
                $templateIds[] = $template->id;
                $templatesById[$template->id] = $template->template;
                self::$_databaseTemplateBlocks[$template->template] = [];
                self::$_databaseTemplates[$template->template] = $template;
                self::$_databaseTemplateIds[] = $template->id;
            }
            $templateBlocks = TemplateBlock::whereIn('template_id', $templateIds)->get();
            if (!$templateBlocks->isEmpty()) {
                foreach ($templateBlocks as $templateBlock) {
                    if (!isset($blocksById[$templateBlock->block_id])) {
                        $templateBlock->delete();
                    } else {
                        self::$_databaseBlocks[$blocksById[$templateBlock->block_id]->name] = $blocksById[$templateBlock->block_id];
                        self::$_databaseTemplateBlocks[$templatesById[$templateBlock->template_id]][] = $blocksById[$templateBlock->block_id]->name;
                        if (!isset(self::$_databaseBlockTemplates[$blocksById[$templateBlock->block_id]->name])) {
                            self::$_databaseBlockTemplates[$blocksById[$templateBlock->block_id]->name] = [];
                        }
                        self::$_databaseBlockTemplates[$blocksById[$templateBlock->block_id]->name][] = $templateBlock->template_id;
                    }
                }
            }
        }

        // load repeaters
        self::$_databaseRepeaterBlocks = [];
        $repeaterBlocks = BlockRepeater::all();
        foreach ($repeaterBlocks as $repeaterBlock) {
            self::$_databaseRepeaterBlocks[$repeaterBlock->block_id] = $repeaterBlock;
        }

        foreach (self::$_databaseBlocks as $block => $databaseBlock) {
            if ($databaseBlock->type == 'repeater') {
                self::_loadDatabaseRepeaterBlocks($databaseBlock->id, $blocksById);
            }
        }

    }

    private static function _loadDatabaseRepeaterBlocks($repeaterBlockId, $blocksById)
    {
        if (!empty(self::$_databaseRepeaterBlocks[$repeaterBlockId])) {
            $blockIds = explode(',', self::$_databaseRepeaterBlocks[$repeaterBlockId]->blocks);
            foreach ($blockIds as $blockId) {
                if (!isset(self::$_databaseBlocks[$blocksById[$blockId]->name])) {
                    self::$_databaseBlocks[$blocksById[$blockId]->name] = $blocksById[$blockId];
                    if ($blocksById[$blockId]->type == 'repeater') {
                        self::_loadDatabaseRepeaterBlocks($blockId, $blocksById);
                    }
                }
            }
        }
    }

    /*
     * Get Data Functions
     */

    public static function getThemeName()
    {
        return !empty(self::$_theme) ? self::$_theme->theme : '';
    }

    public static function getNewBlocks()
    {
        // array of empty details array
        return array_diff_key(self::$_fileBlocks, self::$_databaseBlocks);
    }

    public static function getExistingBlocks()
    {
        // array of Block Models
        return array_intersect_key(self::$_databaseBlocks, self::$_fileBlocks);
    }

    public static function getDeletedBlocks()
    {
        // array of Block Models
        return array_diff_key(self::$_databaseBlocks, self::$_fileBlocks);
    }

    public static function getMainTableData()
    {
        $themeBlocks = [];
        foreach (self::getNewBlocks() as $newBlock => $details) {
            $themeBlocks[$newBlock] = self::_getBlockData($newBlock, $details);
            $themeBlocks[$newBlock]['run_template_update'] = true;
        }
        foreach (self::getExistingBlocks() as $existingBlock => $details) {
            $themeBlocks[$existingBlock] = self::_getBlockData($existingBlock);
            $themeBlocks[$existingBlock]['run_template_update'] = false;
        }
        return $themeBlocks;
    }

    private static function _getBlockData($block, $details = [])
    {
        $processedData = [];
        if (isset(self::$_allBlocks[$block])) {
            $processedData['category_id'] = self::$_allBlocks[$block]->category_id;
            $processedData['label'] = self::$_allBlocks[$block]->label;
            $processedData['name'] = self::$_allBlocks[$block]->name;
            $processedData['type'] = self::$_allBlocks[$block]->type;
            $processedData['global_site'] = (bool)(!empty(self::$_databaseGlobalBlocks[$block]) ? self::$_databaseGlobalBlocks[$block]->show_in_global : 0);
            $processedData['global_pages'] = (bool)(!empty(self::$_databaseGlobalBlocks[$block]) ? self::$_databaseGlobalBlocks[$block]->show_in_pages : 0);
        } else {
            $processedData['category_id'] = self::_categoryGuess($block);
            $processedData['label'] = ucwords(str_replace('_', ' ', $block));
            $processedData['name'] = $block;
            $processedData['type'] = !empty($details['type']) ? $details['type'] : self::_typeGuess($block);
            $processedData['global_site'] = isset(self::$_fileGlobalBlocks[$block]);
            $processedData['global_pages'] = (bool)stristr($block, 'meta');
        }
        // overwrite block types from import csv
        if (!empty(self::$_blockSettings[$block])) {
            foreach (self::$_blockSettings[$block] as $setting => $value) {
                $processedData[$setting] = $value;
            }
        }

        return $processedData;
    }

    private static function _categoryGuess($block)
    {
        if (!isset(self::$_guessedCategoryIds)) {
            $findKeys = [
                'main' => ['main'],
                'banner' => ['banner', 'carousel'],
                'seo' => ['seo'],
                'footer' => ['foot'],
                'header' => ['head']
            ];

            self::$_guessedCategoryIds = [];
            $first = true;
            foreach (BlockCategory::all() as $category) {
                if ($first) {
                    $first = false;
                    $keys['main'] = $category->id;
                }
                foreach ($findKeys as $key => $matches) {
                    foreach ($matches as $match) {
                        if (stristr($category->name, $match)) {
                            self::$_guessedCategoryIds[$key] = $category->id;
                        }
                    }
                }
            }

            $order = 0;
            foreach ($findKeys as $key => $matches) {
                $order += 10;
                if (!isset(self::$_guessedCategoryIds[$key])) {
                    $newBlockCategory = new BlockCategory;
                    $newBlockCategory->name = ucwords($key);
                    $newBlockCategory->order = ($key=='seo')?100:$order;
                    $newBlockCategory->save();
                    self::$_guessedCategoryIds[$key] = $newBlockCategory->id;
                    self::$_categoryIds[$newBlockCategory->name] = $newBlockCategory->id;
                }
            }
        }

        $categoryFound = self::$_guessedCategoryIds['main'];

        $categoriesArr = [];
        $categoriesArr[self::$_guessedCategoryIds['seo']] = ['meta'];
        $categoriesArr[self::$_guessedCategoryIds['header']] = ['header_html', 'head', 'logo', 'phone'];
        $categoriesArr[self::$_guessedCategoryIds['footer']] = ['footer_html', 'foot', 'address', 'email', 'copyright'];
        $categoriesArr[self::$_guessedCategoryIds['banner']] = ['banner', 'carousel'];
        foreach ($categoriesArr as $_guessedCategoryIds => $matches) {
            foreach ($matches as $match) {
                if (stristr($block, $match)) {
                    $categoryFound = $_guessedCategoryIds;
                }
            }
        }

        return $categoryFound;
    }

    private static function _typeGuess($block)
    {
        $typesArr = [
            'video' => ['vid'],
            'text' => ['text', 'desc', 'keywords', 'intro', 'address', 'html', 'lead'],
            'richtext' => ['richtext', 'content', 'copy'],
            'image' => ['image', 'img', 'banner', 'logo'],
            'link' => ['link', 'url'],
            'datetime' => ['date', 'datetime'],
            'string' => ['link_text', 'caption', 'title'],
            'form' => ['form', 'contact'],
            'select' => ['select'],
            'selectmultiple' => ['selectmultiple', 'multipleselect'],
            'selectpage' => ['selectpage'],
            'selectpages' => ['selectpages']
        ];
        $typeFound = 'string';
        foreach ($typesArr as $type => $matches) {
            foreach ($matches as $match) {
                if (stristr($block, $match)) {
                    $typeFound = $type;
                }
            }
        }
        if (strpos($typeFound, 'select') === false && !empty(self::$_selectBlocks[$block])) {
            $typeFound = 'select';
        }
        return $typeFound;
    }

    /*
     * Update Functions
     */

    public static function saveTemplates()
    {
        foreach (self::$_fileTemplateBlocks as $template => $blocks) {
            if (empty(self::$_databaseTemplates[$template]) && $template !== 0) {
                $newTemplate = new Template;
                $newTemplate->theme_id = self::$_theme->id;
                $newTemplate->template = $template;
                $newTemplate->label = ucwords(str_replace('_', ' ', $template)).' Template';
                $newTemplate->save();
                self::$_databaseTemplates[$template] = $newTemplate;
                self::$_databaseTemplateIds[] = $newTemplate->id;
            }
        }

        // create fileBlockTemplates array
        self::$_fileBlockTemplates = [];
        foreach (self::$_fileTemplateBlocks as $template => $blocks) {
            if ($template !== 0) {
                foreach ($blocks as $block) {
                    if (!isset(self::$_fileBlockTemplates[$block])) {
                        self::$_fileBlockTemplates[$block] = [];
                    }
                    self::$_fileBlockTemplates[$block][] = self::$_databaseTemplates[$template]->id;
                }
            }
        }
    }

    public static function saveBlock($block, $blockData)
    {
        if (isset(self::$_fileBlocks[$block])) {
            if (!empty(self::$_allBlocks[$block])) {
                $existingBlock = self::$_allBlocks[$block];
                if ($existingBlock->type != $blockData['type'] || $existingBlock->label != $blockData['label'] || $existingBlock->category_id != $blockData['category_id']) {
                    $existingBlock->category_id = $blockData['category_id'];
                    $existingBlock->type = $blockData['type'];
                    $existingBlock->label = $blockData['label'];
                    $existingBlock->save();
                }
            } else {
                $newBlock = new Block;
                $newBlock->category_id = $blockData['category_id'];
                $newBlock->name = $block;
                $newBlock->type = $blockData['type'];
                $newBlock->label = $blockData['label'];
                $newBlock->order = self::$_fileBlocks[$block]['order'];
                $newBlock->save();
                self::$_allBlocks[$block] = $newBlock;
            }
        }
        if (!empty(self::$_selectBlocks[$block])) {
            BlockSelectOption::import(self::$_allBlocks[$block]->id, self::$_selectBlocks[$block]);
        }
    }

    public static function updateBlockTemplates($block, $blockData)
    {
        if (isset(self::$_fileBlocks[$block])) {
            // do empty check as new blocks won't be found
            $databaseBlockTemplates = !empty(self::$_databaseBlockTemplates[$block]) ? self::$_databaseBlockTemplates[$block] : [];
            $fileBlockTemplates = !empty(self::$_fileBlockTemplates[$block]) ? self::$_fileBlockTemplates[$block] : [];

            if (!empty($blockData['global_pages']) || !empty($blockData['global_site'])) {
                $toAdd = [];
                $toDelete = $databaseBlockTemplates;

                $excludeTemplates = array_diff(self::$_databaseTemplateIds, $fileBlockTemplates);
                sort($excludeTemplates);
                $excludeList = implode(',', $excludeTemplates);
                $blockData['global_pages'] = !empty($blockData['global_pages']) ? 1 : 0;
                $blockData['global_site'] = !empty($blockData['global_site']) ? 1 : 0;

                // Insert or Update ThemeBlock
                if (empty(self::$_databaseBlocks[$block])) {
                    $newThemeBlock = new ThemeBlock;
                    $newThemeBlock->theme_id = self::$_theme->id;
                    $newThemeBlock->block_id = self::$_allBlocks[$block]->id;
                    $newThemeBlock->show_in_pages = $blockData['global_pages'];
                    $newThemeBlock->show_in_global = $blockData['global_site'];
                    $newThemeBlock->exclude_templates = $excludeList;
                    $newThemeBlock->save();
                } elseif (
                    self::$_databaseGlobalBlocks[$block]->show_in_pages != $blockData['global_pages'] ||
                    self::$_databaseGlobalBlocks[$block]->show_in_global != $blockData['global_site'] ||
                    self::$_databaseGlobalBlocks[$block]->exclude_templates != $excludeList
                ) {
                    self::$_databaseGlobalBlocks[$block]->show_in_pages = $blockData['global_pages'];
                    self::$_databaseGlobalBlocks[$block]->show_in_global = $blockData['global_site'];
                    self::$_databaseGlobalBlocks[$block]->exclude_templates = $excludeList;
                    self::$_databaseGlobalBlocks[$block]->save();
                }

            } else {
                // Delete from theme blocks if no longer a theme block
                if (!empty(self::$_databaseGlobalBlocks[$block])) {
                    ThemeBlock::where('block_id', '=', self::$_allBlocks[$block]->id)->where('theme_id', '=', self::$_theme->id)->delete();
                }

                $toAdd = array_diff($fileBlockTemplates, $databaseBlockTemplates);
                $toDelete = array_diff($databaseBlockTemplates, $fileBlockTemplates);
            }

            // Update TemplateBlocks
            if (!empty($toDelete)) {
                TemplateBlock::where('block_id', '=', self::$_allBlocks[$block]->id)->whereIn('template_id', $toDelete)->delete();
            }
            if (!empty($toAdd)) {
                foreach ($toAdd as $template_id) {
                    $newTemplateBlock = new TemplateBlock;
                    $newTemplateBlock->block_id = self::$_allBlocks[$block]->id;
                    $newTemplateBlock->template_id = $template_id;
                    $newTemplateBlock->save();
                }
            }
        }
    }

    public static function updateBlockRepeaters()
    {
        foreach (self::$_repeaterBlocks as $repeater => $repeaterBlocks) {
            $arrayList = [];
            foreach ($repeaterBlocks as $repeaterBlock) {
                $arrayList[] = self::$_allBlocks[$repeaterBlock]->id;
            }
            $implodedList = implode(',', $arrayList);
            if (empty(self::$_databaseRepeaterBlocks[self::$_allBlocks[$repeater]->id])) {
                $newBlockRepeater = new BlockRepeater;
                $newBlockRepeater->block_id = self::$_allBlocks[$repeater]->id;
                $newBlockRepeater->blocks = $implodedList;
                $newBlockRepeater->save();
            } elseif (self::$_databaseRepeaterBlocks[self::$_allBlocks[$repeater]->id]->blocks != $implodedList) {
                self::$_databaseRepeaterBlocks[self::$_allBlocks[$repeater]->id]->blocks = $implodedList;
                self::$_databaseRepeaterBlocks[self::$_allBlocks[$repeater]->id]->save();
            }
        }
    }

    /*
     * Deal with standard PageBuilder Methods
     */

    public static function block($block_name, $options = array())
    {
        if (!empty($options['import_ignore'])) {
            return;
        }

        if (in_array($block_name, self::$_repeaterTemplates)) {
            $currentRepeater = self::$_repeater;
            self::$_repeater = $block_name;

            // manually call the repeater view as the normal pagebuilder won't call it if the block_repeaters table is empty
            if (!empty($options['view'])) {
                $repeaterView = $options['view'];
            } else {
                $repeaterView = $block_name;
            }
            $output = View::make(
                'themes.' . self::$_theme->theme . '.blocks.repeaters.' . $repeaterView,
                ['is_first' => true, 'is_last' => true, 'count' => 1, 'total' => 1, 'id' => 1, 'pagination' => '']
            )->render();

            self::$_repeater = $currentRepeater;
        } else {
            $output = forward_static_call(array('\CoasterCms\Libraries\Builder\PageBuilder', 'block'), $block_name, $options);
        }

        if (self::$_repeater) {
            // if in a repeater template
            if (!isset(self::$_repeaterBlocks[self::$_repeater])) {
                self::$_repeaterBlocks[self::$_repeater] = [];
            }
            if (!in_array($block_name, self::$_repeaterBlocks[self::$_repeater])) {
                self::$_repeaterBlocks[self::$_repeater][] = $block_name;
            }
            $template = 0;
        } else {
            // if in a normal template
            $template = self::$_template;
        }

        if (!isset(self::$_fileTemplateBlocks[$template])) {
            self::$_fileTemplateBlocks[$template] = [];
        }
        if (!in_array($block_name, self::$_fileTemplateBlocks[$template])) {
            self::$_fileTemplateBlocks[$template][] = $block_name;
        }

        return $output;
    }

    public static function __callStatic($name, $arguments)
    {
        try {
            return forward_static_call_array(array('\CoasterCms\Libraries\Builder\PageBuilder', $name), $arguments);
        } catch (\Exception $e) {

        }
    }

}
