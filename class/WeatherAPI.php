<?php

namespace WeatherModule;

class WeatherAPI
{
    private $api_url = 'https://api.met.no/weatherapi/locationforecast/2.0/compact';
    private $timezone_api_url = 'https://api.timezonedb.com/v2.1/get-time-zone';
    private $user_agent;
    private $api_key_timezone;

    public function __construct($user_agent, $api_key_timezone)
    {
        $this->user_agent = $user_agent;
        $this->api_key_timezone = $api_key_timezone;
    }

    /**
     * Henter værdata basert på breddegrad og lengdegrad.
     * @param float $latitude
     * @param float $longitude
     * @return array|null
     */
    public function getWeather($latitude, $longitude)
    {
        $url = $this->api_url . "?lat={$latitude}&lon={$longitude}";
        $options = [
            'http' => [
                'header' => "User-Agent: {$this->user_agent}\r\n",
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            error_log("Failed to fetch weather data from: {$url}");
            return null;
        }

        return json_decode($response, true);
    }

    /**
     * Utfører geokoding for å hente breddegrad og lengdegrad for en lokasjon.
     * @param string $location
     * @return array|null
     */
    public function geocode($location)
    {
        $geocode_url = "https://nominatim.openstreetmap.org/search?q=" . urlencode($location) . "&format=json&limit=1";
        $options = [
            'http' => [
                'header' => "User-Agent: {$this->user_agent}\r\n",
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($geocode_url, false, $context);

        if ($response === false) {
            error_log("Failed to fetch geocode data for: {$location}");
            return null;
        }

        $data = json_decode($response, true);
        if (isset($data[0]['lat']) && isset($data[0]['lon'])) {
            return [
                'latitude' => $data[0]['lat'],
                'longitude' => $data[0]['lon'],
            ];
        }

        error_log("Unexpected response structure for geocode data: " . print_r($data, true));
        return null;
    }

    /**
     * Henter tidssone for en lokasjon basert på breddegrad og lengdegrad ved hjelp av TimezoneDB API.
     * @param float $latitude
     * @param float $longitude
     * @return string|null
     */
    public function getTimezone($latitude, $longitude)
    {
        $url = $this->timezone_api_url . "?key={$this->api_key_timezone}&format=json&by=position&lat={$latitude}&lng={$longitude}";
        $options = [
            'http' => [
                'header' => "User-Agent: {$this->user_agent}\r\n",
            ],
        ];
        $context = stream_context_create($options);
        $response = file_get_contents($url, false, $context);

        if ($response === false) {
            error_log("Failed to fetch timezone data for coordinates: {$latitude}, {$longitude}");
            return null;
        }

        $data = json_decode($response, true);
        if (isset($data['zoneName'])) {
            return $data['zoneName']; // Return tidssone-ID (f.eks. "Europe/Oslo")
        }

        error_log("Unexpected response structure for timezone data: " . print_r($data, true));
        return null;
    }
}
