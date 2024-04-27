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

// Check if offer ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $offerId = $_GET['id'];

    // SQL to delete offer
    $sql = "DELETE FROM top_offers WHERE id = $offerId";

    if ($conn->query($sql) === TRUE) {
        // Offer deleted successfully
        // You can handle success response as needed
        echo "Offer deleted successfully";
    } else {
        // Failed to delete offer
        // You can handle error response as needed
        echo "Error deleting offer: " . $conn->error;
    }
} else {
    // Offer ID not provided or invalid
    // You can handle error response as needed
    echo "Invalid offer ID";
}

// Close database connection
$conn->close();
?>
