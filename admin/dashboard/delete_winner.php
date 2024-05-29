<?php
// Start session
session_start();

// Database connection
include '../connect/database.php';

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    // Redirect to login page if not logged in
    header("Location: ../login");
    exit;
}

// Check if winner ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $winnerId = $_GET['id'];

    // SQL to delete winner
    $sql = "DELETE FROM winners WHERE id = $winnerId";

    if ($conn->query($sql) === TRUE) {
        // winner deleted successfully
        // You can handle success response as needed
        echo "Winner deleted successfully";
    } else {
        // Failed to delete winner
        // You can handle error response as needed
        echo "Error deleting winner: " . $conn->error;
    }
} else {
    // winner ID not provided or invalid
    // You can handle error response as needed
    echo "Invalid winner ID";
}

// Close database connection
$conn->close();
?>
