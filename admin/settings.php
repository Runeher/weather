<?php
include('../../../include/cp_header.php');
global $xoopsDB;

// Bruk korrekt tabellnavn med XOOPS-prefiks
$tableName = $xoopsDB->prefix('weather_settings');

// Standardvariabler
$success = false;
$error = null;

// Håndter POST-data for å lagre e-post, Timezone API-nøkkel og standard lokasjon
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $xoopsDB->escape($_POST['email']);
    $apiKeyTimezone = $xoopsDB->escape($_POST['api_key_timezone']);
    $defaultLocation = $xoopsDB->escape($_POST['default_location']);

    $query = "INSERT INTO {$tableName} (id, email, api_key_timezone, default_location) 
              VALUES (1, '$email', '$apiKeyTimezone', '$defaultLocation') 
              ON DUPLICATE KEY UPDATE 
              email = '$email', 
              api_key_timezone = '$apiKeyTimezone', 
              default_location = '$defaultLocation'";

    if ($xoopsDB->queryF($query)) {
        $success = true;
    } else {
        $error = "SQL Error: Could not update table. Error: " . $xoopsDB->error();
    }
}

// Hent eksisterende data fra databasen
$result = $xoopsDB->query("SELECT email, api_key_timezone, default_location FROM {$tableName} WHERE id = 1");

$data = $result ? $xoopsDB->fetchArray($result) : [];
$email = $data['email'] ?? '';
$apiKeyTimezone = $data['api_key_timezone'] ?? '';
$defaultLocation = $data['default_location'] ?? 'Oslo';

// Send data til templaten
xoops_cp_header();
$xoopsTpl->assign('email', $email);
$xoopsTpl->assign('api_key_timezone', $apiKeyTimezone);
$xoopsTpl->assign('default_location', $defaultLocation);
$xoopsTpl->assign('success', $success);
$xoopsTpl->assign('error', $error);
$xoopsTpl->display('db:admin_settings.tpl');
xoops_cp_footer();
