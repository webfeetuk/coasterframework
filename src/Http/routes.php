<?php

if (\CoasterCms\Helpers\Core\Page\Install::isComplete()) {

    include __DIR__ . '/routes/admin.php';
    include __DIR__ . '/routes/cms.php';

} else {

    include __DIR__ . '/routes/install.php';

}