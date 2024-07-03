<?php
// Database connection details
$servername = "localhost";
$username = "u988435817_adminuniclicks";
$password = "@?Cretivdev254";
$dbname = "u988435817_uniclicks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

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

// Define the tables you want to synchronize
$tables = [
    'contact_users',
    'events',
    'spin_prizes',
    'top_offers',
    'winners',
    // Add more tables as needed
];

// Loop through each table and synchronize data
foreach ($tables as $table) {
    $sql = "SELECT * FROM $table";
    $result = $conn->query($sql);

    // Loop through the result set and create items on Monday.com board
    foreach ($result as $row) {
        $userData = [];
        foreach ($row as $key => $value) {
            $userData[$key] = $value;
        }

        try {
            $response = $client->post("boards/BOARD_ID/items", [
                'json' => $userData,
            ]);

            // Handle the response
            $responseData = json_decode($response->getBody()->getContents(), true);
            // Add your desired logic here to handle the response
            // ...
        } catch (\GuzzleHttp\Exception\GuzzleException $e) {
            // Handle the exception
            echo $e->getMessage();
        }
    }
}

// Close the database connection
$conn->close();