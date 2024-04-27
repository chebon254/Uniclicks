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

// Initialize success and error messages
$success = "";
$error = "";
$thumbnail = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['thumbnail'])) {
    // Fetch and sanitize form data
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $start_date = mysqli_real_escape_string($conn, $_POST['start_date']);
    $end_date = mysqli_real_escape_string($conn, $_POST['end_date']);

    // Validate form data (you can add more validation as needed)
    if (empty($title) || empty($location) || empty($start_date) || empty($end_date)) {
        $error = "All fields are required";
    } else {
        // Check if a file is uploaded
        if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
            // File upload directory (relative to the current script)
            $uploadDir = __DIR__ . '/thumbnails/';

            // Create thumbnails directory if it doesn't exist
            if (!file_exists($uploadDir)) {
                mkdir($uploadDir, 0777, true);
            }

            // Generate a unique filename for the uploaded file
            $thumbnailFilename = uniqid() . '_' . basename($_FILES['thumbnail']['name']);

            // Move the uploaded file to the thumbnails directory
            $uploadPath = $uploadDir . $thumbnailFilename;
            if (move_uploaded_file($_FILES['thumbnail']['tmp_name'], $uploadPath)) {
                // File upload successful, store the filename in the database
                $thumbnail = $thumbnailFilename;
            } else {
                // Error uploading file
                $error = "Error uploading thumbnail image.";
            }
        } elseif ($_FILES['thumbnail']['error'] !== UPLOAD_ERR_NO_FILE) {
            // File upload error
            $error = "Error uploading thumbnail image: " . $_FILES['thumbnail']['error'];
        }


        // SQL to insert event data into the database
        $sql = "INSERT INTO events (title, location, start_date, end_date, thumbnail) VALUES ('$title', '$location', '$start_date', '$end_date', '$thumbnail')";

        if ($conn->query($sql) === TRUE) {
            // Event added successfully
            $success = "Event added successfully";
            header("location: ../dashboard");
            exit;
        } else {
            // Failed to add event
            $error = "Error: " . $conn->error;
        }
    }
}

// Close database connection
$conn->close();

?>
