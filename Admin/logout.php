<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // If not logged in, redirect to the login page
    header("Location: ../adminlogin/admin_login.php");
    exit();
}

// If logout button is clicked
if (isset($_POST['logout'])) {
    // Unset all session variables
    session_unset();
    // Destroy the session
    session_destroy();
    // Redirect to the login page
    header("Location: ../adminlogin/admin_login.php");
    exit();
}

// Start the session
session_start();

// Unset all session variables
session_unset();

// Destroy the session
session_destroy();

// Prevent caching of the logout page
header("Cache-Control: no-cache, no-store, must-revalidate");
header("Pragma: no-cache");
header("Expires: 0");

// Redirect to the login page
header("Location: ../adminlogin/admin_login.php");
exit();
?>