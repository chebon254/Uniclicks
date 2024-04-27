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

// Check if event ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $eventId = $_GET['id'];

    // SQL to delete event
    $sql = "DELETE FROM `events` WHERE id = $eventId";

    if ($conn->query($sql) === TRUE) {
        // Event deleted successfully
        // You can handle success response as needed
        echo "Event deleted successfully";
    } else {
        // Failed to delete event
        // You can handle error response as needed
        echo "Error deleting event: " . $conn->error;
    }
} else {
    // Event ID not provided or invalid
    // You can handle error response as needed
    echo "Invalid event ID";
}

// Close database connection
$conn->close();
?>
