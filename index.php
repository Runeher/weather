<?php

include("../../mainfile.php");
include(XOOPS_ROOT_PATH . "/header.php");
require_once XOOPS_ROOT_PATH . "/modules/weather/class/WeatherAPI.php";
global $xoopsDB;

// Dynamisk tabellnavn med XOOPS-prefiks
$tableName = $xoopsDB->prefix('weather_settings');

// Hent e-post, Timezone API-nøkkel og standard lokasjon fra databasen
$result = $xoopsDB->query("SELECT email, api_key_timezone, default_location FROM {$tableName} WHERE id = 1");
$data = $result ? $xoopsDB->fetchArray($result) : [];
$email = $data['email'] ?? 'default@example.com';
$apiKeyTimezone = $data['api_key_timezone'] ?? '';
$defaultLocation = $data['default_location'] ?? 'Oslo';

// Opprett WeatherAPI-instansen
$weatherApi = new \WeatherModule\WeatherAPI("Weather/1.0 ({$email})", $apiKeyTimezone);

// Standardlokasjon
$latitude = '59.91';
$longitude = '10.75';
$location = $defaultLocation;
$error = null;

// Hent koordinater for standardlokasjon hvis ingen søk er gjort
if (!isset($_POST['location'])) {
    $coords = $weatherApi->geocode($defaultLocation);
    if ($coords) {
        $latitude = $coords['latitude'];
        $longitude = $coords['longitude'];
    } else {
        $error = "Could not fetch coordinates for the default location: {$defaultLocation}";
    }
}

// Håndter søk
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['location'])) {
    $inputLocation = htmlspecialchars(trim($_POST['location']));
    $coords = $weatherApi->geocode($inputLocation);

    if ($coords) {
        $latitude = $coords['latitude'];
        $longitude = $coords['longitude'];
        $location = $inputLocation;
    } else {
        $error = "Could not fetch coordinates for the selected location.";
        error_log("Geocoding failed for location: {$inputLocation}");
    }
}

// Hent værdata
$weatherData = $weatherApi->getWeather($latitude, $longitude);

if ($weatherData && isset($weatherData['properties']['timeseries'])) {
    // Hent tidssone fra TimezoneDB
    $timezone = $weatherApi->getTimezone($latitude, $longitude);

    if (!$timezone) {
        $error = "Could not fetch timezone for the selected location.";
        $timezone = 'UTC'; // Fallback til UTC
        error_log("Timezone fallback to UTC for coordinates: {$latitude}, {$longitude}");
    }

    $filteredTimeseries = [];
    $currentTime = new DateTime('now', new DateTimeZone($timezone)); // Nåværende lokal tid
    $endTime = (clone $currentTime)->modify('+24 hours'); // 24 timer fram i tid

    foreach ($weatherData['properties']['timeseries'] as $forecast) {
        $utcTime = new DateTime($forecast['time'], new DateTimeZone('UTC')); // UTC tid fra MET API

        try {
            $localTime = $utcTime->setTimezone(new DateTimeZone($timezone)); // Endre til lokal tid
            $forecast['local_time'] = $localTime->format('d-m-Y H:i'); // Formatér tiden

            // Finn ukedag basert på lokal tid
            $forecast['weekday'] = $localTime->format('l'); // Fullt navn på dagen (Monday, Tuesday, etc.)

            // Oversett ukedagen basert på språkfiler
            $forecast['weekday'] = str_replace(
                ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'],
                [
                    _MD_WEATHER_MONDAY,
                    _MD_WEATHER_TUESDAY,
                    _MD_WEATHER_WEDNESDAY,
                    _MD_WEATHER_THURSDAY,
                    _MD_WEATHER_FRIDAY,
                    _MD_WEATHER_SATURDAY,
                    _MD_WEATHER_SUNDAY
                ],
                $forecast['weekday']
            );

            // Hent symbol_code
            $symbolCode = $forecast['data']['next_12_hours']['summary']['symbol_code'] ?? 'unknown';

            // Sjekk tid på døgnet for dag/natt-symboler
            $hour = (int)$localTime->format('H'); // Lokal time (24-timers format)
            if (strpos($symbolCode, '_day') !== false && ($hour < 6 || $hour >= 18)) {
                // Hvis dag-symbol brukes, men det er natt, bytt til natt-symbol
                $symbolCode = str_replace('_day', '_night', $symbolCode);
            } elseif (strpos($symbolCode, '_night') !== false && ($hour >= 6 && $hour < 18)) {
                // Hvis natt-symbol brukes, men det er dag, bytt til dag-symbol
                $symbolCode = str_replace('_night', '_day', $symbolCode);
            }

            $forecast['symbol_code'] = $symbolCode;

            // Inkluder kun værdata de neste 24 timene
            if ($localTime >= $currentTime && $localTime <= $endTime) {
                $filteredTimeseries[] = $forecast;
            }
        } catch (Exception $e) {
            error_log("Invalid timezone: " . $timezone);
        }
    }

    // Oppdater værdataene med de filtrerte tidsseriene
    $weatherData['properties']['timeseries'] = $filteredTimeseries;
} else {
    $error = "Could not fetch weather data.";
    error_log("Weather data fetch failed for coordinates: {$latitude}, {$longitude}");
}

// Send data til templaten
$xoopsTpl->assign('weatherData', $weatherData);
$xoopsTpl->assign('location', $location);
$xoopsTpl->assign('email', $email);
$xoopsTpl->assign('error', $error);
$xoopsTpl->assign('default_location_text', _MD_WEATHER_DEFAULT_LOCATION_TEXT);
$xoopsTpl->assign('heading', _MD_WEATHER_HEADING);

// Vis templaten
$xoopsTpl->display('db:weather_index.tpl');

include(XOOPS_ROOT_PATH . "/footer.php");
