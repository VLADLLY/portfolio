<?php
$servername = "localhost"; // Assuming MySQL server is hosted locally
$username = "root"; // Replace 'your_username' with your actual MySQL username
$password = ""; // Replace 'your_password' with your actual MySQL password
$database = "portfoliovlad";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} else {
    echo "";
}
?>
