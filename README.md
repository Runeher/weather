<b>Weather for XOOPS CMS</b>

Weather is a lightweight XOOPS module that displays weather forecasts using MET's API. It supports timezone conversion, dynamic location search, and a configurable admin panel.

<b>Features</b>

- 24-hour weather forecast with hourly updates
- Automatic timezone adjustment via TimeZoneDB
- Dynamic location search with geocoding
- Admin settings for email, TimeZoneDB API key, and default location
- Optional frontpage block showing current weather
- Language support via XOOPS language system
- Responsive design with customizable template

<b>Installation</b>

1. Upload the `weather/` folder to your XOOPS `modules/` directory.
2. Log in to the XOOPS admin interface.
3. Install the module via the Modules section.
4. Go to the Weather module’s Settings to enter your:
   - Email (used for MET API requests)
   - TimeZoneDB API key
   - Default location

<b>Usage</b>

After installation and configuration:

- Visit the module front page to view 24-hour weather for the default or searched location.
- Enable the optional weather block to show the current temperature, wind speed, and symbol.
