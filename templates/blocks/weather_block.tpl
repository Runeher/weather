<link rel="stylesheet" href="<{$xoops_url}>/modules/weather/assets/css/style.css">
<div class="weather-block">
    <h3><{_MD_WEATHER_HEADING_BLOCK}> <{$block.location}></h3>
    <p><{_MD_WEATHER_TEMPERATURE_BLOCK}>: <{$block.temperature}>°C</p>
    <p><{_MD_WEATHER_WIND_SPEED_BLOCK}>: <{$block.wind_speed}> m/s</p>
    <img src="<{$xoops_url}>/modules/weather/images/weather/<{$block.symbol_code}>.png" alt="Weather Icon">
	<br>
	<a href="<{$xoops_url}>/modules/weather/"><{_MD_WEATHER_YOU_LIVE_BLOCK}></a>
</div>
