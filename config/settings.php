<?php

// Error reporting
error_reporting(0);
ini_set('display_errors', '0');

// Timezone
date_default_timezone_set('Europe/Berlin');

// Settings
$settings = [];

// Path settings
$settings['root']   = dirname(__DIR__);
$settings['temp']   = $settings['root'] . '/tmp';
$settings['public'] = $settings['root'] . '/public';

// Error Handling Middleware settings
$settings['error_handler_middleware'] = [

    // Should be set to false in production
    'display_error_details' => true,

    // Parameter is passed to the default ErrorHandler
    // View in rendered output by enabling the "displayErrorDetails" setting.
    // For the console and unit tests we also disable it
    'log_errors'            => true,

    // Display error details in error log
    'log_error_details'     => true,
];

//Mail Configuration
$mailConfig = [
    'debug'    => 0,
    'host'     => "smtp.mailtrap.io",
    'port'     => 2525,
    'protocol' => "tls",
    'username' => "a0f441a2a2ac72",
    'password' => "42d695310f8e4b",
    "to"     => "contact@amhereltd.com",
    "name"     => "Am HERE WEB",
];

$settings['mailer'] = $mailConfig;

return $settings;
