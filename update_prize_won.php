<?php
// Connect to the database
include './admin/connect/database.php';

// Retrieve the data from the AJAX request
$userId = $_POST['userId'];
$prizeName = $_POST['prizeName'];

// Update the database with the prize won
$updateQuery = "UPDATE contact_users SET prize_one_won = '$prizeName' WHERE id = $userId";
$result = $conn->query($updateQuery);

if ($result) {
    echo "Prize won updated successfully";
} else {
    echo "Error updating prize won: " . $conn->error;
}

$conn->close();
?>
