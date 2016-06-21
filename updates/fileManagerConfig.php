<?php

$updatedFileManagerConf = false;
$uploadsDir = public_path('uploads');

if (!is_dir($uploadsDir)) {

    mkdir($uploadsDir);
    mkdir($uploadsDir . '/system');
    mkdir($uploadsDir . '/system/forms');
    mkdir($uploadsDir . '/system/gallery');

    file_put_contents($uploadsDir . '/config.php', '<?php
\CoasterCms\Helpers\Admin\FileManager::filemanager_set_permissions();
$filePermissions[\'system\'][\'prevent_delete\'] = true;
$filePermissions[\'system\'][\'prevent_rename\'] = true;
');
    file_put_contents($uploadsDir . '/system/config.php', '<?php
\CoasterCms\Helpers\Admin\FileManager::filemanager_set_permissions(false);
$folder_message = "Note: system files can\'t be directly removed";
');

    echo "Coaster Framework: Created uploads structure for file manager \n";
}

findConfigPhp($uploadsDir);

function findConfigPhp($dir)
{
    foreach (scandir($dir) as $dirItem) {
        if (!in_array($dirItem, ['.', '..'])) {
            if (is_dir($dir . '/' . $dirItem)) {
                findConfigPhp($dir . '/' . $dirItem);
            } elseif ($dirItem == 'config.php') {
                updateConfigPhp($dir . '/' . $dirItem);
            }
        }
    }
}

function updateConfigPhp($configFile)
{
    global $updatedFileManagerConf;
    $fileContent = file_get_contents($configFile);
    if (strpos($fileContent, 'filemanager_set_permissions(') !== false && strpos($fileContent, '\CoasterCms\Helpers\Admin\FileManager::filemanager_set_permissions(') === false) {
        \CoasterCms\Helpers\Core\File\File::replaceString($configFile, '\CoasterCms\Helpers\filemanager_set_permissions(', 'filemanager_set_permissions(');
        \CoasterCms\Helpers\Core\File\File::replaceString($configFile, 'filemanager_set_permissions(', '\CoasterCms\Helpers\Admin\FileManager::filemanager_set_permissions(');
        $updatedFileManagerConf = true;
    }
}

if ($updatedFileManagerConf) {
    echo "Coaster Framework: Updated file manager config files\n";
}