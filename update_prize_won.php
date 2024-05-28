<?php
// Connect to the database
include './admin/connect/database.php';

// Retrieve the data from the AJAX request
$userId = $_POST['userId'];
$prizeName = $_POST['prizeName'];

// Get the remaining spins for the user
$getRemainingSpinsQuery = "SELECT counter FROM contact_users WHERE id = $userId";
$result = $conn->query($getRemainingSpinsQuery);

if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $remainingSpins = $row['counter'];

    // Determine the column name based on the remaining spins
    $columnName = $remainingSpins === 2 ? 'prize_one_won' : 'prize_two_won';

    // Update the database with the prize won
    $updateQuery = "UPDATE contact_users SET $columnName = '$prizeName' WHERE id = $userId";
    $result = $conn->query($updateQuery);

    if ($result) {
        echo "Prize won updated successfully";
    } else {
        echo "Error updating prize won: " . $conn->error;
    }
} else {
    echo "Error getting remaining spins: " . $conn->error;
}

$conn->close();
?>