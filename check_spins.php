<?php
include './admin/connect/database.php';

// Retrieve the user's counter value
if (isset($_GET['userId'])) {
    $userId = mysqli_real_escape_string($conn, $_GET['userId']);
    $sql = "SELECT counter FROM contact_users WHERE id = $userId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $counter = $row['counter'];

        // Return the counter value as a JSON response
        $response = array('counter' => $counter);
        echo json_encode($response);
    } else {
        echo json_encode(array('error' => 'User not found'));
    }
} else {
    echo json_encode(array('error' => 'User ID not provided'));
}

$conn->close();
?>