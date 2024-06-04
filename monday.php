<?php
require 'vendor/autoload.php';

// Load environment variables from `.env` file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Get the API token from the environment variable
$apiToken = $_ENV['MONDAY_API_TOKEN'];

// Initialize Guzzle client
$client = new \GuzzleHttp\Client([
    'base_uri' => 'https://api.monday.com/v2/',
    'headers' => [
        'Authorization' => $apiToken,
        'Content-Type' => 'application/json',
    ],
]);