<?php
// Enable error reporting and display errors for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// require '../../vendor/autoload.php'; // Ensure Composer autoload is included

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

// try {
//     // Load environment variables from `.env` file
//     $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
//     $dotenv->load();
// } catch (Exception $e) {
//     die("Error loading .env file: " . $e->getMessage());
// }

// $apiToken = $_ENV['MONDAY_API_TOKEN'] ?? null;
// if (!$apiToken) {
//     die("API token not set in environment variables.");
// }

// try {
//     $client = new \GuzzleHttp\Client([
//         'base_uri' => 'https://api.monday.com/v2/',
//         'headers' => [
//             'Authorization' => $apiToken,
//             'Content-Type' => 'application/json',
//         ],
//     ]);
// } catch (Exception $e) {
//     die("Error initializing Guzzle client: " . $e->getMessage());
// }

// // Define tables and their corresponding board IDs
// $tables = [
//     'contact_users' => 1552823024,
//     'events' => 1552826197,
//     'spin_prizes' => 1552827596,
//     'top_offers' => 1552830978,
//     'winners' => 1552829005,
//     // Add more tables as needed
// ];

// foreach ($tables as $table => $boardId) {
//     $sql = "SELECT * FROM $table";
//     $result = $conn->query($sql);

//     if (!$result) {
//         die("Error executing query on table $table: " . $conn->error);
//     }

//     foreach ($result as $row) {
//         $userData = [];
//         foreach ($row as $key => $value) {
//             $userData[$key] = $value;
//         }

//         try {
//             $response = $client->post("boards/$boardId/items", [
//                 'json' => $userData,
//             ]);

//             $responseData = json_decode($response->getBody()->getContents(), true);
//             // Handle the response
//         } catch (\GuzzleHttp\Exception\GuzzleException $e) {
//             echo "Error posting data to board $boardId: " . $e->getMessage();
//         }
//     }
// }

// // Close the database connection
// $conn->close();
// 
?>
