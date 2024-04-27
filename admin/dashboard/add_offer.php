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
    $offer = mysqli_real_escape_string($conn, $_POST['offer']);
    $monthly_clicks = mysqli_real_escape_string($conn, $_POST['monthly_clicks']);
    $monthly_payouts = mysqli_real_escape_string($conn, $_POST['monthly_payouts']);

    // Validate form data (you can add more validation as needed)
    if (empty($offer) || empty($monthly_clicks)) {
        $error = "Offer and monthly clicks are required";
    } else {
        // SQL to insert offer data into the database
        $sql = "INSERT INTO top_offers (offer, monthly_clicks, monthly_payouts) VALUES ('$offer', '$monthly_clicks', '$monthly_payouts')";

        if ($conn->query($sql) === TRUE) {
            // Offer added successfully
            $success = "Offer added successfully";
            header("location: ../dashboard");
            exit;
        } else {
            // Failed to add offer
            $error = "Error: " . $conn->error;
        }
    }
}

// Close database connection
$conn->close();
?>
