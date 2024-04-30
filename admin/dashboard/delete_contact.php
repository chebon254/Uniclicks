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

// Check if contact user ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $contactUserId = $_GET['id'];

    // SQL to delete contact user
    $sql = "DELETE FROM `contact_users` WHERE id = $contactUserId";

    if ($conn->query($sql) === TRUE) {
        // Contact user deleted successfully
        // You can handle success response as needed
        echo "Contact user deleted successfully";
    } else {
        // Failed to delete contact user
        // You can handle error response as needed
        echo "Error deleting contact user: " . $conn->error;
    }
} else {
    // Contact user ID not provided or invalid
    // You can handle error response as needed
    echo "Invalid contact user ID";
}

// Close database connection
$conn->close();
?>
