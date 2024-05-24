<?php
// Database connection details
include './admin/connect/database.php';

// Check if the prizeTitle and userId parameters are set
if (isset($_POST['prizeTitle']) && isset($_POST['userId'])) {
    $prizeTitle = mysqli_real_escape_string($conn, $_POST['prizeTitle']);
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);

    // Retrieve the user's existing prizes_won data
    $sql = "SELECT prizes_won FROM contact_users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $existingPrizes = $row['prizes_won'];

        // Append the new prize to the existing prizes
        if (empty($existingPrizes)) {
            $updatedPrizes = $prizeTitle;
        } else {
            $updatedPrizes = $existingPrizes . "," . $prizeTitle;
        }

        // Update the prizes_won column in the database
        $updateSql = "UPDATE contact_users SET prizes_won = '$updatedPrizes' WHERE id = $userId";
        if ($conn->query($updateSql) === TRUE) {
            echo "Prizes won updated successfully";
        } else {
            echo "Error updating prizes won: " . $conn->error;
        }
    } else {
        echo "User not found";
    }
} else {
    echo "Prize title or user ID not provided";
}

$conn->close();
?>