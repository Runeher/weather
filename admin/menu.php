<?php

$dirname         = basename(dirname(__DIR__));
$module_handler  = xoops_getHandler('module');
$module          = $module_handler->getByDirname($dirname);
$pathIcon32      = $module->getInfo('icons32'); // Path to 32x32 icons
$pathModuleAdmin = $module->getInfo('dirmoduleadmin'); // Path to ModuleAdmin files

// Include language file for admin menu
if (file_exists(XOOPS_ROOT_PATH . "/modules/{$dirname}/language/" . $GLOBALS['xoopsConfig']['language'] . "/modinfo.php")) {
    include_once XOOPS_ROOT_PATH . "/modules/{$dirname}/language/" . $GLOBALS['xoopsConfig']['language'] . "/modinfo.php";
} else {
    include_once XOOPS_ROOT_PATH . "/modules/{$dirname}/language/english/modinfo.php";
}

$adminmenu[] = [
    'title' => _MI_WEATHER_ADMENU1,
    'link'  => 'admin/index.php',
    'icon'  => $pathIcon32 . '/home.png',
];

$adminmenu[] = [
    'title' => _MI_WEATHER_ADMIN_SETTINGS,
    'link'  => 'admin/settings.php',
    'icon'  => $pathIcon32 . '/exec.png',
];

$adminmenu[] = [
    'title' => _MI_WEATHER_ADMENU2,
    'link'  => 'admin/help.php',
    'icon'  => $pathIcon32 . '/help.png'
];
