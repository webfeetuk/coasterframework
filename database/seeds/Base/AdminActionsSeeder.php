<?php
namespace CoasterCmsDatabase\Seeds\Base;

use Carbon\Carbon;
use CoasterCms\Models\AdminAction;
use CoasterCms\Models\AdminController;
use Illuminate\Database\Seeder;

class AdminActionsSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $date = new Carbon;
        $controllerIds = AdminController::idsByController();

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['home'],
                'action' => 'index',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Dashboard',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['home'],
                'action' => 'logs',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'View Admin Logs',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['home'],
                'action' => 'your-requests',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'View publish requests',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['home'],
                'action' => 'requests',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'View requests to moderate',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        $pageIndexId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['pages'],
            'action' => 'index',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Show Page Management',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'sort',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Sort Pages',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'add',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Add Pages',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'edit',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Edit Pages',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'delete',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Delete Pages',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'version-publish',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Publish Versions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'version-rename',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Rename Versions',
                'about' => 'required to be logged is as author or have publishing permission',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'versions',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Ajax Versions Table',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'request-publish',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Make Requests',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'request-publish-action',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Action Requests (cancel/approve/deny)',
                'about' => 'required to be logged in as author to cancel or else have publish permissions',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'requests',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Ajax Requests Table',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['pages'],
                'action' => 'tinymce-page-list',
                'inherit' => $pageIndexId,
                'edit_based' => 0,
                'name' => 'TinyMce Page Links',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['groups'],
                'action' => 'pages',
                'inherit' => $pageIndexId,
                'edit_based' => 0,
                'name' => 'List Group Pages',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);


        $menuShowId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['menus'],
            'action' => 'index',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Show Menu Items',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        $menuAddId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['menus'],
            'action' => 'add',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Add Menu Items',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['menus'],
                'action' => 'delete',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Delete Menu Items',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['menus'],
                'action' => 'sort',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Sort Menu Items',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['menus'],
                'action' => 'rename',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Rename Menu Items',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['menus'],
                'action' => 'get-levels',
                'inherit' => $menuShowId,
                'edit_based' => 0,
                'name' => 'Get Subpage Level',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['menus'],
                'action' => 'save-levels',
                'inherit' => $menuAddId,
                'edit_based' => 0,
                'name' => 'Set Subpage Level',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['blocks'],
                'action' => 'index',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Edit Site-wide Content',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['filemanager'],
                'action' => 'index',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'View Files',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['filemanager'],
                'action' => 'edit',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Manage Files',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['redirects'],
                'action' => 'index',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'View Redirects',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        $redirectsManageId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['redirects'],
            'action' => 'edit',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Manage Redirects',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['redirects'],
                'action' => 'import',
                'inherit' => $redirectsManageId,
                'edit_based' => 0,
                'name' => 'Import Redirects',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'index',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Show Account Settings',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'password',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Change Password',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'keys',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Request browser API keys',
                'about' => 'only keys with the string browser in can be called',
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'page-state',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Save page list state',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'language',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Change current language',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['account'],
                'action' => 'blog',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Auto Blog Login',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['system'],
                'action' => 'index',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Show System Settings',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        $systemUpdateId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['system'],
            'action' => 'update',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Updates System Settings',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['system'],
                'action' => 'search',
                'inherit' => $systemUpdateId,
                'edit_based' => 0,
                'name' => 'Rebuild Search Indexes',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['system'],
                'action' => 'validate-db',
                'inherit' => $systemUpdateId,
                'edit_based' => 0,
                'name' => 'Validate Database',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['system'],
                'action' => 'wp-login',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'WordPress Auto Login Script',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['system'],
                'action' => 'upgrade',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Upgrade CMS',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['users'],
                'action' => 'index',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'View User List',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        $userEditId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['users'],
            'action' => 'edit',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Edit Users',
            'about' => 'can edit roles of users (restricted by admin level)',
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['users'],
                'action' => 'add',
                'inherit' => $userEditId,
                'edit_based' => 0,
                'name' => 'Add Users',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['users'],
                'action' => 'delete',
                'inherit' => $userEditId,
                'edit_based' => 0,
                'name' => 'Remove Users',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        $roleIndexId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['roles'],
            'action' => 'index',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Role Management',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['roles'],
                'action' => 'add',
                'inherit' => $roleIndexId,
                'edit_based' => 0,
                'name' => 'Add Roles',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['roles'],
                'action' => 'edit',
                'inherit' => $roleIndexId,
                'edit_based' => 0,
                'name' => 'Edit Roles',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['roles'],
                'action' => 'delete',
                'inherit' => $roleIndexId,
                'edit_based' => 0,
                'name' => 'Delete Roles',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['roles'],
                'action' => 'actions',
                'inherit' => $roleIndexId,
                'edit_based' => 0,
                'name' => 'Ajax Get Role Actions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['roles'],
                'action' => 'pages',
                'inherit' => $roleIndexId,
                'edit_based' => 0,
                'name' => 'Set Per Page Actions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['backups'],
                'action' => 'restore',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Restore Deleted Item From Any User',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['backups'],
                'action' => 'undo',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Undo Own Actions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['repeaters'],
                'action' => 'index',
                'inherit' => -1,
                'edit_based' => 0,
                'name' => 'Create Repeater Row',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'list',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Gallery List',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'edit',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Edit Galleries',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'update',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Run Gallery Upload Manager',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'sort',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Sort Images',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'upload',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Upload Images',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'delete',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Delete Images',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['gallery'],
                'action' => 'caption',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Edit Captions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['forms'],
                'action' => 'list',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Forms List',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['forms'],
                'action' => 'submissions',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'View Form Submissions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['forms'],
                'action' => 'csv',
                'inherit' => 0,
                'edit_based' => 1,
                'name' => 'Export Form Submissions',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);

        $themeIndexId = AdminAction::insertGetId([
            'controller_id' => $controllerIds['themes'],
            'action' => 'index',
            'inherit' => 0,
            'edit_based' => 0,
            'name' => 'Block Importer/Updater',
            'about' => null,
            'created_at' => $date,
            'updated_at' => $date
        ]);

        AdminAction::insert([
            [
                'controller_id' => $controllerIds['themes'],
                'action' => 'update',
                'inherit' => $themeIndexId,
                'edit_based' => 0,
                'name' => 'Block Importer/Updater',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['themes'],
                'action' => 'beacons',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Import Beacons',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ],
            [
                'controller_id' => $controllerIds['themes'],
                'action' => 'beacons-update',
                'inherit' => 0,
                'edit_based' => 0,
                'name' => 'Update Beacon Blocks',
                'about' => null,
                'created_at' => $date,
                'updated_at' => $date
            ]
        ]);
    }

}