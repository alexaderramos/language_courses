<?php

/**
 * Database configuration file
 *
 * This file contains the configuration settings for the database connection
 */

// Load environment variables from .env file
$envFile = __DIR__ . '/../.env';
$envVariables = [];

if (file_exists($envFile)) {
    $lines = file($envFile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Skip comments
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Parse each line and extract the key-value pairs
        list($key, $value) = explode('=', $line, 2);
        $envVariables[trim($key)] = trim($value);
    }
} else {
    throw new Exception("Environment file not found");
}

// Return database configuration using environment variables
return [
    'host' => $envVariables['DB_HOST'] ?? 'localhost',
    'database' => $envVariables['DB_DATABASE'] ?? 'language_courses',
    'username' => $envVariables['DB_USERNAME'] ?? 'root',
    'password' => $envVariables['DB_PASSWORD'] ?? '',
    'charset' => $envVariables['DB_CHARSET'] ?? 'utf8mb4',
    'port' => $envVariables['DB_PORT'] ?? 3306,
];
