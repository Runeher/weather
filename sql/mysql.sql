CREATE TABLE `weather_settings` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `email` VARCHAR(255) NOT NULL,
    `api_key_timezone` VARCHAR(255) NOT NULL,
    `default_location` VARCHAR(255) NOT NULL DEFAULT 'Oslo',
    UNIQUE KEY (`id`)
);

-- Sett inn eksempeldata
INSERT INTO `weather_settings` (`id`, `email`, `api_key_timezone`, `default_location`) 
VALUES (1, 'example@example.com', 'EXAMPLE_TIMEZONE_API_KEY', 'Oslo');

