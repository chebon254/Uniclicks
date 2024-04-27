<?php
include './connect/database.php';

session_start();

// Check if user is logged in, if not redirect back to login page
if (!isset($_SESSION['username'])) {
    header("location: ./login");
    exit;
}
?>