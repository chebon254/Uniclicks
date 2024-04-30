<?php
// Database connection details
$servername = "localhost";
$username = "u423358681_chebon";
$password = "@?Uniclicks254";
$dbname = "u423358681_uniclicks";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
   die("Connection failed: " . $conn->connect_error);
}

?>