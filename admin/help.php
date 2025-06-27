<?php

include __DIR__ . '/admin_header.php';
xoops_cp_header();

// Tilordne data til templaten
$xoopsTpl->assign('title', _MI_WEATHER_HELP_TITLE);
$xoopsTpl->assign('description', _MI_WEATHER_HELP_TEXT);
$xoopsTpl->assign('settings_url', XOOPS_URL . '/modules/weather/admin/settings.php');
$xoopsTpl->assign('back_url', XOOPS_URL . '/modules/weather/admin/index.php');

// Vis templaten
$xoopsTpl->display('db:weather_admin_help.tpl');

xoops_cp_footer();
