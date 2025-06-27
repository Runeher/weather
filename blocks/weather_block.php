<?php

function show_weather_block($options)
{
     global $xoopsDB, $xoopsConfig; 

    // Inkluder WeatherAPI-klassen
    require_once XOOPS_ROOT_PATH . '/modules/weather/class/WeatherAPI.php';
	
	// Last inn språkfiler for værmodulen
    $moduleDirName = 'weather';
    $language = $xoopsConfig['language'];

    // Standard til engelsk hvis språkfiler ikke finnes
    if (!file_exists(XOOPS_ROOT_PATH . "/modules/{$moduleDirName}/language/{$language}/main.php")) {
        $language = 'english';
    }

    include_once XOOPS_ROOT_PATH . "/modules/{$moduleDirName}/language/{$language}/main.php";

    // Bruk fullt kvalifisert navn for klassen
    $weatherApiClass = '\\WeatherModule\\WeatherAPI';

    // Hent standard lokasjon, e-post og Timezone API-nøkkel fra databasen
    $tableName = $xoopsDB->prefix('weather_settings');
    $result = $xoopsDB->query("SELECT default_location, email, api_key_timezone FROM {$tableName} WHERE id = 1");
    $data = $result ? $xoopsDB->fetchArray($result) : [];

    if (!$data) {
        // Returner standard blokkdata hvis ingen innstillinger er funnet
        $block = [
            'location'    => 'N/A',
            'temperature' => 'N/A',
            'wind_speed'  => 'N/A',
            'symbol_code' => 'unknown',
        ];
        return $block;
    }

    $defaultLocation = $data['default_location'] ?? 'Oslo';
    $email = $data['email'] ?? 'default@example.com';
    $apiKeyTimezone = $data['api_key_timezone'] ?? '';

    // Opprett WeatherAPI-instansen
    $weatherApi = new $weatherApiClass("WeatherBlock/1.0 ({$email})", $apiKeyTimezone);

    // Hent koordinater for standard lokasjon
    $coords = $weatherApi->geocode($defaultLocation);
    if (!$coords) {
        // Returner standard blokkdata hvis geokoding mislykkes
        $block = [
            'location'    => $defaultLocation,
            'temperature' => 'N/A',
            'wind_speed'  => 'N/A',
            'symbol_code' => 'unknown',
        ];
        return $block;
    }

    $latitude = $coords['latitude'];
    $longitude = $coords['longitude'];

    // Hent værdata
    $weatherData = $weatherApi->getWeather($latitude, $longitude);
    if (!$weatherData || !isset($weatherData['properties']['timeseries'][0])) {
        // Returner standard blokkdata hvis værdata ikke kan hentes
        $block = [
            'location'    => $defaultLocation,
            'temperature' => 'N/A',
            'wind_speed'  => 'N/A',
            'symbol_code' => 'unknown',
        ];
        return $block;
    }

    // Hent værdata for nåværende tidspunkt
    $currentWeather = $weatherData['properties']['timeseries'][0];
    $temperature = $currentWeather['data']['instant']['details']['air_temperature'] ?? 'N/A';
    $windSpeed = $currentWeather['data']['instant']['details']['wind_speed'] ?? 'N/A';
    $symbolCode = $currentWeather['data']['next_12_hours']['summary']['symbol_code'] ?? 'unknown';

    // Sett opp blokkdata
    $block = [
        'location'    => $defaultLocation,
        'temperature' => $temperature,
        'wind_speed'  => $windSpeed,
        'symbol_code' => $symbolCode,
    ];

    // Returner blokkdata
    return $block;
}
