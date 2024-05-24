<?php
include './admin/connect/database.php';

// Decrement the user's counter value
if (isset($_POST['userId'])) {
    $userId = mysqli_real_escape_string($conn, $_POST['userId']);
    $sql = "UPDATE contact_users SET counter = counter - 1 WHERE id = $userId";

    if ($conn->query($sql) === TRUE) {
        echo "Counter decremented successfully";
    } else {
        echo "Error decrementing counter: " . $conn->error;
    }
} else {
    echo "User ID not provided";
}

$conn->close();
?>