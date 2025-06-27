<?php

$modversion = [
    'name'        =>  _MI_WEATHER_NAME,
    'version'     => '1.0',
    'description' => 'Weather module with 24-hour forecast.',
    'author'      => 'Runeher',
    'credits'     => 'XOOPS Community',
    'license'     => 'GNU GPL 2.0 or later',
    'official'    => 0,
    'image'       => 'images/weather.png',
    'dirname'     => 'weather',
];

// Database schema and tables
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
$modversion['tables'] = [
    'weather_settings',
];

// Admin configuration
$modversion['hasAdmin']   = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu']  = 'admin/menu.php';

// Main user menu
$modversion['hasMain'] = 1;

// Blocks
$modversion['blocks'] = [
    [
        'file'        => 'weather_block.php',
        'name'        => _MI_WEATHER_BLOCK_TITLE, // Navn for blokken
        'description' => _MI_WEATHER_BLOCK_DESC,  // Beskrivelse
        'show_func'   => 'show_weather_block',
        'template'    => 'weather_block.tpl',
        'options'     => '', // Sørg for at denne linjen er med
    ],
];

// Templates
$modversion['templates'] = [
    ['file' => 'weather_index.tpl', 'description' => 'Main template for weather module'],
    ['file' => 'weather_admin_index.tpl', 'description' => 'Admin index template'],
    ['file' => 'weather_admin_help.tpl', 'description' => 'Admin help template'],
	 ['file' => 'admin_settings.tpl', 'description' => 'Admin settings template'],
];

// CSS
$modversion['css'] = ['assets/css/style.css', 'assets/css/admin.css'];

// ModuleAdmin configuration
$modversion['dirmoduleadmin'] = '/Frameworks/moduleclasses/moduleadmin';
$modversion['icons16']        = XOOPS_URL . '/Frameworks/moduleclasses/icons/16';
$modversion['icons32']        = XOOPS_URL . '/Frameworks/moduleclasses/icons/32';
$modversion['module_status']  = 'Beta';
$modversion['release_date']   = '2024-11-24';
$modversion['min_php']        = '7.4';
$modversion['min_xoops']      = '2.5.10';
$modversion['min_db']         = ['mysql' => '5.7'];
$modversion['min_admin']      = '1.2';

?>
