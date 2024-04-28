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

// Check if prize ID is provided and valid
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $prizeId = $_GET['id'];

    // Prepare SQL statement to delete prize
    $sql = "DELETE FROM `spin_prizes` WHERE spin_prizesID = ?";

    // Prepare and bind parameter
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $prizeId);

    // Execute the statement
    if ($stmt->execute()) {
        // Check if any rows were affected
        if ($stmt->affected_rows > 0) {
            // Prize deleted successfully
            echo "Prize deleted successfully";
        } else {
            // No rows affected, prize not found
            echo "Prize with ID $prizeId not found";
        }
    } else {
        // Failed to execute deletion query
        echo "Error deleting prize: " . $stmt->error;
    }

    // Close statement
    $stmt->close();
} else {
    // Prize ID not provided or invalid
    echo "Invalid prize ID";
}

// Close database connection
$conn->close();
?>
