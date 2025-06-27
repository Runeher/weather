<?php
// Module Info
define('_MI_WEATHER_NAME', 'Weather');
define('_MI_WEATHER_DESC', 'Welcome to the Weather Module Admin Panel. A module to display weather information using MET and TimezoneDB APIs. Use the buttons below to manage settings or get help.');

// Admin Menu
define('_MI_WEATHER_ADMIN_SETTINGS', 'Weather Module Settings');
define('_MI_WEATHER_ADMIN_DESC', 'Manage the Weather module settings');

// Templates
define('_MI_WEATHER_TEMPLATE_INDEX', 'Main weather display');
define('_MI_WEATHER_TEMPLATE_ADMIN', 'Admin settings page');
define('_MD_WEATHER_ADMIN_SUCCESS', 'Data saved to database');
define('_MD_WEATHER_SAVE', 'Save');


// Preferences
define('_MI_WEATHER_PREF_EMAIL', 'Default email address');
define('_MI_WEATHER_PREF_API_KEY', 'Timezone API Key');

// Admin Menu
define('_MI_WEATHER_ADMENU1', 'Weather Module Admin');
define('_MI_WEATHER_ADMENU2', 'Weather Module Help');
define('_MI_WEATHER_BACK_ADMIN', 'Back to Admin');
define('_MI_WEATHER_HELP_ADMIN', 'Help');
define('_MI_WEATHER_GO_TO_MODULE', 'Go to Module');


// Help Section
define('_MI_WEATHER_HELP_TITLE', 'Help: Setting up Weather Module');
define('_MI_WEATHER_HELP_TEXT', 'This section provides guidance on setting up and using the Weather module.');
define('_MI_WEATHER_HELP_API', 'Registering an API Key');
define('_MI_WEATHER_HELP_API_TEXT', 'To use this module, you need an API key from TimezoneDB and a valid email. Register for a free API key at <a href="https://timezonedb.com/register" target="_blank">https://timezonedb.com/register</a>. Once registered, copy your API key into the module settings.');
define('_MI_WEATHER_HELP_EMAIL', 'Using a Valid Email Address');
define('_MI_WEATHER_HELP_EMAIL_TEXT', 'The email address you enter is used to identify your application when fetching weather data. Make sure to use a valid and working email address.');
define('_MI_WEATHER_SET_DEFAULT_LOCATION1', 'Set Location');
define('_MI_WEATHER_SET_DEFAULT_LOCATION', 'Set your preferred default location for module index and module block in module settings. Module default is Oslo.');
define('_MI_WEATHER_DEFAULT_LOCATION', 'Default Location');
define('_MI_WEATHER_DEFAULT_LOCATION_DESC', 'The default location displayed on the weather module frontend.');
define('_MI_WEATHER_PREF_DEFAULT_LOCATION', 'Default Location');

define('_MI_WEATHER_BLOCK_TITLE', 'Current Weather');
define('_MI_WEATHER_BLOCK_DESC', 'Displays the current weather for the default location set in admin.');
define('_MI_WEATHER_BLOCK_HELP_TITLE', 'Block');
define('_MI_WEATHER_BLOCK_HELP_DESC', 'The Weather module comes with a block that shows the current weather for the location set as default in admin settings.');

define('_MI_WEATHER_SEARCH_LOCATION', 'Search');
define('_MI_WEATHER_SEARCH_LOCATION_DESC', 'The search function in module frontend will provide a 24 hours weather forecast for any city in the world.');
?>
