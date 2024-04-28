<?php
// Start session
session_start();

// Database connection
include '../connect/database.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../../login");
    exit;
}

// Initialize success and error messages
$success = "";
$error = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Fetch and sanitize form data
    $prize = mysqli_real_escape_string($conn, $_POST['prize']);
    $probability = mysqli_real_escape_string($conn, $_POST['probability']);
    $backgroundColor = mysqli_real_escape_string($conn, $_POST['backgroundColor']);
    $textColor = mysqli_real_escape_string($conn, $_POST['textColor']);

    // Validate form data (you can add more validation as needed)
    if (empty($prize) || empty($probability) || empty($backgroundColor) || empty($textColor)) {
        $error = "All fields are required";
    } else {
        // SQL to insert spin prize data into the database
        $sql = "INSERT INTO spin_prizes (spin_prizesTitle, Probability, BackgroundColor, TextColor) VALUES ('$prize', '$probability', '$backgroundColor', '$textColor')";

        if ($conn->query($sql) === TRUE) {
            // Prize added successfully
            $success = "Prize added successfully";
            header("location: ../dashboard");
            exit;
        } else {
            // Failed to add prize
            $error = "Error: " . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>
