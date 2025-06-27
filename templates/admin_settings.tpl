<link rel="stylesheet" href="<{$xoops_url}>/modules/weather/css/admin.css">

<div class="admin-container">
    <h1><{_MI_WEATHER_ADMIN_SETTINGS}></h1>

    <{if $success}>
        <div class="success-message"><{_MD_WEATHER_ADMIN_SUCCESS}></div>
    <{/if}>

    <{if $error}>
        <div class="error-message"><{$error}></div>
    <{/if}>

    <form method="POST" action="settings.php">
        <!-- Email -->
        <div class="form-group">
            <label for="email"><{_MI_WEATHER_PREF_EMAIL}>:</label>
            <input type="email" id="email" name="email" value="<{$email}>" required>
        </div>

        <!-- Timezone API Key -->
        <div class="form-group">
            <label for="api_key_timezone"><{_MI_WEATHER_PREF_API_KEY}>:</label>
            <input type="text" id="api_key_timezone" name="api_key_timezone" value="<{$api_key_timezone}>" required>
        </div>

        <!-- Default Location -->
        <div class="form-group">
            <label for="default_location"><{_MI_WEATHER_PREF_DEFAULT_LOCATION}>:</label>
            <input type="text" id="default_location" name="default_location" value="<{$default_location}>" required>
        </div>

        <!-- Save Button -->
        <button type="submit" class="btn-save"><{_MD_WEATHER_SAVE}></button>
    </form>

    <!-- Admin Navigation Buttons -->
    <div class="admin-buttons">
        <button onclick="location.href='<{$xoops_url}>/modules/weather/admin/index.php'"><{_MI_WEATHER_BACK_ADMIN}></button>
        <button onclick="location.href='<{$xoops_url}>/modules/weather/admin/help.php'"><{_MI_WEATHER_HELP_ADMIN}></button>
        <button onclick="location.href='<{$xoops_url}>/modules/weather/'"><{_MI_WEATHER_GO_TO_MODULE}></button>
    </div>
</div>
