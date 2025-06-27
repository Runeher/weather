<?php

include __DIR__ . '/admin_header.php';
xoops_cp_header();

// Tilordne data til templaten
$xoopsTpl->assign('title', _MI_WEATHER_ADMENU1);
$xoopsTpl->assign('description', _MI_WEATHER_DESC);
$xoopsTpl->assign('settings_url', XOOPS_URL . '/modules/weather/admin/settings.php');
$xoopsTpl->assign('help_url', XOOPS_URL . '/modules/weather/admin/help.php');

// Vis templaten
$xoopsTpl->display('db:weather_admin_index.tpl');

xoops_cp_footer();
