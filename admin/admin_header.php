<?php

// Inkluder XOOPS hovedfil for konstanter og miljø
require_once dirname(dirname(dirname(__DIR__))) . '/mainfile.php';

// Inkluder XOOPS administrasjonsfil
require_once XOOPS_ROOT_PATH . '/include/cp_header.php';

// Last inn XOOPS form-loader for admin-grensesnittet
require_once XOOPS_ROOT_PATH . '/class/xoopsformloader.php';

// Hent admin UI-objekt
$moduleDirName = basename(dirname(__DIR__));
$adminObject = \Xmf\Module\Admin::getInstance();
