<link rel="stylesheet" href="<{$xoops_url}>/modules/weather/assets/css/style.css">

<div><h1><{$heading}><img src="<{$xoops_url}>/modules/weather/images/weather/02d.png" 
                 alt="<{_MD_WEATHER_ALT}>" 
                 style="width: 100%; height: auto; max-width: 100px;"></h1></div>

<h2><{_MD_WEATHER_DEFAULT_CURRENT}> <{$location}></h2>

<h3><{$default_location_text}></h3>

<div class="weather-module">
    <div class="search-container">
        <form method="post" action="index.php">
            <input 
                type="text" 
                name="location" 
                placeholder="<{_MD_WEATHER_SEARCH_BOX}>" 
                class="weather-search-box"
                required
            >
            <button type="submit" class="weather-search-button" style="margin-top:10px;"><{_MD_WEATHER_SEARCH}></button>
        </form>
    </div>
</div>

<!-- Værdata -->
<{if $weatherData.properties.timeseries}>
    <div style="margin-bottom: 1px; border-bottom: 1px solid #ddd;"><h3><{_MD_WEATHER_FORECAST_NEXT_24_HOURS}></h3></div>
    <{foreach from=$weatherData.properties.timeseries item=forecast}>
    <div style="margin-bottom: 1px; padding-left: 5px; border-bottom: 1px solid #ddd;">
        <p>
			<strong> <h3><{$forecast.weekday}></h3></strong>
            <strong><{_MD_WEATHER_TIME}></strong> <{$forecast.local_time}><br>
            <strong><{_MD_WEATHER_TEMPERATURE}></strong> <{$forecast.data.instant.details.air_temperature}>°C<br>
            <strong><{_MD_WEATHER_WIND}></strong> <{$forecast.data.instant.details.wind_speed}> m/s<br>
            <strong><{_MD_WEATHER_CLOUDS}></strong> <{$forecast.data.instant.details.cloud_area_fraction}>%<br>
            <img src="<{$xoops_url}>/modules/weather/images/weather/<{$forecast.symbol_code|default:'unknown'}>.png" 
                 alt="<{_MD_WEATHER_ALT}>" 
                 style="width: 100%; max-width: 100px; height: 100px;">
        </p>
    </div>
<{/foreach}>
<{else}>
    <p><{_MD_WEATHER_ERROR}></p>
<{/if}>



