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

// Check if the request is an AJAX request
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    // Prepare and execute the SQL query to fetch contact details
    $stmt = $conn->prepare("SELECT name, company, communication_type, communication_id, message, status, counter, prize_one_won, prize_two_won FROM contact_users WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(['error' => 'Contact details not found']);
    }

    $stmt->close();
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['messageSent'])) {
    $id = $_POST['id'];
    $status = $_POST['messageSent'] === 'true';

    // Prepare and execute the SQL query to update the status
    $stmt = $conn->prepare("UPDATE contact_users SET status = ? WHERE id = ?");
    $stmt->bind_param("ii", $status, $id);
    $stmt->execute();
    $stmt->close();

    echo json_encode(['success' => true]);
}
?>
